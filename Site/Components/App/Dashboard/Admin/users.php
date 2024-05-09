<?php include "../Database/connect.php"; include "../Database/loginCheck.php"; verifyLogin($mysqli); adminOnly();?>
<h1 class="mb-4"><i class="fa-light fa-users-rectangle"></i> Utilizadores</h1><a class="btn btn-outline-dark m-3" href="dashboard.php"><i class="fa-light fa-left-to-line"></i> Voltar</a><a class="btn btn-outline-dark" href="dashboard.php?menu=register"><i class="fa-light fa-user-plus"></i> Adicionar conta</a>
<form id = "form" action="./Components/Database/registerSubmit.php" method="POST">
<table class="table">
    <thead>
        <tr>
            <th><i class="fa-light fa-user"></i> Utilizador</th>
            <th><i class="fa-light fa-nfc-symbol"></i> Tag NFC</th>
            <th><i class="fa-light fa-user-crown"></i> Administrador</th>
            <th><i class="fa-light fa-screwdriver-wrench"></i> Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $list = $mysqli->query("SELECT * FROM `users` ORDER BY `users`.`admin` DESC");

            if($list->num_rows > 0) {
                while($row = $list->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=ucfirst($row['name'])?></td>
                        <td><?=$row['tag']?></td>
                        <td><?=($row['admin'] ? "<i class='fa-solid fa-check' style='color: #00B815'></i>" : "<i class='fa-solid fa-xmark' style='color: #E00000'></i>")?></td>
                        <td>
                            <a class="btn btn-outline-dark btn-sm" href="dashboard.php?menu=rfid&user=<?=$row['name']?>"><i class="fa-light fa-nfc"></i> Alterar tag NFC</a>
                            <a class="btn btn-outline-dark btn-sm" href="dashboard.php?menu=recover&user=<?=$row['name']?>"><i class="fa-light fa-rotate"></i> Repor password</a>
                            <?php if(!$row['admin']) { ?>
                                <a class="btn btn-outline-dark btn-sm" href="dashboard.php?menu=delete&user=<?=$row['name']?>"><i class="fa-light fa-delete-left"></i> Excluir conta</a> 
                            <?php } ?>
                        </td>
                    </tr>
                <?php
                }
            } else {
                echo "No data";
            }
        ?>
    </tbody>