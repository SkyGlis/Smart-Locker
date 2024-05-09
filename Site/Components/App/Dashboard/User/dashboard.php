<div class="position-absolute top-50 start-50 translate-middle">
    <h1><i class="fa-light fa-table-columns"></i> Dashboard</h1>
    <p class="mb-4 lead mb-3"><i class="fa-light fa-hand-wave"></i> Bem-vindo(a), <b><?=ucfirst($name)?></b></p>
    <div class="d-grid gap-2 d-md-flex justify-content-md-middle">
        <a class="btn btn-outline-dark btn-lg me-md-2" href="dashboard.php?menu=reset"><i class="fa-light fa-address-card"></i> Alterar a palavra-passe</a>
        <a class="btn btn-outline-dark btn-lg me-md-2" href="dashboard.php?menu=history"><i class="fa-light fa-inboxes"></i> Ver histórico</a>
        <?php 
            if($admin) { ?>
                <a class="btn btn-outline-dark btn-lg" href="dashboard.php?menu=users"><i class="fa-light fa-users-rectangle"></i> Utilizadores</a>
        <?php } ?>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-middle mt-3">
        <a class="link-opacity-50-hover" style="color: black" href="logout.php"><i class="fa-light fa-door-open"></i> Terminar Sessão</a>
    </div>
</div>