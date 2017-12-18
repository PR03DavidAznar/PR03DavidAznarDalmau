<?php
	session_start();
	if(isset($_SESSION['id'])){
		header("location: principal.php");
	} else if(isset($_SESSION['error'])){
		$error = $_SESSION['error'];
		session_destroy();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script type="text/javascript" src="js/main.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta charset="utf-8">
	</head>
	<body>

		<?php
			if(isset($error)){
				echo "<h1>".$error."</h1>";
			}
		?>

		<div id="center_container">
			<div class="col-lg-4"></div>
			<div class="col-lg-4" style="text-align: center;">
				<h1>LOGIN</h1>
				<form name="f1" action="login.proc.php" method="get">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input class="form-control" type="text" name="nombreUsuario" placeholder="Nombre de usuario" />
					</div>
					<br>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input class="form-control" type="password" name="passwordUsuario" placeholder="Contraseña" />
					</div><br/><br/>
					<input type="submit" value="Entrar"/> 
					<!-- - <a href="alta.php">Nuevo usuario</a> -->
				</form>
			</div>	
	</body>
</html>