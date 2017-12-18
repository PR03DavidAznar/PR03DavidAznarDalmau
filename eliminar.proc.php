<?php

	session_start();

	if(isset($_SESSION['username'])) {
		if (isset($_REQUEST['id'])) {
			include("session.php");
			
			$q = "DELETE FROM usuario WHERE alias='$_REQUEST[id]'";
			$resultado = mysqli_query($conexion, $q);
			$_SESSION['error']="";
			$_SESSION['success']="El usuario se ha eliminado";
			header("location:principal.php");
			// echo $q;
		}else{
			$_SESSION['success']="";
			$_SESSION['error']="Error al eliminar el usuario";
			header("location:principal.php");
		}
	}
	//else {

		// $password_encriptado = md5($_REQUEST['password_usuario']);

		//echo $q;

		// $_SESSION['id']=$_REQUEST['nombre_usuario'];
		// $_SESSION['nivel']="usuario";
		// header("location:principal.php");
	//}




