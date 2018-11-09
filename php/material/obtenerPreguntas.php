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

//  http://46.101.232.235/php/material/obtenerPreguntas.php?id_sesion=5&id_tema=1

$result = $connection->query("SELECT id_pregunta, contenido, monedas_dar, puntos_dar FROM preguntas
	WHERE id_tema = '" . $id_tema . "'
	ORDER BY id_pregunta");

$preguntaslistas = $connection->query("SELECT id_pregunta
FROM preguntas as preg
WHERE id_tema = '" . $id_tema . "' AND id_pregunta = ANY (SELECT DISTINCT interacion_pregunta.id_pregunta  FROM interacion_pregunta
						INNER JOIN sesiones ON sesiones.id_sesion = interacion_pregunta.id_sesion
						INNER JOIN usuarios ON sesiones.id_run = (SELECT id_run FROM sesiones WHERE id_sesion = '" . $id_sesion . "')
						INNER JOIN alternativas on alternativas.id_alternativa = interacion_pregunta.id_alternativa WHERE alternativas.correcta = 1)
ORDER BY id_pregunta");

$listas = $preguntaslistas->fetch_array(MYSQLI_ASSOC);

$outp = '{"todasPreguntas":[';
while ($rs = $result->fetch_array(MYSQLI_ASSOC)) {

    if ($listas["id_pregunta"] != $rs["id_pregunta"]) {

        if ($outp != '{"todasPreguntas":[') {$outp .= ",\n\t";}

        $outp .= '{"id_pregunta":"' . $rs["id_pregunta"] . '",';
        $outp .= '"contenido":"' . $rs["contenido"] . '",';
        $outp .= '"monedas_dar":"' . $rs["monedas_dar"] . '",';
        $outp .= '"puntos_dar":"' . $rs["puntos_dar"] . '"}';
    } else {
        $listas = $preguntaslistas->fetch_array(MYSQLI_ASSOC);
    }
}
$outp .= ']}';

echo ($outp);
