<?php

	session_start();

	//si existe la variable id dentro del array $_SESSION, es que la sesión ha sido iniciada, y lo que hay que hacer es redirigir al usuario a la página principal
	if(isset($_SESSION['id'])){
		header("location: principal.php");
	//si no existe la variable de id dentro del array $_SESSION, es que no hay sesión, y por lo tanto, hay que consultar en la base de datos y hacer lo que sea (iniciar sesión y redirigir, o bien tirar 'para atrás')
	} else {
		include("conexion.php");

		//$password_encriptado = md5($_REQUEST['passwordUsuario']);
		$password = $_REQUEST['passwordUsuario'];
		//echo $password_encriptado;

		$q = "SELECT * FROM tbl_usuario WHERE nombreUsuario='$_REQUEST[nombreUsuario]' AND passwordUsuario='$password'";
		echo $q;
		echo $q;
		$resultado = mysqli_query($con, $q);
		if(mysqli_num_rows($resultado)>0){
			$datos_usuario=mysqli_fetch_array($resultado);
			$_SESSION['id']=$_REQUEST['nombreUsuario'];
			//$_SESSION['nivel']=$datos_usuario['usu_nivel'];
			header("location: principal.php");
		} else {
			$_SESSION['error']="Login incorrecto";
			header("location: index.php");
		}
	}

