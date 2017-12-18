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
						// Continua el while del nombre más abajo...
					?>
				</div>
				<!-- Cerrar Sesión -->
				<div class="login-view-right">
					<a href="index.php?logout='1'" class="btn-logout"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesi&#243;n</a>
				</div>
			</div>

			<!-- Filtro de búsqueda -->
			<!-- <div class="window-contenido"> -->
				<div id="contenedorFiltro" class="col-md-5"> <!-- window-contenido-search -->
					<span class="content-search-title">B&#250;squeda</span>
					<form action="recursos.php">
						<select class='form-control' name="tipo_recurso">
							<option value="" selected>&#8211; Tipo de recurso &#8211;</option>
							<option value="Aula">Aulas</option>
							<option value="Despacho">Despachos</option>
							<option value="Sala">Sala de reuniones</option>
							<option value="Proyector">Proyectores</option>
							<option value="Carro">Carro de port&#225;tiles</option>
							<option value="Port&#225;til">Port&#225;tiles</option>
							<option value="M&#243;vil">M&#243;viles</option>
						</select><br/>
				
						<select class='form-control' name="disponibilidad">
							<option value="" selected>&#8211; Disponibilidad &#8211;</option>
							<option value="1">Disponibles</option>
							<option value="0">No Disponibles</option>
						</select><br/>				
						<button id="btnFiltrar" type="submit" name="botonFiltro" value="Filtrar" class="btn">Filtrar</button>
					</form>					
				</div>
			<!-- </div> -->

			<div id="opc" class="col-md-3" style="text-align: center;">
				<p><b>Administración de usuarios</b></p>
				<a href="principal.php"><img src="img/usuarios.png" width="165px;" height="165px" title="ADMINISTRAR USUARIOS"></a>
			</div>

			<div id="opc2" class="col-md-3" style="text-align: center;">
				<p><b>Mis recursos reservados</b></p>
				<a href="reservaUsuario.php"><img src="img/reserva.png" width="165px;" height="165px" title="ADMINISTRAR USUARIOS"></a>
			</div>


				<!-- </div> -->
				<!-- Contenido de la página -->
				<div class="contenedorTable">
					<?php
							$sql="SELECT `tipo_recurso`, `nom_recurso`, `usuario`.`nombre`, `usuario`.`apellidos`, `reserva`.`idreserva`, `reserva`.`disponibilidad`, `reserva_recurso`.`idreserva_recurso`, `reserva_recurso`.`fecha_hora_reserva`, `reserva_recurso`.`fecha_hora_devolucion`
										FROM `recurso`
										LEFT JOIN `reserva_recurso` ON `recurso`.`idrecurso`=`reserva_recurso`.`idreserva_recurso`
										LEFT JOIN `reserva` ON `recurso`.`idrecurso`=`reserva`.`idreserva`
										LEFT JOIN `usuario` ON `reserva`.`idusuario`=`usuario`.`idusuario`";

							$consulta=mysqli_query($conexion,$sql);

							if (isset($_REQUEST['botonFiltro'])) {
								$tiporecurso=$_REQUEST['tipo_recurso'];
								// $nomrecurso=$_REQUEST['nom_recurso_complete'];
								$disponibilidad=$_REQUEST['disponibilidad'];

								$sql="SELECT `tipo_recurso`, `nom_recurso`, `usuario`.`nombre`, `usuario`.`apellidos`, `reserva`.`idreserva`, `reserva`.`disponibilidad`, `reserva_recurso`.`idreserva_recurso`, `reserva_recurso`.`fecha_hora_reserva`, `reserva_recurso`.`fecha_hora_devolucion`
											FROM `recurso`
											LEFT JOIN `reserva_recurso` ON `recurso`.`idrecurso`=`reserva_recurso`.`idreserva_recurso`
											LEFT JOIN `reserva` ON `recurso`.`idrecurso`=`reserva`.`idreserva`
											LEFT JOIN `usuario` ON `reserva`.`idusuario`=`usuario`.`idusuario`";

								$filtro="WHERE `recurso`.`tipo_recurso` LIKE '%$tiporecurso%' AND `reserva`.`disponibilidad` LIKE '%$disponibilidad%'";

								$sqlfiltro=$sql.$filtro;

								$consulta=mysqli_query($conexion,$sqlfiltro);
							}

							if(mysqli_num_rows($consulta)>0) {
								echo "<div class='row'>";
									echo "<div class='col-md-12'>";
										echo "<table class='table'>
												<tr style='background-color: blue; color: white;'>
													<td> Recurso </td>
													
													<td> Reservar </td>
												</tr>

											<b> Recursos: " . mysqli_num_rows($consulta) . "</b><hr id='hr'>";
													// <th> Estado </th>
													// <th> Fecha de Reserva </th>
													// <th> Fecha de Devoluci&#243;n </th>

											while ($result=mysqli_fetch_array($consulta)) {
												echo "<tr>";
													echo "<td>" . $result ['nom_recurso'] . "</td>";
													// echo "<td>" . $result ['nombre'] . " " . $result ['apellidos'] . "</td>";

													// if ($result['disponibilidad']>0) {
													// 	echo "<td>Disponible</td>";
													// } else {
													// 	echo "<td>No disponible</td>";
													// }

													// if ($result['disponibilidad']==1) {
													// 	echo "<td></td>";
													// } else {
													// 	$hora_reserva=strtotime($result ['fecha_hora_reserva']);
													// 	echo "<td>" . DATE('d/m/Y - H:i:s',$hora_reserva) . "</td>";
													// }

													// if ($result['disponibilidad']==0) {
													// 	echo "<td></td>";
													// } else {
													// 	$hora_devolucion=strtotime($result ['fecha_hora_devolucion']);
													// 	echo "<td>" . DATE('d/m/Y - H:i:s',$hora_devolucion) . "</td>";
													// }

													if ($result['disponibilidad']==1) {
														echo "<td>
																<form action='reservar_recurso.php'>
																	<input type='hidden' name='idusuario' value=".$resname['idusuario'].">
																	<input type='hidden' name='idreserva' value=".$result['idreserva'].">
																	<input type='hidden' name='idreserva_recurso' value=".$result['idreserva_recurso'].">
																	<input type='hidden' name='nom_recurso' value='".$result['nom_recurso']."'>
																	<button type='submit' name='reservar' value='Reservar' class='btn btn-success reserva'>Reservar</button>
																</form>
															</td>";
													} else {
														// Si no lo está, comprueba el nombre del usuario de la sesión y lo compara con el del resultado (el de la tabla)
														if ($resname['nombre']==$result['nombre']) {
															echo "<td>
																<form action='liberar_recurso.php'>
																	<input type='hidden' name='idusuario' value=".$resname['idusuario'].">
																	<input type='hidden' name='idreserva' value=".$result['idreserva'].">
																	<input type='hidden' name='idreserva_recurso' value=".$result['idreserva_recurso'].">
																	<button type='submit' name='liberar' value='Liberar' class='btn btn-warning reserva'>Liberar</button>
																</form>
															</td>"; // Campo6
														} else {
															echo "<td><button type='button' class='btn btn-danger disabled reserva'>Reservado</button></td>"; // Campo6
														}
													}
												echo "</tr>";
											// Fin del While $result
											}
										echo "</table>";
									echo "</div>";
								echo "</div>";
							} else {
								echo "<table class='table'>
										<tr>
											<th> Recurso </th>
											<th> Usuario </th>
											<th> Estado </th>
											<th> Fecha de Reserva </th>
											<th> Fecha de Devoluci&#243;n </th>
											<th> Reservar </th>
										</tr>

									<b> Recursos: " . mysqli_num_rows($consulta) . "</b><hr id='hr'>";

									echo "<tr>
											<td colspan='6' style='text-align:center;'>No hay datos disponibles.</td>
										</tr>";
								echo "</table>";
							// Cierra el if/while de $consulta
							}
						// Cierra el while de $resname
						}

						
					?>
				</div>
				<br><br><br><br>
		</div>
	</body>
</html>
<?php
	} else {
		header('location: index.php');
	}
?>