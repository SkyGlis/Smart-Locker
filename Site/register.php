<html>
    <head>
        <title>Smart Locker | Registo</title>
        <link rel="icon" type="image/x-icon" href="./Assets/lock-48.ico">
        <link rel="stylesheet" href="./Assets/index.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include "./navbar.php" ?>
        <div class="position-absolute top-50 start-50 translate-middle">
        <h1>Registo</h1><br>
            <form id = "form" action="registerSubmit.php" method="POST">
                Nome <br><input type="text" name="name" class="form-control" placeholder="Nome" required> <br/>
                Email <br><input type="text" name="email" class="form-control" placeholder="Email" required> <br/>
                Palavra-Passe<br><input type="password" name="password" class="form-control" placeholder="Palava-Passe" required><br><br>
                Deseja receber notificações? <input type="checkbox" name="notified"> <br><br>
                <input name="submit" type="submit" class="btn btn-outline-dark">
            </form>
            <div id="alertMessage"></div>
        </div>
        <?php include "./footer.php" ?>
    </body>
    <?php
        session_start();
        
        if((isset($_SESSION['redirected']) && $_SESSION['redirected'] === TRUE)) {
            unset($_SESSION['redirected']);

            $status = $_SESSION['status'];
            $message = $_SESSION['message'];

            echo "<script>
                var status = {$status};
                var message = '$message';
            </script>";

            unset($_SESSION['status']);
            unset($_SESSION['message']);
        }
    ?>
    <script>
        const alert = (status, message) => {
            const alertPlaceholder = document.getElementById('alertMessage')
            console.log(status);

            const wrapper = document.createElement('div')
            wrapper.innerHTML = [
                `<div class="alert alert-${status == 1 ? 'success' : 'warning'} alert-dismissible" role="alert">`,
                `   <div>${message}</div>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                '</div>'
            ].join('')

            alertPlaceholder.append(wrapper);
        }

        alert(status, message);
    </script>
</html>