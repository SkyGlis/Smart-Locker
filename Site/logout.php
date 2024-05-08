<?php
    session_start();

    unset($_SESSION['isLogged']);
    unset($_SESSION['user']);

    header('Location: index.php');
    exit;