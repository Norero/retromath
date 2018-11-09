<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require "includes/db.php";
require "includes/check_login.php";

if ($id_sesion == null) {
    echo "Falta Usuario";
    return;
}

$id_pregunta = htmlspecialchars($_GET['id_pregunta']);
$outp = null;

if ($id_pregunta == null) {
    echo "Falta id de la pregunta";
    return;
}

//  http://46.101.232.235/php/material/obteneralternativas.php?id_sesion=19492167&id_pregunta=1
$result = $connection->query("SELECT id_alternativa, id_pregunta, dato, correcta FROM alternativas AS a
    WHERE a.id_pregunta = '" . $id_pregunta . "'");

$outp = '{"todasAlternativas":[';
while ($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != '{"todasAlternativas":[') {$outp .= ",\n\t";}
    $outp .= '{"id_alternativa":"' . $rs["id_alternativa"] . '",';
    $outp .= '"id_pregunta":"' . $rs["id_pregunta"] . '",';
    $outp .= '"dato":"' . $rs["dato"] . '",';
    $outp .= '"correcta":"' . $rs["correcta"] . '"}';
}
$outp .= ']}';

echo ($outp);
