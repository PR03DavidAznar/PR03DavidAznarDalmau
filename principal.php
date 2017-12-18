
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
		<script>
		function eliminar(id){
			//alert("dentro");
			//self.location.href="http://www.google.es";
			if(confirm("Seguro que quiero eliminar el usuario?")){
				self.location.href="eliminar.proc.php?id=" + id;
			}
		}


	</script>
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
				<table class="table table-hover">
				    <thead>

				      	<tr style="background-color: blue; color: white">

				        	<td>USUARIO</td>
				        	<td>NIVEL</td>
				        	<td>OPERACIONES</td>
					        				      	
				    </thead>
				    <tbody>
				    	<?php
				    		$q = "SELECT * FROM usuario";
							$resultado = mysqli_query($conexion, $q);
							if(mysqli_num_rows($resultado)>0){
								while ($datos_usuario=mysqli_fetch_array($resultado)){
									echo "<tr>";
										echo "<td>". $datos_usuario['alias'] ."</td>";
										echo "<td>". $datos_usuario['usu_nivel'] ."</td>";

										if ($_SESSION['nivel'] == 'administrador'){
											echo "<td>";
												echo "<a href='insertar_modificar.php?id=" . $datos_usuario['alias'] . "&permisos'><i class='glyphicon glyphicon-pencil'></i></a>";
												echo "<span style='margin-left: 25px;'></span>";
												if ($datos_usuario['alias'] != $_SESSION['username']) {
													echo "<a href='#' onclick='eliminar(\"$datos_usuario[alias]\");'><i class='glyphicon glyphicon-remove'></i></a>";
													 //echo "<a href='#' onClick='self.location.href=\"http://www.google.es\";'><i class='glyphicon glyphicon-remove'></i></a>";
													// echo "<a id='eliminarUser' href='eliminar.proc.php?id=" . $datos_usuario['alias'] . "'><i class='glyphicon glyphicon-remove'></i></a>";
												}
											echo "</td>";
										}else{
											echo "<td>";
												
												echo "<span style='margin-left: 25px;'></span>";
												if ($datos_usuario['alias'] == $_SESSION['username']) {
													echo "<a href='insertar_modificar.php?id=" . $datos_usuario['alias'] . "'><i class='glyphicon glyphicon-pencil'></i></a>";
													 //echo "<a href='#' onClick='self.location.href=\"http://www.google.es\";'><i class='glyphicon glyphicon-remove'></i></a>";
													// echo "<a id='eliminarUser' href='eliminar.proc.php?id=" . $datos_usuario['alias'] . "'><i class='glyphicon glyphicon-remove'></i></a>";
												}
											echo "</td>";
										}
									echo "</tr>";
								}					
							}
				    	?>	            
				    </tbody>
			  	</table>


				  	<?php
				  		if (isset($_SESSION['success'])) {
							echo "<p style='color: green;'>$_SESSION[success]</p>";
				  		}
				  		if (isset($_SESSION['error'])) {
							echo "<p style='color: red;'>$_SESSION[error]</p>";
				  		}
				  	?>
				  	
				  	<?php
				  	if ($_SESSION['nivel'] == 'administrador') {
				  		echo "<a href='insertar_modificar.php'><button type='buttonNuevo' class='btn btn-default'><i class='glyphicon glyphicon-plus-sign'></i>Añadir</button></a> <br><br>";
				  	}
				  	?>
				  	<a style="color: black;" href="recursos.php">Volver lista recursos</a>



				  	<?php
						if(!isset($_SESSION['username'])) {
							$_SESSION['error']="No te saltes el login!!";
							header("location: login.php");
						}

					?>

				<!-- <a href="recursos.php">Volver listar recursos</a> -->
			</div>
		</div>
	</body>
</html>
<?php
	}else{
		header('location: index.php');
	}
?>