<?php

$pdo = new PDO('sqlite:starships.sqlite');

$sql = "INSERT INTO starships (
    name, model, manufacturer, cost_in_credits, length, max_atmosphering_speed, crew, passengers,
    cargo_capacity, consumables, hyperdrive_rating, MGLT, starship_class, created, edited, url 
) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$insert_starship_query= $pdo->prepare($sql);
$insert_starship_query->execute([
    $_POST['name'], $_POST['model'], $_POST['manufacturer'], $_POST['cost_in_credits'], 
    $_POST['length'], $_POST['max_atmosphering_speed'], $_POST['crew'], $_POST['passengers'], 
    $_POST['cargo_capacity'], $_POST['consumables'], $_POST['hyperdrive_rating'], $_POST['MGLT'], 
    $_POST['starship_class'], $_POST['created'], $_POST['edited'], $_POST['url'], 
]);
$num_of_added_rows = $insert_starship_query->rowCount();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Deleted starship</title>
    </head>
    <body>
        <?php if ($num_of_added_rows == 1): ?>
            La nave ha sido añadida.
        <?php else: ?>
            Disculpa, no se ha podido añadir la nave.
        <?php endif; ?>
    </body>
</html>