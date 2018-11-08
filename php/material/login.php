<?php

	require "includes/db.php";

	$P_usuario = htmlspecialchars($_GET['usuario']);
	$P_clave = htmlspecialchars($_GET['clave']);


	if ($P_usuario == null or $P_clave == null) {
		echo "Falta Usuario o la clave";
		return;
	}

	//http://localhost/retroMath/material/login.php?usuario=19492167&clave=admin
	$result = $connection->query('SELECT USER.id_run, USER.clave_usuario, USER.retroMath
		FROM usuarios AS USER
		WHERE USER.id_run ="' . $P_usuario . '" and
		USER.clave_usuario ="' . $P_clave . '"');

	if ($result->num_rows == 0) {
		echo "Usuario no encontrado";
		return;
	}
	else{

		$filaUsuario = $result->fetch_row();
		$retroMath = $filaUsuario[2];
		$id_sesion = $connection->query('SELECT Agregar_Sesion(' . $filaUsuario[0] . ')');
		$id_sesion = $id_sesion->fetch_row()[0];

		echo ("[".$id_sesion .",".$retroMath."]");
	}

