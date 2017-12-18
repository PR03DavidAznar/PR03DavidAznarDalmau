<?php
	include 'session.php';

	if (isset($_POST['login'])) {
		$errors=array();

		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM `usuario` WHERE `alias` = '".$username."' AND `pwd` = '".$password."'";

		$result = mysqli_query($conexion, $sql);

		$row = mysqli_num_rows($result);
		// while ($result2=mysqli_fetch_array($row) {
		// 	$_SESSION['nivel'] = $result2['usu_nivel'];
		// }
		if(mysqli_num_rows($result)>0){
			$datos_usuario=mysqli_fetch_array($result);
			$_SESSION['username']=$username;
			$_SESSION['nivel']=$datos_usuario['usu_nivel'];
			header("location: principal.php");
		} else {
			session_destroy();
			array_push($errors, "Usuario o Contraseña incorrectos");
		}
	}

	// Comprueba que la opción "Cerrar Sesión" se ha seleccionado
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header('location: index.php');
	}
	// Cierrra la conexión con la Base de datos
	mysqli_close($conexion);

?>


<!-- 
		$row = mysqli_num_rows($result);
		if ($row==1) {
			session_start();
			$_SESSION['username'] = $username;	
			$_SESSION['nivel'] = $row['usu_nivel'];
			echo "$_SESSION[usu_nivel]";		
			echo "Bienvenido! ".$_SESSION['username'];
			echo "Nivel: " .$_SESSION['nivel'];
			// header('location: recursos.php');
		} -->