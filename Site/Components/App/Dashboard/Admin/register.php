<?php include "../Database/connect.php"; include "../Database/loginCheck.php"; verifyLogin($mysqli); adminOnly();?>
<div class="position-absolute top-50 start-50 translate-middle">
<h1><i class="fa-light fa-user-plus"></i> Adicionar conta</h1><a class="btn btn-outline-dark m-3" href="dashboard.php?menu=users"><i class="fa-light fa-left-to-line"></i> Voltar</a><br>
    <form id = "form" action="./Components/Database/registerSubmit.php" method="POST">
        Nome <br><input type="text" name="name" class="form-control" placeholder="Nome" required>
        Tag <br><input type="text" name="tag" class="form-control" placeholder="Tag RFID" required>
        Palavra-Passe<br><input type="password" name="password" class="form-control" placeholder="Palava-Passe" required><br>
        <i class="fa-light fa-circle-check"></i> Confirme a palavra-passe<br><input type="password" name="confirmpassword" class="form-control" placeholder="Confirme a password" required><br><br>
        Criar como conta de administrador? <input type="checkbox" name="admin"> <br><br>
        <input name="submit" type="submit" class="btn btn-outline-dark">
    </form>
    <div id="alertMessage"></div>
</div>
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