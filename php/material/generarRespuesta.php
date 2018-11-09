<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require "includes/db.php";
require "includes/check_login.php";

$outp = null;

if ($id_sesion == null) {
    $outp .= " Falta Usuario";

}

$id_pregunta = htmlspecialchars($_GET['id_pregunta']);
$id_alternativa = htmlspecialchars($_GET['id_alternativa']);
$tiempo_respuesta = htmlspecialchars($_GET['tiempo_respuesta']);

if ($id_pregunta == null) {
    $outp .= " Falta id de la pregunta";
}

if ($id_alternativa == null) {
    $outp .= " Falta id de la alternativa";
}

if ($tiempo_respuesta == null) {
    $outp .= " Falta id de la tiempo";

}

//  http://46.101.232.235/php/material/generarRespuesta.php?id_sesion=5&id_pregunta=1&id_alternativa=1&tiempo_respuesta=00:22:00
if ($outp == null) {
    $result = $connection->query("INSERT INTO interacion_pregunta(id_sesion, id_pregunta, id_alternativa, tiempo_respuesta)
									VALUES ('" . $id_sesion . "','" . $id_pregunta . "','" . $id_alternativa . "','" . $tiempo_respuesta . "')");
}
$outp .= $result;

echo ($outp);
