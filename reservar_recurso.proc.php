<?php
	session_start();
	include 'session.php';

	if (isset($_SESSION['username'])) {
	// $idusuario=$_REQUEST['idusuario'];
	// $idreserva=$_REQUEST['idreserva'];
	// $idreserva_recurso=$_REQUEST['idreserva_recurso'];
	// date_default_timezone_set("Europe/Madrid");
	// $localdateres=date("Y-m-d H:i:s");

	// $reservarUno="UPDATE `reserva` SET `idusuario`='$idusuario', `disponibilidad` = 0 WHERE `reserva`.`idreserva` = '$idreserva'";
	// mysqli_query($conexion, $reservarUno);

	// if ($reservarUno==true) {
	// 	$reservarDos="UPDATE `reserva_recurso` SET `idreserva` = '$idreserva', `fecha_hora_reserva` = '$localdateres' WHERE `reserva_recurso`.`idreserva_recurso` = '$idreserva_recurso'";
	// 	mysqli_query($conexion, $reservarDos);
	// }

	// header('Location: recursos.php');

	$idusuario=$_REQUEST['idusuario'];
	$idreserva=$_REQUEST['idreserva'];
	$idreserva_recurso=$_REQUEST['idreserva_recurso'];

	$fechaReserva = $_REQUEST['fechaReserva'];
	$hInicial = $_REQUEST['hInicial'];
	$hFinal = $_REQUEST['hFinal'];
	$nom_recurso = $_REQUEST['nom_recurso'];

	echo "$fechaReserva<br>";
	echo "$hInicial<br>";
	echo "$hFinal<br>";
	echo "$nom_recurso<br>";
	echo "idUsuario: $idusuario<br>";
	echo "idReserva: $idreserva<br>";
	echo "idReservaRecurso: $idreserva_recurso<br><br>";



	$qIdRecurso = "SELECT idrecurso FROM recurso WHERE nom_recurso='$nom_recurso'";
	$consulta=mysqli_query($conexion, $qIdRecurso);
	if (mysqli_num_rows($consulta)>0) {
		while ($result=mysqli_fetch_array($consulta)) {
			echo "El id es: $result[idrecurso], $nom_recurso <br>";
			$_SESSION['idrecurso'] = $result['idrecurso'];
			echo "SESION: $_SESSION[idrecurso] <br>";
		}
	}

	// $qInicio = "SELECT * FROM reserva_calendario WHERE fechaReserva='$fechaReserva'";
	// $consulta = mysqli_query($conexion,$qInicio);
	// if (mysqli_num_rows($consulta)<1) {
	// 	$qHora = "INSERT INTO reserva_calendario (idreserva, idrecurso, fecha, hora_inicio, hora_final)
	// 			VALUES ('$idreserva', '$_SESSION[idrecurso]', '$fechaReserva', '$hInicial', '$hFinal')";
	// 		echo "$qHora";
	// 		// $consulta=mysqli_query($conexion, $qHora);
	// }
	

	$q = "SELECT hora_inicio FROM reserva_calendario WHERE fecha='$fechaReserva'";
	echo "$q<br>";
	$consulta = mysqli_query($conexion,$q);
	$cont = mysqli_num_rows($consulta);
	echo "CONT: $cont <br>";
	if (mysqli_num_rows($consulta)>0) {
		for ($i=1; $i <= $cont ; $i++) { 
			$result=mysqli_fetch_array($consulta);
			$arrayHI[$i] = $result['hora_inicio'];
		}
		// while ($result=mysqli_fetch_array($consulta)) {
		// 	echo "2017-12-17: nombre $result[nom] <br>";
		// }
	}
	// echo "xxx: $cont";
	for ($x=1; $x <= $cont ; $x++) {
		$q2="SELECT hora_final FROM reserva_calendario WHERE hora_inicio='$arrayHI[$x]' AND fecha='$fechaReserva'";
		echo "$q2 <br>";
		$consulta2 = mysqli_query($conexion,$q2);
		$result2=mysqli_fetch_array($consulta2);
		$arrayHF[$x] = $result2['hora_final'];
		// $contF = mysqli_num_rows($consulta);
		// echo "CONT: $cont <br>";
		// if (mysqli_num_rows($consulta2)>0) {
		// 	for ($z=1; $z <= $cont ; $z++) { 
		// 		$result2=mysqli_fetch_array($consulta2);
		// 		$arrayHF[$z] = $result2['cognom'];
		// 	}
		// } 		
	}
	echo "<br><br>";
	echo "Hi: $hInicial <br>";
	echo "Hf: $hFinal <br>";

	$contadorH = 0;
	echo "CONTHHHH: $contadorH<br>";
	for ($z=1; $z <=$cont ; $z++) { 
		echo "$arrayHI[$z] $arrayHF[$z] <br>";
		if ($hInicial > $arrayHI[$z]) {
			if ($hInicial < $arrayHF[$z]) {
				echo "Esta hora esta dentro de un rango reservado <br>";
				$contadorH=$contadorH+1;
			}
		}
		if ($hInicial == $arrayHI[$z]) {
			echo "Hora introducida es igual a una reserva <br>";
			$contadorH=$contadorH+1;
		}

		if ($hInicial < $arrayHI[$z]) {
			if ($hFinal > $arrayHI[$z]) {
				if ($hFinal <= $arrayHF[$z]) {
					$contadorH=$contadorH+1;
				}
			}
		}
		// if ($hInicial == $arrayHI[$z]) {
		// 	echo "ERROR la hora introducida ya es la hora inicial de otra reserva: $hInicial = $arrayHI[$z]<br>";
		// }
		// if ($hInicial>$arrayHI[$z]) {
		// 	if ($hFinal<$arrayHF[$z]) {
		// 		echo "$hInicial  >$arrayHI[$z] AND $hFinal < $arrayHF[$z], dentro?";
		// 	}

		// }
		// if ($hInicial<$arrayHF[$z]) {
		// 	echo "$hInicial < $arrayHF[$z]";
		// 	echo "ERROR, la hora esta en un rango ya reservado: $hInicial <br>";
		// }
				
	}

	if ($contadorH == 0) {
			echo "CONT CONDICIONAL: $contadorH <br>";
			$qHora = "INSERT INTO reserva_calendario (idreserva, idrecurso, fecha, hora_inicio, hora_final, usuario)
				VALUES ('$idreserva', '$_SESSION[idrecurso]', '$fechaReserva', '$hInicial', '$hFinal', '$_SESSION[username]')";
			echo "$qHora<br>";
			$consulta=mysqli_query($conexion, $qHora);

			$reservarUno="UPDATE `reserva` SET `idusuario`='$idusuario' WHERE `reserva`.`idreserva` = '$idreserva'";
			mysqli_query($conexion, $reservarUno);
			echo "Se permite esta hora <br>";
			$_SESSION['errorH']="";
			$_SESSION['successH']="Recurso reservado correctamente!";
			echo "sss: $_SESSION[successH] <br>";
			header("location: reservar_recurso.php?idusuario=$idusuario&idreserva=$idreserva&idreserva_recurso=$idreserva_recurso&idusuario=$idusuario&nom_recurso=$nom_recurso");
		}else{
			$_SESSION['errorH']="ERROR, recurso reservado!";
			echo "sss: $_SESSION[errorH]<br>";
			$_SESSION['successH']="";
			header("location: reservar_recurso.php?idusuario=$idusuario&idreserva=$idreserva&idreserva_recurso=$idreserva_recurso&idusuario=$idusuario&nom_recurso=$nom_recurso");
			echo "Esta hora ya esta reservado por otro usuario <br>";
		}

	// echo $contadorH;
	// if ($contadorH == 1) {
	// 	echo "Esta hora ya esta reservado por otro usuario";
	// }else{
	// 	echo "Se permite esta hora";
	// }

	// for ($i=9; $i < 11 ; $i++) { 
	// 	echo "$i <br>";
	// }
	// $idrecurso=$_SESSION['idrecurso'];
	// $q = "SELECT * FROM reserva_recurso WHERE idrecurso='$idrecurso'";
	// $consulta=mysqli_query($conexion, $q);
	// echo "$q <br>";
	// if (mysqli_num_rows($consulta)>0) {
	// 	$qFecha = "SELECT fecha FROM reserva_recurso WHERE idrecurso='$idrecurso'";
	// 	echo "$qFecha <br>";
	// 	$consulta=mysqli_query($conexion, $qFecha);
	// 	if (mysqli_num_rows($consulta)>0) {
	// 		$qHoraInicio = "SELECT hora_inicio FROM reserva_recurso WHERE idrecurso='$idrecurso' AND fecha='$fechaReserva'";
	// 		$consulta=mysqli_query($conexion, $qHoraInicio);
	// 		echo "$qHoraInicio <br>";	
	// 		if (mysqli_num_rows($consulta)>0) {
	// 			$qHoraFinal = "SELECT hora_final FROM reserva_recurso WHERE idrecurso='$idrecurso' AND fecha='$fechaReserva' AND hora_inicio='$hInicial'";
	// 			$consulta=mysqli_query($conexion, $qHoraFinal);
	// 			echo "$qHoraFinal <br>";	
	// 		}else{
	// 			echo "Hora final no es valida <br>";
	// 		}		
	// 	}else{
	// 		echo "Hora inicial es valida! <br>";
	// 	}
	// }else{
	// 	echo "Fecha introducida valida <br>";
	// }

	// echo "$fechaReserva<br>";
	// echo "$hInicial<br>";
	// echo "$hFinal<br>";
	// echo "$nom_recurso<br>";
	// echo "idUsuario: $idusuario<br>";
	// echo "idReserva: $idreserva<br>";
	// echo "idReservaRecurso: $idreserva_recurso<br>";
	}


