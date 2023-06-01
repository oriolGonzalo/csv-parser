<?php

const NUM_OF_COLUMNS_IN_SUMMARY = 4;

function get_table_headers(PDO $pdo)
{
    $query_table_headers = $pdo->query("PRAGMA table_info(starships)");
    $raw_table_headers = $query_table_headers->fetchAll(PDO::FETCH_NUM);

    $filtered_table_headers = [];

    for ($i = 0; $i < sizeof($raw_table_headers); $i++)
    {
        $filtered_table_headers[$i] = $raw_table_headers[$i][1]; #solo queremos el título de la columna
    }

    return $filtered_table_headers;
}

function get_table_headers_summary(Array $all_table_headers)
{
    $table_headers_summary = $all_table_headers;
    $table_headers_summary = array_slice($all_table_headers, 0, 4);
    $replacement = array(3 => "acciones");
    $table_headers_summary = array_replace($table_headers_summary, $replacement);   

    return $table_headers_summary;
}

function get_table_rows(PDO $pdo)
{
    $query_table_rows = $pdo->query("SELECT * FROM starships");
    $table_rows = $query_table_rows->fetchAll(PDO::FETCH_NUM);

    return $table_rows;
}

$pdo = new PDO('sqlite:starships.sqlite');

$all_table_headers = get_table_headers($pdo); # Obtenemos los títulos de todas las columnas
$table_headers_summary = get_table_headers_summary($all_table_headers); # Nos quedamos con los títulos de las columnas que mostraremos en el resumen
$table_rows = get_table_rows($pdo);

// Guardamos la información en la sesión para evitar tener que obtener de nuevo los títulos y filas en otras páginas
session_start();
$_SESSION['table_headers'] = $all_table_headers;
$_SESSION['table_rows'] = $table_rows;

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            <?php require_once( __DIR__ . "/../public/styles.css"); ?>
        </style>
        <title>Starships summary</title>
    </head>
    <body>
        <div class="table-wrapper">
            <form method="post" action="/add_starship_form?">
                <input class="add" type="submit" value="Añadir nave" autofocus="autofocus" />
            </form>
            <table border="1">
                <tbody>
                    <tr>
                    <?php for ($i = 0; $i < NUM_OF_COLUMNS_IN_SUMMARY; $i++): ?>
                        <th><?php echo $table_headers_summary[$i]; ?></th>
                    <?php endfor; ?>
                    </tr>
                    <?php foreach ($table_rows as $row_index => $table_row): ?>
                        <tr>
                        <?php for ($i = 0; $i < NUM_OF_COLUMNS_IN_SUMMARY; $i++): ?>
                            <?php if ($i == (NUM_OF_COLUMNS_IN_SUMMARY - 1)): ?>
                                <td>
                                    <form method="post" action="/show_starship_detail?starship_id=<?php echo $row_index ?>">
                                        <input class="cell" type="submit" value="Ver detalle del registro" />
                                    </form>
                                    <form method="post" action="/delete_starship?starship_id=<?php echo $row_index ?>">
                                        <input class="cell" type="submit" value="Eliminar registro" />
                                    </form>
                                </td>
                            <?php else: ?>
                                <td><?php echo $table_row[$i]; ?></td>
                            <?php endif; ?>
                        <?php endfor; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>