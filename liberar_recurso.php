<?php
	include 'session.php';

	$idusuario=$_REQUEST['idusuario'];
	$idreserva=$_REQUEST['idreserva'];
	$idreserva_recurso=$_REQUEST['idreserva_recurso'];
	date_default_timezone_set("Europe/Madrid");
	$localdatelib=date("Y-m-d H:i:s");

	$liberar="UPDATE `reserva`
		INNER JOIN `usuario` ON `reserva`.`idusuario`=`usuario`.`idusuario`
		INNER JOIN `reserva_recurso` ON `reserva`.`idreserva`=`reserva_recurso`.`idreserva_recurso`
		INNER JOIN `recurso` ON `recurso`.`idrecurso`=`reserva`.`idreserva`
		SET `reserva`.`disponibilidad` = 1, `reserva`.`idusuario` = NULL, `reserva_recurso`.`idreserva` = NULL, `reserva_recurso`.`fecha_hora_devolucion` = '$localdatelib'
		WHERE `usuario`.`idusuario` = '$idusuario' AND `reserva`.`idreserva` = '$idreserva' AND `reserva_recurso`.`idreserva_recurso` = '$idreserva_recurso'";

		mysqli_query($conexion, $liberar);
		header('Location: recursos.php');

?>