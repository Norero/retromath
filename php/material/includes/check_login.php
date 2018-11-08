<?php

$id_sesion = null;

if (isset($_GET['id_sesion'])) {
    $id_sesion = htmlspecialchars($_GET['id_sesion']);
}

if ($id_sesion == null) {
    echo "sesion no ingresada";
    return;
}

    $result = $connection->query('SELECT id_sesion FROM `sesiones`
    INNER JOIN usuarios ON usuarios.id_run = (SELECT id_run FROM sesiones WHERE id_sesion = "' . $id_sesion . '")
    where sesiones.id_run = usuarios.id_run
    ORDER BY id_sesion DESC
    LIMIT 1');

    if ($result->num_rows == 0) {
        echo "sesion no validad";
        $id_sesion = null;
        return;
    }
    
    $fila = $result->fetch_row()[0];
    
    if ($fila != $id_sesion) {
        echo "sesion vencida";
        $id_sesion = null;
        return;
    }

