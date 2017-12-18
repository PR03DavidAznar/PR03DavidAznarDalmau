<?php
	$dbServer = "localhost"; // Nombre o IP del servidor
	$dbUser = "root"; // Nombre de usuario
	$dbPwd = ""; // Contraseña del servidor
	$dbNameBD = "1718_aznardavid"; // Nombre de la base de datos
	$errors = array();

	$conexion = mysqli_connect ($dbServer, $dbUser, $dbPwd, $dbNameBD);
	mysqli_query($conexion,"SET NAMES 'utf8'");

	if (!$conexion) {
		echo "Error: No se pudo conectar a MySQL. " . PHP_EOL;
		echo "Errno de depuración: " . mysqli_connect_errno () . PHP_EOL;
		echo "Error de depuración: " . mysqli_connect_error () . PHP_EOL;
		exit;
	}
	// Continua en login.php
?>