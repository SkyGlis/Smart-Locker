<h1 class="mb-4"><i class="fa-light fa-inboxes"></i> Histórico</h1><a class="btn btn-outline-dark" href="dashboard.php"><i class="fa-light fa-left-to-line"></i> Voltar</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th><i class="fa-light fa-calendar-days"></i> Data</th>
            <th><i class="fa-light fa-clock"></i> Hora</th>
            <th><i class="fa-light fa-user"></i> Utilizador</th>
            <th><i class="fa-light fa-lock-keyhole"></i> Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php
            ini_set('display_errors', 1);

            $list = $mysqli->query("SELECT * FROM `logs` ORDER BY `logs`.`date` DESC");

            if($list->num_rows > 0) {
                while($row = $list->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=date("d/m/Y", strtotime($row['date']))?></td>
                        <td><?=date("H:i:s", strtotime($row['date']))?></td>
                        <td><?=$row['user']?></td>
                        <td><?=($row['success'] ? "<i class='fa-solid fa-check' style='color: #00B815'></i>" : "<i class='fa-solid fa-xmark' style='color: #E00000'></i>")?></td>
                    </tr>
                <?php
                }
            } else {
                echo "No data";
            }
        ?>
    </tbody>