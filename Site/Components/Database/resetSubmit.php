<?php include "./connect.php";
    ini_set('display_errors', 1);

    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['submit'])) {
            $oldPassword = $_REQUEST['oldpassword'];
            $password = $_REQUEST['password'];
            $passwordConfirm = $_REQUEST['confirmpassword'];

            $_SESSION['redirected'] = TRUE;

            $session = $_SESSION['user'];
            $name = $session['name'];

            if(ctype_digit($password) && strlen($password) == 4) {
                $user = $mysqli->query("SELECT * FROM `users` WHERE name = '$name' AND password = '$oldPassword'");

                if($user->num_rows == 0) {
                    $_SESSION['status'] = 0;
                    $_SESSION['message'] = "Palavra-passe errada!";
                } else {
                    $row = $user->fetch_assoc();

                    if($password != $passwordConfirm) {
                        $_SESSION['status'] = 0;
                        $_SESSION['message'] = "A nova palavra-passe não coicide!";
                    } else {
                        $id = $row['id'];
                        $update = $mysqli->query("UPDATE `users` SET password = $password WHERE ID = '$id'");

                        $_SESSION['statusLogin'] = 1;
                        $_SESSION['message'] = 'Palavra-passe alterada com sucesso!';
                    }
                }
            } else {
                $_SESSION['status'] = 0;
                $_SESSION['message'] = "A palavra-passe apenas pode conter 4 números!";
            }

            unset($_REQUEST);

            header('Location: ../../login.php');
            exit;
        }
    }