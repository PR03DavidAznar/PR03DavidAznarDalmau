

<?php
	session_start();
	include 'session.php';
	if (isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Bienvenido a Escandio</title>
		<meta charset="utf-8">
		<!-- <meta charset="utf-8"> -->
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

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>jQuery UI Datepicker - Default functionality</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="/resources/demos/style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
		<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				
				$('#startTime').timepicker({
				    
				    timeFormat: 'HH:mm:ss',
				    interval: 60,
				    minTime: '8',
				    maxTime: '21:00',
				    // defaultTime: '8',
				    startTime: '08:00',
				    dynamic: false,
				    dropdown: true,
				    scrollbar: true
				});
				$('#startTime')
				.timepicker('option', 'change', function(time) {
				    $('#endTime').timepicker('option', 'minTime', time);
				    //$('#endTime').timepicker('setTime', time);
				});
				$('#endTime').timepicker({
					timeFormat: 'HH:mm:ss',
				    interval: 60,
				    minTime: '8',
				    maxTime: '21:00',
				    startTime: '08:00',
				    dynamic: false,
				    dropdown: true,
				    scrollbar: true
				});
			});

			$( function() {
    			$( ".datepicker" ).datepicker({ minDate: 0, dateFormat:'yy-mm-dd' });
  			} );
			
			
			//document.getElementById('#fecha').value = new Date().toDateInputValue();
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
						
					}
				?>

				<?php 
					include 'session.php';

					$idusuario=$_REQUEST['idusuario'];
					$idreserva=$_REQUEST['idreserva'];
					$idreserva_recurso=$_REQUEST['idreserva_recurso'];
					$nom_recurso=$_REQUEST['nom_recurso'];
					//header('Location: recursos.php');
				?>

				<div id="contenedorReserva">
					<form action="reservar_recurso.proc.php" method="get">
						<?php
							echo "Recurso que desea reservar: <b>$nom_recurso</b>";
							echo "<input type='hidden' name='nom_recurso' value='$nom_recurso'>";
							echo "<input type='hidden' name='idusuario' value='$idusuario'>";
							echo "<input type='hidden' name='idreserva' value='$idreserva'>";
							echo "<input type='hidden' name='idreserva_recurso' value='$idreserva_recurso'>";
						?>
						<br><br>
						<input id="fecha" class='datepicker form-control' type="text" name="fechaReserva" required="required" placeholder="Pulsar para añadir fecha"><br/>
							
						<label>Reservar de: </label>
						<input id="startTime" class="form-control" type="text" name="hInicial">

						<label>Reservar hasta: </label>
						<input id="endTime" class="form-control" type="text" name="hFinal"><br>
						<!-- <input id="startTime" class="form-control" size="20" type="text" />
						<input id="endTime" class="form-control" size="20" type="text" /> -->
						<button id="btnReservar" class="btn" type="submit">Reservar</button>
					</form>
					
					<a href="recursos.php">Volver lista recursos</a>
				</div>
				<?php
						if (isset($_SESSION['successH'])) {
								echo "<p style='color: green;'>$_SESSION[successH] </p><br>";
							}

						if (isset($_SESSION['errorH'])) {
							echo "<p style='color: red;'>$_SESSION[errorH]</p> <br>";
						}
					?>
			</div>
		</div>
	</body>
</html>
<?php
	} else {
		header('location: index.php');
	}
?>
</body>
</html>