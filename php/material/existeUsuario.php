<?php

header("Access-Control-Allow-Origin: *");

require "includes/db.php";

$id_run = htmlspecialchars($_GET['id_run']);

if ($id_run == null) {
    echo "Falta run";
    return;
}

//  http://46.101.232.235/php/material/existeUsuario.php?id_run=19492167
$result = $connection->query("SELECT DISTINCT id_run  FROM usuarios where id_run = '" . $id_run . "' ");

if ($result->num_rows > 0) {
    echo ("true");
} else {
    echo ("false");
}
