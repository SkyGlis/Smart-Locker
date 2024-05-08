<?php include "./connect.php";
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['submit'])) {

            if(!isset($_REQUEST['name']) || !isset($_REQUEST['password'])) {
                die();
            }

            $password = $_REQUEST["password"];
            $name = strtolower($_REQUEST['name']);
            
            $userVerify = $mysqli->query("SELECT * FROM `users` WHERE name = '$name'");

            if($userVerify->num_rows == 0) { 
                $_SESSION['message'] = "Utilizador não encontrado!";
                $_SESSION['status'] = 0;
            }

            if($row = $userVerify->fetch_assoc()) {
                if($row['password'] == $_POST['password']) {
                    $_SESSION['status'] = 1;
                    $_SESSION['message'] = 'Bem-vindo, ' . $row['name'];

                    $_SESSION['user'] = array(
                        'name' => $row['name'],
                        'admin' => $row['admin'],
                        'password' => $_REQUEST['password'],
                        'tag' => $row['tag']
                    );

                    $_SESSION['isLogged'] = TRUE;
                } else {
                    $_SESSION['status'] = 0;
                    $_SESSION['message'] = "Palavra-passe incorreta!";
                }
            }

            $_SESSION['redirected'] = TRUE;
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }