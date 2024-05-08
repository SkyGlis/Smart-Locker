<?php include "Components/Database/connect.php";

    ini_set('display_errors', 1);

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(!isset($_REQUEST['name'])) {
            die();
        }
        $name = $_REQUEST['name'];
        $success = $_REQUEST['success'];

        $log = $mysqli->query("INSERT INTO logs (user, date, success) VALUES ('$name', NOW(), '$success')");
    }

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        if(isset($_GET['auth'])) {
            $card = $_GET['auth'];

            $list = $mysqli->query("SELECT * FROM `users` WHERE (tag) = '$card'");

            if($list->num_rows > 0) {
                if($row = $list->fetch_assoc()) {
                    echo $row['password'];
                }
            } else {
                echo "0";
            }
        }

        if(isset($_GET['name'])) {
            $card = $_GET['name'];

            $list = $mysqli->query("SELECT * FROM `users` WHERE (tag) = '$card'");

            if($list->num_rows > 0) {
                if($row = $list->fetch_assoc()) {
                    echo ucfirst($row['name']);
                }
            } else {
                echo "0";
            }
        }
    }