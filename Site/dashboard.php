<html>
    <head>
        <title>Smart Locker | Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="./Assets/lock-48.ico">
        <link rel="stylesheet" href="./Assets/index.css">
        <link rel="stylesheet" href="./Assets/fontawesome/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include "./Components/App/navbar.php" ?>
        <?php include "./Components/Database/loginCheck.php"; include "./Components/Database/connect.php"; verifyLogin($mysqli); loginRedirect()?>
        <?php session_start();
            $user = $_SESSION['user']; 
            $admin = $user['admin'];
            $name = $user['name'];

            if(!isset($_GET['menu'])) {
                include "./Components/App/Dashboard/User/dashboard.php";
            } else if($_GET['menu'] == "history") {
                include "./Components/App/Dashboard/User/logsList.php";
            } else if($_GET['menu'] == "reset") {
                include "./Components/App/Dashboard/User/passwordReset.php";
            } else if($_GET['menu'] == "register") {
                include "./Components/App/Dashboard/Admin/register.php";
            } else if($_GET['menu'] == "users") {
                include "./Components/App/Dashboard/Admin/users.php";
            } else if($_GET['menu'] == "rfid" && $_GET['user']) {
                include "./Components/App/Dashboard/Admin/rfid.php";
            } else if($_GET['menu'] == "recover" && $_GET['user']) {
                include "./Components/App/Dashboard/Admin/recover.php";
            } else if($_GET['menu'] == "delete" && $_GET['user']) {
                include "./Components/App/Dashboard/Admin/delete.php";
            } else {
                include "./Components/App/Dashboard/User/dashboard.php";
            }
        ?>
        <?php include "./Components/App/footer.php" ?>
    </body>
</html>