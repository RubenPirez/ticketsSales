<?php

	include_once "objetos/usuario.php";
	include_once "objetos/carpeta.php";

	if ( empty($_POST) == false){
		$usuario->loader($_POST);
		$datos = $usuario->cambia_password("r");
		if ( $usuario->is_user_reg ){
			// sobreescribe el fichero con los nuevos datos (solo el cambio de contraseña del usuario que lo ha solicitado)			
			$mensaje = $carpeta->guardar_fichero("seguridad.txt", $datos, "Contraseña cambiada correctamente");
			$usuario->is_user_reg = false;
		} else {
			$mensaje = "Datos de acceso erróneos, no se puede cambiar contraseña";
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
		<title>Cambio Password</title>
	</head>

	<body>
		
		<div class="container">
			
			<div class="row justify-content-center">

				<div class="col-md-5 text-center">
					<img src="media/img/cac_logo.png">
				</div>

				<div class="col-md-8 mb-3">
					<h2 class="text-center">Cambio de contraseña de usuario registrado</h2>
				</div>
			
				<div class="col-md-6 border border-info p-5">

					<form action="" method="POST">
					
						<label class="form-label">Usuario</label>
						<input type="text" name="nombre" class="form-control">

						<label class="form-label">Contraseña</label>
						<input type="password" name="pass" class="form-control">

						<label class="form-label">Contraseña Nueva</label>
						<input type="password" name="new-pass" class="form-control">

						<input type="hidden" name="cambio-pass">

						<br>

						<input type="submit" value="Enviar" class="btn bt-lg btn-outline-warning">

					</form>
				
				</div>
				
				<div class="col-md-7 text-center">
				
					<p> <?= "<strong>".@$mensaje."</strong>" ?> </p>

				</div>
			
			</div>

		</div>

	</body>

</html>