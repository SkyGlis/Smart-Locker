<?php include "./connect.php";
    session_start();

    function loginRedirect() {
        $logged = $_SESSION['isLogged'];

        if($logged) {
            return true;
        } else {
            header("location: login.php\n");
            exit;
        }
    }

    function adminOnly() {
        $user = $_SESSION['user'];

        if($_SESSION['isLogged'] && $user['admin'] == true) {
            return true;
        } else {
            header('Location: dashboard.php');
            exit;
        }
    }

    function verifyLogin($database) {
        $user = $_SESSION['user'];

        $name = $user['name'];

        $userVerify = $database->query("SELECT * FROM `users` WHERE name = '$name'");

        if(isset($user) && $userVerify->num_rows > 0) {
            if($row = $userVerify->fetch_assoc()) {
                if($user['password'] == $row['password']) {
                    $_SESSION["isLogged"] = true;
                } else {
                    unset($_SESSION['user']);
                    $_SESSION['isLogged'] = false;
                }
            }
        } else {
            $_SESSION['isLogged'] = false;
        }
    }