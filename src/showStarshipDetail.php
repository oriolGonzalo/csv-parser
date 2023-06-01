<?php

$starship_id = $_GET['starship_id'];

session_start();
$table_headers = $_SESSION['table_headers'];
$table_rows = $_SESSION['table_rows'];

/*
<?php for ($i = 0; $i < sizeof($table_rows[$starship_id]); $i++): ?>
    <tr><td scope="row"><?php echo $table_rows[$starship_id][$i]; ?></td></tr>
<?php endfor; ?>
*/

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            <?php require_once( __DIR__ . "/../public/styles.css"); ?>
        </style>
        <title>Starship detail</title>
    </head>
    <body>
        <table border="1">
            <tbody>
                <?php foreach ($table_headers as $index => $table_header): ?>
                    <tr>
                        <th scope="col"><?php echo $table_header; ?></th>
                        <td scope="col"><?php echo $table_rows[$starship_id][$index]; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
        </table>
    </body>
</html>