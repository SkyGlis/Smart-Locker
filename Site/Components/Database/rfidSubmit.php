<?php include "./connect.php";
    ini_set('display_errors', 1);

    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['submit'])) {
            $rfid = $_REQUEST['rfid'];
            $name = $_REQUEST['user'];

            $_SESSION['redirected'] = TRUE;

            $tag = $mysqli->query("SELECT * FROM `users` WHERE tag = '$rfid'");
            $user = $mysqli->query("SELECT * FROM `users` WHERE name = '$name'");

            $userRow = $user->fetch_assoc();

            if($tag->num_rows != 0) {
                $tagRow = $tag->fetch_assoc();

                if($userRow['id'] == $tagRow['id']) {
                    $_SESSION['status'] = 0;
                    $_SESSION['message'] = "Tag RFID já associado a esta conta!";
                } else {
                    $_SESSION['status'] = 0;
                    $_SESSION['message'] = "Tag RFID já associado a outra conta!";
                }
            } else {
                $id = $userRow['id'];
                $update = $mysqli->query("UPDATE `users` SET tag = '$rfid' WHERE ID = '$id'");

                $_SESSION['status'] = 1;
                $_SESSION['message'] = 'Tag RFID alterada com sucesso!';
            }

            unset($_REQUEST);

            header('Location: ../../dashboard.php?menu=rfid&user=' . $name);
            exit;
        }
    }