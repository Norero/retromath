<?php

header("Access-Control-Allow-Origin: *");

require "includes/db.php";

$rut = htmlspecialchars($_GET['rut']);
$id_run = htmlspecialchars($_GET['id_run']);
$claveUsuario = htmlspecialchars($_GET['claveUsuario']);

$outp = null;

if ($rut == null) {
    $outp .= " Falta rut";

}

if ($id_run == null) {
    $outp .= " Falta run";

}

if ($claveUsuario == null) {
    $outp .= " Falta claveUsuario";

}

//echo $outp;

if ($id_run == null) {
	//  http://46.101.232.235/php/material/existeUsuario.php?rut=19.492.167-5
    $result = $connection->query("SELECT DISTINCT id_run  FROM usuarios where rut = '" . $rut . "' ");
    $filaUsuario = $result->fetch_row();
    echo $filaUsuario[0];
} else {

    //  http://46.101.232.235/php/material/existeUsuario.php?id_run=19492167&claveUsuario=admin
    $result = $connection->query("SELECT DISTINCT id_run  FROM usuarios where id_run = '" . $id_run . "' AND clave_usuario = '" . $claveUsuario . "'");
    if ($result->num_rows != 0) {
        echo "true";
    } else {
        echo "false";
    }

}
