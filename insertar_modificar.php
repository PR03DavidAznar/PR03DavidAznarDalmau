


<?php
	session_start();
	include 'session.php';
	if (isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bienvenido a Escandio</title>


		<meta charset="utf-8">
		<!-- Glyphycons -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="window">
			<!-- Visualiza el Nombre de usuario y el botón Cerrar Sesión en el header -->
			<div class="user-login-view">
				<!-- Nombre de usuario -->
				<div class="user-view-left">
					<?php
						$nsql="SELECT * FROM `usuario` WHERE `alias`= '".$_SESSION['username']."'";
						$name = mysqli_query($conexion, $nsql);
						while ($resname=mysqli_fetch_array($name)) {
							echo "<p>Bienvenido ".$resname['nombre']." ".$resname['apellidos']."</p>";
							echo "<p>NIVEL: " .$resname['usu_nivel']."</p>";
						}
						// Continua el while del nombre más abajo...
					?>
				</div>
				<!-- Cerrar Sesión -->
				<div class="login-view-right">
					<a href="index.php?logout='1'" class="btn-logout"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesi&#243;n</a>
				</div>
			</div>

			<div class="contenedorTable">
				<br>

	<!-- MODIFICAR USUARIO -->
				<?php if (isset($_REQUEST['id'])){?>
				<h1>Modificar datos de usuario</h1>
				<form action="insertar_modificar.proc.php?id=<?php echo $_REQUEST['id']; ?>"  method="post">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input class="form-control" type="text" name="nombre_usuario" value="<?php echo $_REQUEST['id'] ?>" />
					</div><br>
					

							<?php if (isset($_REQUEST['permisos'])){ ?>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
						<input type="hidden" name="opc" value="modificar">
						<input type="hidden" name="siRol">
						<div id="modificarUser">
							<select class="form-control" name="rol">
								<option>
									<?php
										include("session.php");
										$q="SELECT usu_nivel FROM usuario WHERE alias='$_REQUEST[id]'";
										$resultado = mysqli_query($conexion, $q);
										if(mysqli_num_rows($resultado)>0){
											$nivel=mysqli_fetch_array($resultado);
											echo "$nivel[usu_nivel]";
										} 
									?>
								</option>
								<option>
									<?php
										if ($nivel['usu_nivel']=='administrador') { //usuario
											echo "usuario";
										}else{
											echo "administrador";
										}
									?>
								</option>
							</select>
						</div>					
					</div><br/>
							<?php } ?>

					<a data-toggle="collapse" data-target="#contenedorPassword">Cambiar mi contraseña</a>
					<div id="contenedorPassword" class="collapse">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input class="form-control" type="password" name="password_usuario" placeholder="Nueva Contraseña" />
						</div><br>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input class="form-control" type="password" name="password_usuario2" placeholder="Repite Contraseña" />
						</div>
					</div><br><br/>
					<input class="btn btn-default" type="submit" value="Modificar"/> 
				</form>
				<br>
				<a href="principal.php">Volver</a>
			</div>
		
	<!-- FORMULARIO NUEVO USUARIO -->
			<div class="col-lg-4">
				<?php } else { ?>
				<h1>Nuevo usuario</h1>
				<form action="insertar_modificar.proc.php"  method="post">	
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input class="form-control" type="text" name="nombre_usuarioNew" placeholder="Nombre de usuario" required="required" />
					</div><br>
					
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input class="form-control" type="password" name="password_usuarioNew" placeholder="Nueva Contraseña" required="required" />
					</div><br>

					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input class="form-control" type="password" name="password_usuario2New" placeholder="Repite Contraseña" required="required" />
					</div><br>

					<div class="input-group">
						<!-- <span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span> -->
						<input type="hidden" name="opcNew" value="update">
						<input type="hidden" name="rolNew" value="usuario">
							<!-- <select  class="form-control" name="rolNew">
								<option>
									<?php  
										/*echo "usuario";
									?>
								</option>
								<!-- <option value="usu_nivel">
									<?php
										/* echo "administrador";*/
									?>
								</option> -->
							<!--</select> -->					
					</div><br/>
					<?php
				  		if (isset($_SESSION['successNew'])) {
							echo "<p style='color: green;'>$_SESSION[successNew]</p>";
				  		}
				  		if (isset($_SESSION['errorNew'])) {
							echo "<p style='color: red;'>$_SESSION[errorNew]</p>";
				  		}
			  		?>
					<input class="btn btn-default" type="submit" value="Crear"/> 
				</form>
				<br>
				<a href="principal.php">Volver</a>
				<?php } ?>
				
			</div>
				
			</div>
		</div>
	</body>
</html>
<?php
	}else{
		header('location: index.php');
	}
?>