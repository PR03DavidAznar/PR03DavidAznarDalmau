<?php

	session_start();

	if(isset($_SESSION['username'])) {
		// header("location: 171124_principal.php");
		if (isset($_REQUEST['id'])) {

			if (isset($_REQUEST['siRol'])) {
				include("session.php");
				
				if (isset($_REQUEST['nombre_usuario'])&&($_REQUEST['rol'])&&($_REQUEST['password_usuario'])&&($_REQUEST['password_usuario2'])) {
				
				include("session.php");
				$nombre_usuario = $_REQUEST['nombre_usuario'];
				$rol = $_REQUEST['rol'];
				$password_usuario = $_REQUEST['password_usuario'];
				$password_usuario2 = $_REQUEST['password_usuario2'];

					if ($password_usuario == $password_usuario2) {
							if ($password_usuario == is_null()&&($password_usuario == is_null())) {
								$q = "UPDATE usuario SET alias='$nombre_usuario', usu_nivel='$rol' WHERE alias='$_REQUEST[id]'";
							}else{
								// $password_encriptado = md5($_REQUEST['password_usuario']);
								$q = "UPDATE usuario SET alias='$nombre_usuario', usu_nivel='$rol', pwd='$password_usuario' WHERE alias='$_REQUEST[id]'";
								//echo $q;
							}
							$resultado = mysqli_query($conexion, $q);
							$_SESSION['error']="";
							$_SESSION['success']="Los cambios se han aplicado correctamente!";
							if ($_REQUEST['id'] == $_SESSION['username']) {
								$_SESSION['username']="$nombre_usuario";
							}
							header("location:principal.php");
					}else{
						$_SESSION['error']="Las contraseñas no coinciden!";
						header("location:insertar_modificar.php");
					}

				// echo $q;
				// echo "TOT";
				}else if (isset($_REQUEST['nombre_usuario'])&&($_REQUEST['rol'])){
					include("session.php");
					$nombre_usuario = $_REQUEST['nombre_usuario'];
					$rol = $_REQUEST['rol'];
					$q = "UPDATE usuario SET alias='$nombre_usuario', usu_nivel='$rol' WHERE alias='$_REQUEST[id]'";
					$resultado = mysqli_query($conexion, $q);
					//echo $q;
					$_SESSION['error']="";
					$_SESSION['success']="Los cambios se han aplicado correctamente!";
					if ($_REQUEST['id'] == $_SESSION['username']) {
						$_SESSION['username']="$nombre_usuario";
					}
					header("location:principal.php");
					// echo $q;
					// echo "NO TOT";
				}
			}else{
				if (isset($_REQUEST['nombre_usuario'])&&($_REQUEST['password_usuario'])&&($_REQUEST['password_usuario2'])) {
					include("session.php");
					$nombre_usuario_noRol = $_REQUEST['nombre_usuario'];
					$password_usuario_noRol = $_REQUEST['password_usuario'];
					$password_usuario2_noRol = $_REQUEST['password_usuario2'];

					if ($password_usuario_noRol == $password_usuario2_noRol) {
							// if ($password_usuario == is_null()&&($password_usuario == is_null())) {
							// 	$q = "UPDATE usuario SET alias='$nombre_usuario' WHERE alias='$_REQUEST[id]'";
							// 	echo $q;
							// 	$resultado = mysqli_query($conexion, $q);
							// 	$_SESSION['error']="";
							// 	$_SESSION['success']="Los cambios se han aplicado correctamente111!";
							// }else{
								include("session.php");
								// $password_encriptado_noRol = md5($_REQUEST['password_usuario']);
								$q = "UPDATE usuario SET alias='$nombre_usuario_noRol', pwd='$password_usuario_noRol' WHERE alias='$_REQUEST[id]'";
								echo $q;
								$resultado = mysqli_query($conexion, $q);
								$_SESSION['error']="";
								$_SESSION['success']="Los cambios se han aplicado correctamente22222!";
								if ($_REQUEST['id'] == $_SESSION['username']) {
									$_SESSION['username']="$nombre_usuario";
								}
							// }
							header("location:principal.php");
					}else{
						include("session.php");
						$_SESSION['error']="Las contraseñas no coinciden!";
						header("location:insertar_modificar.php");
					}
				}else if (isset($_REQUEST['nombre_usuario'])) {
					include("session.php");
					$nombre_usuario = $_REQUEST['nombre_usuario'];
					$q = "UPDATE usuario SET alias='$nombre_usuario' WHERE alias='$_REQUEST[id]'";
					//echo $q;
					$resultado = mysqli_query($conexion, $q);
					//echo $q;
					$_SESSION['error']="";
					$_SESSION['success']="El nombre de usuario se ha modificado!";
					if ($_REQUEST['id'] == $_SESSION['username']) {
						$_SESSION['username']="$nombre_usuario";
					}

					header("location:principal.php");
					// echo $q;
					// echo "NO TOT";
				}
			}
		}else{
		///--------------------------------
			include("session.php");
			if (isset($_REQUEST['nombre_usuarioNew'])&&($_REQUEST['rolNew'])&&($_REQUEST['password_usuarioNew'])&&($_REQUEST['password_usuario2New'])) {
				$nombre_usuario = $_REQUEST['nombre_usuarioNew'];
				$rol = $_REQUEST['rolNew'];
				$password_usuario = $_REQUEST['password_usuarioNew'];
				$password_usuario2 = $_REQUEST['password_usuario2New'];

				$qUser = "SELECT alias FROM usuario WHERE alias='$nombre_usuario'";
				// echo $qUser;
				$resultadoUser = mysqli_query($conexion, $qUser);
				if(mysqli_num_rows($resultadoUser)>0){
					$datos_usuario=mysqli_fetch_array($resultadoUser);
					if ($nombre_usuario == $datos_usuario['alias']) {
						$_SESSION['successNew']="";
						$_SESSION['errorNew']="El usuario ya existe!";
						header("location:insertar_modificar.php");
						// echo "usu igual K.O";
					}
				}else if ($password_usuario == $password_usuario2) {
					// $password_encriptado = md5($_REQUEST['password_usuarioNew']);
					$q = "INSERT INTO usuario (alias, usu_nivel, pwd) VALUES ('$nombre_usuario', '$rol', '$password_usuario')";
					$resultado = mysqli_query($conexion, $q);
					//echo "passord OK";
					$_SESSION['errorNew']="";
					$_SESSION['successNew']="Los cambios se han aplicado correctamente!";
					header("location:insertar_modificar.php");
				}else{
					//echo "passord OK";
					$_SESSION['successNew']="";
					$_SESSION['errorNew']="Las contraseñas no coinciden!";
					header("location:insertar_modificar.php");
				}
			}
		}
	}


























			// }
			// if ($password_usuario == is_null()&&($password_usuario == is_null())) {
			// 	$q = "INSERT INTO usuario (alias, usu_nivel, pwd) VALUES ('$nombre_usuario', '$rol', '$password_encriptado')";
			// }else{
			// 	$q = "UPDATE usuario SET alias='$nombre_usuario', usu_nivel='$rol', pwd='$password_encriptado' WHERE alias='$_SESSION[id]'";
			// }
			// $resultado = mysqli_query($conexion, $q);
			// header("location:171124_principal.php?success=Los cambios se han aplicado correctamente!");
			// echo $q;
			// echo "TOT";
		// }else if (isset($_REQUEST['nombre_usuario'])&&($_REQUEST['rol'])){
		// 	$nombre_usuario = $_REQUEST['nombre_usuario'];
		// 	$rol = $_REQUEST['rol'];
		// 	$q = "UPDATE usuario SET alias='$nombre_usuario', usu_nivel='$rol' WHERE alias='$_SESSION[id]'";
		// 	$resultado = mysqli_query($conexion, $q);
		// 	header("location:171124_principal.php?success=Los cambios se han aplicado correctamente!");
		// 	// echo $q;
		// 	// echo "NO TOT";
		// }else{
		// 	header("location:171124_principal.php?error=Se ha producido un error, intentelo de nuevo!");
		// } 
		// }
		// }else{
		// 	header("location:171124_principal.php?error=Se ha producido un error, intentelo de nuevo!");
		// }
	// }
	//else {

		// $password_encriptado = md5($_REQUEST['password_usuario']);

		//echo $q;

		// $_SESSION['username']=$_REQUEST['nombre_usuario'];
		// $_SESSION['nivel']="usuario";
		// header("location:171124_principal.php");
	//}




