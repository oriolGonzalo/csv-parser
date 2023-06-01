<?php

session_start();
$table_headers = $_SESSION['table_headers'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            ul {
                list-style: none;
            }
            label {
                display: flex;
                flex-direction: row;
                justify-content: flex-end;
                text-align: right;
                width: 400px;
                line-height: 26px;
                margin-bottom: 10px;
            }

            input {
                height: 20px;
                flex: 0 0 200px;
                margin-left: 10px;
            }
            .button {
                padding-left: 190px;
            }
        </style>
        <title>Add starship</title>
    </head>
    <body>
        <form method="post" action="/add_starship">
            <ul>
                <?php foreach ($table_headers as $table_header): ?>
                    <li>
                        <label>
                            <?php echo $table_header; ?>: <input type="text" name="<?php echo $table_header; ?>" />
                        </label>
                    </li>
                <?php endforeach; ?>
                <li class="button">
                    <button type="submit">Añadir nave</button>
                </li>
            </ul>
        </form>
    </body>
</html>