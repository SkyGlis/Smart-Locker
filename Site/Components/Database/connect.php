<?php
    $server = "localhost:3308";
    $database = "daniel";
    $username = "root";

    $mysqli = new mysqli($server, $username, '', $database);

    if ($mysqli -> connect_error) {
        die("Houve um erro a conectar à base de dados: " . $mysqli->connect_error);
    }

    $mysqli->set_charset("utf8");
    // echo "Sucesso!";