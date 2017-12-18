<?php
	session_start();
	include 'session.php';
	if (isset($_SESSION['username'])){

		$idrecurso=$_REQUEST['idrecurso'];
		$fecha=$_REQUEST['fecha'];
		$hora_inicio=$_REQUEST['hora_inicio'];
		$hora_final=$_REQUEST['hora_final'];
		$q = "DELETE FROM reserva_calendario WHERE idrecurso='$idrecurso' AND hora_inicio='$hora_inicio' AND hora_final='$hora_final' AND fecha='$fecha'";
		echo $q;
		$consulta = mysqli_query($conexion, $q);
		header('location: reservaUsuario.php');
	}
