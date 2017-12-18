<?php
	session_start();
	include 'login.php';
	if (!isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Iniciar Sesi&#243;n | Escandio</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- Glyphycons -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		<!-- Contenedor -->
		<div class="contenedor">
			<!-- Imagen -->
			<!-- <span class="glyphicon glyphicon-user"></span> -->
			<div class="icon">
				<!-- <span class="glyphicon glyphicon-user"></span> -->
			</div>
			<h2>Iniciar Sesi&#243;n</h2>
			<!-- formulario -->
			<form action="index.php" method="POST">
				<div class="form-input inner-addon">
					<span class="glyphicon glyphicon-user"></span>
					<input type="text" name="username" id="username" placeholder="Usuario" maxlength="15" required>
				</div>
				<div class="form-input inner-addon">
					<span class="glyphicon glyphicon-lock"></span>
					<input type="password" name="password" id="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" maxlength="15" required>
				</div>
				<!-- aviso de error -->
				<?php include 'errors.php'; ?>
				<button type="submit" name="login" value="Entrar" class="btn-login"><span class="glyphicon glyphicon-log-in"></span> Entrar</button>
			</form>
		</div>
	</body>
</html>
<?php
	} else {
		header('location: recursos.php');
	}
?>