<?php

	include_once "objetos/usuario.php";

	if ( empty($_POST) == false ){		
		$usuario->loader($_POST);
		$usuario->comprueba_usuario($_POST["name"], $_POST["pass"]);
		// si usuario y contraseña son correctos
		if ( $usuario->is_user_reg != false ){
			$usuario->is_user_reg = false;
			$usuario->comprueba_usuario($_POST["new-user-name"], $_POST["new-user-pass"]);
			// comprueba que el usuario y pass nuevos, no existen ya
			if ( $usuario->is_user_reg == false){
			// guarda el nuevo usuario
				$mensaje = $usuario->guarda_nuevo_usuario();
			} else {
				$mensaje = "El usuario que intenta crear ya existe";
			}			
		} else {
			$mensaje = "usuario no registrado";
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
		<title>Registro</title>
	</head>

	<body>

		<div class="container">
		
			<div class="row justify-content-center">

				<div class="col-md-5 text-center">
					<img src="media/img/cac_logo.png">
				</div>

				<div class="col-md-8 mb-3">
					<h2 class="text-center">Registro de nuevo usuario</h2>
				</div>
			
				<div class="col-md-6 border border-info p-5">

					<form action="" method="POST">
					
						<label class="form-label">Usuario</label>
						<input type="text" name="name" class="form-control">

						<label class="form-label">Contraseña</label>
						<input type="password" name="pass" class="form-control">

						<label class="form-label">Nuevo Usuario</label>
						<input type="text" name="new-user-name" class="form-control">

						<label class="form-label">Contraseña Nuevo Usuario</label>
						<input type="password" name="new-user-pass" class="form-control">

						<input type="hidden" name="registro">

						<br>

						<input type="submit" value="Enviar" class="btn bt-lg btn-outline-info">

					</form>
				
				</div>
				
				<div class="col-md-7 text-center">
				
					<p> <?= "<strong>".@$mensaje."</strong>" ?> </p>

				</div>
			
			</div>

		</div>
		
	</body>

</html>

