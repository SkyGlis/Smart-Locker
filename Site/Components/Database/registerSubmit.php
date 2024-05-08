<?php include "./connect.php";
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['submit'])) {
            $name = strtolower($_REQUEST['name']);
            $rfid = $_REQUEST['tag'];
            $password = $_REQUEST['password'];
            $passwordConfirm = $_REQUEST['confirmpassword'];
            $admin = isset($_REQUEST['admin']) ? 1 : 0;

            $_SESSION['redirected'] = TRUE;

            if(ctype_digit($password) && strlen($password) == 4) {
                $tag = $mysqli->query("SELECT * FROM `users` WHERE tag = '$rfid'");
                $user = $mysqli->query("SELECT * FROM `users` WHERE name = '$name'");

                if($tag->num_rows != 0) {
                    $_SESSION['status'] = 0;
                    $_SESSION['message'] = "Tag já registrada!";
                } else if($user->num_rows != 0) {
                    $_SESSION['status'] = 0;
                    $_SESSION['message'] = "Nome já existente!";
                } else {
                    if($password != $passwordConfirm) {
                        $_SESSION['status'] = 0;
                        $_SESSION['message'] = "As palavras-passe não coicidem!";
                    } else {
                        $create = $mysqli->query("INSERT INTO `users` (name, tag, password, admin) VALUES ('$name', '$rfid', '$password', '$admin')");

                        $_SESSION['statusLogin'] = 1;
                        $_SESSION['message'] = 'Conta criada com sucesso!';
                    }
                }
            } else {
                $_SESSION['status'] = 0;
                $_SESSION['message'] = "A palavra-passe apenas pode conter 4 números!";
            }

            unset($_REQUEST);

            header('Location: ../../dashboard.php?menu=register');
            exit;
        }
    }