<?php

$starship_id = $_GET['starship_id'];

session_start();
$table_rows = $_SESSION['table_rows'];

$pdo = new PDO('sqlite:starships.sqlite');

$delete_starship_query = $pdo->prepare("DELETE FROM starships WHERE name = ?");
$delete_starship_query->execute([$table_rows[$starship_id][0]]);
$num_of_deleted_rows = $delete_starship_query->rowCount();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Deleted starship</title>
    </head>
    <body>
        <?php if ($num_of_deleted_rows == 1): ?>
            La nave ha sido eliminada.
        <?php else: ?>
            Disculpa, la nave no ha podido ser eliminada.
        <?php endif; ?>
    </body>
</html>