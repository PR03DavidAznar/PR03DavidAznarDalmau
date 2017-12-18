<?php
	session_start();
	if(isset($_SESSION['id'])){

?>

<!DOCTYPE html>
<html>
<head>

	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="js/main.js"></script>
	<meta charset="utf-8">
	<script>
		
		function validar(){
			if(document.addnew.descripcionIncidencia.value==""){
				alert("El campo descripción no puede estar en blanco!");
				return false;

			}
		}
	</script>
</head>
<body>
	<div id="color">

	</div>
	
	<?php
	//session_start();
	
	$con=mysqli_connect("localhost", "root", "", "1718_aznardavid");
	//error_reporting(0);
	//if(isset($_SESSION['usuario'])){
		// echo "$_SESSION[usuario]";
		//$usuario = $_SESSION['usuario'];
		if(isset($_REQUEST['reserva'])){
			
			$x = "SELECT Ocupado from tbl_recurso where idRecurso = $_REQUEST[reserva]";
			$resultados = mysqli_query($con, $x);
			if(mysqli_num_rows($resultados)>0){
				$reserva = mysqli_fetch_array($resultados);
				if($reserva['Ocupado'] == 0){

					$m= "UPDATE tbl_recurso SET Ocupado = 1 WHERE idRecurso = $_REQUEST[reserva]";
					mysqli_query($con,$m);
					if (isset($_REQUEST['reserva']) && isset($_SESSION['usuario'])) {
						$s = "INSERT INTO tbl_reserva (`fechaReserva`, `fechaLiberamiento`, `idUsuario`, `idRecurso`) VALUES (CURRENT_TIMESTAMP,null, '$_SESSION[idUsuario]','$_REQUEST[reserva]')";
						mysqli_query($con,$s);

					}
				} 

			}	

		}

	 //} 

	if(isset($_REQUEST['devolverProducto'])){
		$m= "UPDATE tbl_recurso SET Ocupado = 0 WHERE idRecurso = $_REQUEST[devolverProducto]";

		mysqli_query($con,$m);
		if (isset($_REQUEST['devolverProducto']) && isset($_SESSION['usuario'])) {
			$idreserva = "select idReserva from tbl_reserva where idUsuario = $_SESSION[idUsuario] and idRecurso=$_REQUEST[devolverProducto] and fechaLiberamiento is null";

			$resultados = mysqli_query($con,$idreserva);
			$idreservanow = mysqli_fetch_array($resultados);
			// echo $idreservanow['idReserva'];
			$s = "UPDATE tbl_reserva SET fechaLiberamiento = CURRENT_TIMESTAMP WHERE idReserva = $idreservanow[idReserva]";

			mysqli_query($con,$s);

		}


	}

	?>

	<div id="cabecera" class="row">
		<div class="col-lg-4" style="text-align: left; color: white; padding-left: 2%;">
			<p><p><a href="principal.php" id="color">INICIO</a></p></p>
		</div>
		<div class="col-lg-4" style="text-align: center; color: white">
			<p class="size">Aulas y materiales</p>
		</div>

		<div class="col-lg-4" style="text-align: right; padding-right: 2%;">
			<?php
				if(isset($_SESSION['id'])){
					include("conexion.php");
					echo "<a id='cerrarSesion' href='logout.proc.php'> <i class='glyphicon glyphicon-off'></i> " . $_SESSION['id'] . "</a><br/>";
				}
			?>
		</div>
	</div>

<!--/////////////////////////////////////////////// FILTRAR ////////////////////////////////////////////////// -->

	<!-- /////////////////// CONT IZQUIERDO /////////////////// -->
	<div id="contenedor_izq">
		<div class="col-lg-12">
			<div class="panel-group">
				<div class="panel panel-primary">
					<div class="panel panel-heading">FILTRAR</div>
					<div class="panel-body">
						<form action='principal.php' method='REQUEST' accept-charset='UTF-8'>
							<?php
								error_reporting(0);
								//Se inserta información referente al nombre
								$con=mysqli_connect("localhost","root","","1718_aznardavid");
								$q="SELECT DISTINCT nombreUsuario FROM tbl_usuario";
								$querymuestranombre=mysqli_query($con,$q);
								mysqli_set_charset($con, "utf8");
								echo "Filtro por nombre<br>";
								//Se inserta información referente al tipo de recurso
							?>
							<select name='nombreUsuario' required>
								<?php
									echo "<option>Todos</option>";
									while ($row=mysqli_fetch_array($querymuestranombre)) {
										echo '<option value="'.utf8_encode($row['nombreUsuario']).'">'.utf8_encode($row['nombreUsuario']).'</option>';
									}
								?>
							</select><br><br>

							<?php
								//Se inserta información referente al tipo de recurso
								$con1=mysqli_connect("localhost","root","","1718_aznardavid");
								$qn="SELECT DISTINCT YEAR(fechaReserva) FROM tbl_reserva";
								$querymuestratipo=mysqli_query($con1,$qn);
								echo "Filtro por año de reserva del recurso<br>";
							?>
							<select name='fechaReserva' required>
								<?php
									echo "<option>Todos</option>";
									while ($row=mysqli_fetch_array($querymuestratipo)) {
										echo '<option value="'.utf8_encode($row['YEAR(fechaReserva)']).'">'.utf8_encode($row['YEAR(fechaReserva)']).'</option>';
									}
								?>
							</select><br/><br/>
							<input type='submit' name='filtro'>
							<input type='submit' name='Reset' value='Resetear'><br/><br/>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- /////////////////// CONT DERECHO /////////////////// -->

	<div id="contenedor_derch">
		<div class="col-lg-12">
			<div class="panel-group">
				<form action="principal.php" method="POST">
			</div>
		</div>
	</div>

	<?php
		$con=mysqli_connect("localhost", "root", "", "1718_aznardavid");
		if(!$con){
			echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
			echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}else{
			mysqli_query($con, "SET NAMES 'utf8'");	
			if((isset($_REQUEST['filtro']))){
	?>
	<div id="contenedor_central">
		<table class="table">
			<thead>
				<tr>
					<th class="centro">Nombre de usuario</th>
					<th class="centro">ID Reserva</th>
					<th class="centro">Año de reserva</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$query="SELECT idReserva,tbl_usuario.nombreUsuario,  YEAR(fechaReserva) from tbl_usuario LEFT JOIN tbl_reserva on tbl_usuario.idUsuario = tbl_reserva.idUsuario";
				$sql=mysqli_query($con, $query);
				while ($row=mysqli_fetch_array($sql)) {
					$con=mysqli_connect("localhost","root","","1718_aznardavid");
					$value=utf8_decode($_REQUEST['nombreUsuario']);
					$value1=utf8_decode($_REQUEST['fechaReserva']);

					if($value=="Todos" and $value1== "Todos"){
						$query=$query="SELECT idReserva, nombreUsuario, YEAR(fechaReserva) from tbl_reserva LEFT JOIN tbl_usuario on tbl_reserva.idUsuario = tbl_usuario.idUsuario";
					}elseif($value1!= "Todos" and $value != "Todos"){
						$query="SELECT idReserva, nombreUsuario, YEAR(fechaReserva) from tbl_reserva LEFT JOIN tbl_usuario on tbl_reserva.idUsuario = tbl_usuario.idUsuario WHERE nombreUsuario='$value' AND YEAR(fechaReserva)='$value1'";
					}elseif($value=="Todos" && $value1!="Todos"){
						$query="SELECT idReserva, nombreUsuario, YEAR(fechaReserva) from tbl_reserva LEFT JOIN tbl_usuario on tbl_reserva.idUsuario = tbl_usuario.idUsuario WHERE YEAR(fechaReserva)='$value1'";
					}elseif($value!="Todos" && $value1=="Todos"){
						$query="SELECT idReserva, nombreUsuario, YEAR(fechaReserva) from tbl_reserva LEFT JOIN tbl_usuario on tbl_reserva.idUsuario = tbl_usuario.idUsuario WHERE nombreUsuario='$value'";
					}
			?>

			<?php
				$sql=mysqli_query($con, $query);
				$numrows=mysqli_num_rows($sql).'<br><br>';
				echo"<tbody>";
					if ($numrows>0) {
						while ($row=mysqli_fetch_array($sql)) {
							echo "<form action='principal.php' method='REQUEST'>";
							echo "<tr class='filas'>";
								// echo "El ID del recurso es: ".$row['idRecurso'].'<br>';
								echo "<td> ".utf8_encode($row['nombreUsuario']).'<br></td>';
								echo "<td> ".utf8_encode($row['idReserva']).'<br></td>';
								echo "<td>".$row['YEAR(fechaReserva)'].'<br></td>';
								echo "<td>";
							echo "</tr>";
								echo "</form>";
								$cont++;

							}
						}else {
							echo "<td>Su busqueda no ha generado registros</td>";
						}
					}




				}elseif((isset($_REQUEST['Enviar']))){
				}else{
					?>
					<div id="contenedor_central">
						<table class="table">
							<thead>
								<tr>
									<th class="centro">Nombre de usuario</th>
									<th class="centro">ID reserva</th>
									<th class="centro">Año de reserva</th>
								</tr>
							</thead>
							<tbody>
								<?php

								//SE SELECCIONA TODOS LOS DATOS AL PRINCIPIO DEL PHP
								$q = "SELECT tbl_reserva.idReserva, tbl_usuario.nombreUsuario,  YEAR(fechaReserva) from tbl_usuario LEFT JOIN tbl_reserva on tbl_usuario.idUsuario = tbl_reserva.idUsuario";


								$resultados = mysqli_query($con, $q);

								if(mysqli_num_rows($resultados)>0){
									$cont=0;

									while($reserva = mysqli_fetch_array($resultados)){

										echo "<form action='principal.php' method='REQUEST'>";
										echo "<tr class='filas'>";
										echo "<td>$reserva[nombreUsuario]</td>";
										echo "<td>$reserva[idReserva]</td>";
										echo '<td>'.utf8_encode($reserva['YEAR(fechaReserva)']).'</td>';
										echo "<td>";


										echo "</form>";
									}
								}	
							}	
						}

						?>

					</tbody>
				</table>
			</div>

							<?php
		if(!isset($_SESSION['id'])) {
			$_SESSION['error']="No te saltes el login!!";
			header("location: index.php");
		}

	?>

</body>
</html>
<?php
	} else {
		$_SESSION['error']="No te saltes el login!!";
		header("location: index.php");
	}
?>