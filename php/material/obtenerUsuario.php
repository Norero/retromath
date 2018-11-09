<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require "includes/db.php";
require "includes/check_login.php";

if ($id_sesion == null) {
    echo "Falta Usuario";
    return;
}

$outp = null;

//  http://46.101.232.235/php/material/obtenerUsuario.php?id_sesion=3
$result = $connection->query("SELECT DISTINCT usuarios.id_run, retroMath, id_colegio, nombre, nick, rut, monedas, puntos FROM usuarios
INNER JOIN sesiones ON usuarios.id_run = (SELECT id_run FROM sesiones WHERE id_sesion = '" . $id_sesion . "')");

while ($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    $outp .= '{"id_run":"' . $rs["id_run"] . '",';
    $outp .= '"retroMath":"' . $rs["retroMath"] . '",';
    $outp .= '"id_colegio":"' . $rs["id_colegio"] . '",';
    $outp .= '"nombre":"' . $rs["nombre"] . '",';
    $outp .= '"nick":"' . $rs["nick"] . '",';
    $outp .= '"rut":"' . $rs["rut"] . '",';
    $outp .= '"monedas":"' . $rs["monedas"] . '",';
    $outp .= '"puntos":"' . $rs["puntos"] . '"}';
}

echo ($outp);
