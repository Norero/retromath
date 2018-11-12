<?php

header("Access-Control-Allow-Origin: *");

require "includes/db.php";

$id_run = htmlspecialchars($_GET['id_run']);
$colegio = htmlspecialchars($_GET['colegio']);
$nombre = htmlspecialchars($_GET['nombre']);
$nick = htmlspecialchars($_GET['nick']);
$rut = htmlspecialchars($_GET['rut']);
$claveUsuario = htmlspecialchars($_GET['claveUsuario']);

if ($id_run == null) {
    echo "Falta run";
    return;
}

//  http://46.101.232.235/php/material/existeUsuario.php?id_run=19492167
$result = $connection->query("SELECT Crear_Usuario('" . $id_run . "','" . $colegio . "','" . $nombre . "','" . $nick . "','" . $rut . "','" . $claveUsuario . "')");
