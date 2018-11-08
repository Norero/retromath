<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require "includes/db.php";
require "includes/check_login.php";

if ($id_sesion == null) {
    echo "Falta Usuario";
    return;
}

if ($_GET['id_tema']) {
    $id_tema = htmlspecialchars($_GET['id_tema']);
}

$outp = null;

if ($id_tema == null) {
    echo "Falta id del tema";
    return;
}

//  http://localhost/retroMath/material/obtenerPreguntas.php?id_sesion=3&id_tema=1
$result = $connection->query("SELECT id_pregunta, contenido, monedas_dar, puntos_dar FROM preguntas
    WHERE id_tema = '" . $id_tema . "'");

$outp = '{"todasPreguntas":[';
while ($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != '{"todasPreguntas":[') {$outp .= ",\n\t";}
    $outp .= '{"id_pregunta":"' . $rs["id_pregunta"] . '",';
    $outp .= '"contenido":"' . $rs["contenido"] . '",';
    $outp .= '"monedas_dar":"' . $rs["monedas_dar"] . '",';
    $outp .= '"puntos_dar":"' . $rs["puntos_dar"] . '"}';
}
$outp .= ']}';

echo ($outp);
