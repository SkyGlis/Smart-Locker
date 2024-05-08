<?php include "./connect.php";
    ini_set('display_errors', 1);

    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['submit'])) {
            $name = $_REQUEST['user'];

            $_SESSION['redirected'] = TRUE;

            $user = $mysqli->query("SELECT * FROM `users` WHERE name = '$name'");
            if($user->num_rows != 0) {
                $userRow = $user->fetch_assoc();

                $id = $userRow['id'];

                if($userRow['admin']) {
                    $_SESSION['status'] = 0;
                    $_SESSION['message'] = 'Não é possível apagar uma conta de administrador!';
                } else {
                    $update = $mysqli->query("DELETE FROM `users` WHERE ID = '$id'");

                    $_SESSION['status'] = 1;
                    $_SESSION['message'] = 'Conta apagada com sucesso!';
                }
            } else {
                $_SESSION['status'] = 0;
                $_SESSION['message'] = 'Conta não encontrada!';
            }

            unset($_REQUEST);

            header('Location: ../../dashboard.php?menu=delete&user=' . $name);
            exit;
        }
    }