<div class="position-absolute top-50 start-50 translate-middle">
    <h1><i class="fa-light fa-address-card"></i> Alterar password</h1><a class="btn btn-outline-dark m-3" href="dashboard.php"><i class="fa-light fa-left-to-line"></i> Voltar</a><br>
    <form id = "form" action="./Components/Database/resetSubmit.php" method="POST">
        <i class="fa-light fa-lock"></i> Palavra-passe atual<br><input type="password" name="oldpassword" class="form-control" placeholder="Password atual" required> <br/>
        <i class="fa-light fa-key"></i> Nova palavra-passe<br><input type="password" name="password" class="form-control" placeholder="Nova password" required> <br/>
        <i class="fa-light fa-circle-check"></i> Confirme a palavra-passe<br><input type="password" name="confirmpassword" class="form-control" placeholder="Confirme a password" required><br><br>
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