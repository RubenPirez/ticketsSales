<?php

include_once "objetos/usuario.php";
include_once "objetos/carpeta.php";
include_once "objetos/cookie.php";

	// comprueba si la cookie existe, si no redirige a la página de login, no se puede acceder si el usuario no está "logueado"
	if ( $usuario->access("usuario") == false ){
		$usuario->redirect("index.php");

	} else {

		$cookie = new cookie("usuario");
		$lineFile = $carpeta->explorar_archivo();
		if ( $usuario->get_token($lineFile) == $cookie->get_valor_cookie() ){
			$user_name = $lineFile[0];
		}
	}

?>

<!DOCTYPE html>

<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<title>Gestion</title>
	</head>

	<body>

		<div class="container">
		
			<div class="row justify-content-center">

				<div class="col-md-5 text-center">
					<img src="media/img/cac_logo.png">
				</div>

				<div class="col-md-10 text-center">
					<h2 class="text-center"> <?= "Bienvenid@ ".@$user_name ?> </h2>
					<h2 class="text-center">Gestión de datos personales</h2>
				    
				</div>
				
			
				<div class="col-md-6 p-5 border">
				
					<form action="entrada.php" method="POST">
					
						<label class="form-label">Nombre</label>
						<input type="text" name="nombre" class="form-control" required>
						<label class="form-label">Apellidos</label>
						<input type="text" name="apellidos" class="form-control">
						<label class="form-label">DNI</label>
						<input type="text" name="dni" class="form-control">
						<label class="form-label">Edad</label>
						<input type="number" name="edad" class="form-control" required>
						
						<select class="form-select mt-2" name="pais">
							<option value="">País de residencia</option>
							<option value="España">España</option>
							<option value="Portugal">Portugal</option>
							<option value="Francia">Francia</option>
							<option value="Italia">Italia</option>
							<option value="Alemania">Alemania</option>
						</select>

						<div class="form-check mt-3">
							<input type="radio" name="genero" value="hombre">
							<label for="male">Hombre</label>
							<input type="radio" name="genero" value="mujer">
							<label for="female">Mujer</label>
						</div>

						<select class="form-select mt-2" name="discapacidad" required>						
							<option value="">Discapacidad</option>
							<option value="No">No</option>
							<option value="Visual">Visual</option>
							<option value="Auditiva">Auditiva</option>
						</select>
						<input type="hidden" name="gestion">

						<br>
						<input type="submit" value="Enviar" class="btn btn-info">
					
					</form>

				</div>

				<div class="col-md-10 text-center mt-4">

					<form action="index.php" method="POST">
					
						<input type="hidden" name="logout">
						<input type="submit" value="Desconectar" class="btn btn-success">
					
					</form>

				</div>
			
			</div>

		</div>
		
	</body>

</html>