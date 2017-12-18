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
				<?php
				echo "<br>";
				echo "<table class='table'>";
					echo "<tr style='background-color: blue; color: white'>";
						echo "<td>Fecha</td>";
						echo "<td>Hora inicio</td>";
						echo "<td>Hora final</td>";
						echo "<td>Usuario</td>";
						echo "<td>Devolver</td>";
					echo "</tr>";

					
						$q = "SELECT * FROM reserva_calendario WHERE usuario='$_SESSION[username]'";
						// echo "$q";
						$consulta = mysqli_query($conexion, $q);
						if (mysqli_num_rows($consulta)>0) {
							while ($result=mysqli_fetch_array($consulta)) {
								echo "<tr>";
									echo "<td>$result[fecha]</td>";
									echo "<td>$result[hora_inicio]</td>";
									echo "<td>$result[hora_final]</td>";

									$qNomRecurs = "SELECT nom_recurso FROM recurso WHERE idrecurso='$result[idrecurso]'";
									$consultaNomRecurs = mysqli_query($conexion, $qNomRecurs);
									if (mysqli_num_rows($consultaNomRecurs)>0) {
										while ($resultNomRecurs=mysqli_fetch_array($consultaNomRecurs)) {
											echo "<td>$resultNomRecurs[nom_recurso]</td>";
										}
									}

									echo "<td>
										<form action='eliminar_reserva.php'>
											<input type='hidden' name='idrecurso' value='".$result['idrecurso']."'>
											<input type='hidden' name='fecha' value='".$result['fecha']."'>
											<input type='hidden' name='hora_inicio' value='".$result['hora_inicio']."'>
											<input type='hidden' name='hora_final' value='".$result['hora_final']."'>
											<button type='submit' name='liberar' value='Reservar' class='btn btn-success reserva'>LIBERAR</button>
										</form>
									</td>";
								echo "</tr>";
							}
						}
				echo "</table>";						
				?>

				<a href="recursos.php">Volver listar recursos</a>
			</div>
		</div>
	</body>
</html>
<?php
	}else{
		header('location: index.php');
	}
?>