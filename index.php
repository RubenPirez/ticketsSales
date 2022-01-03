<?php

include_once "objetos/usuario.php";
include_once "objetos/cookie.php";

if ( $usuario->logout() ){
	$cookie = new cookie("usuario");
	$cookie->borrar_cookie();
}
// si la variable existe (la cookie ya está creada en el navegador), redirige a la página de gestión, no hay que volver a loguearse
if ( $usuario->access("usuario") ){
	$usuario->redirect("gestion.php");
// si no existe la cookie se comprueba la identidad del usuario, que corresponda con los datos guardados en seguridad.txt
} else {
	if ( empty($_POST) == false){
		$usuario->comprueba_usuario($_POST["name"], $_POST["pass"]);
		$usuario->login_user();
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
		<title>Venta de entradas</title>
	</head>

	<body>

		<div class="container">

			<div class="row justify-content-center">

				<div class="col-md-5 text-center">
					<img src="media/img/cac_logo.png">
				</div>
				
				<div class="col-md-10">
					<h2 class="text-center pt-5">Control de acceso a la venta de entradas</h2>
				</div>
				
				<div class="col-md-4 mt-5 p-5 align-self-center border">

					<form action="" method="POST">
					
						<label class="form-label">Usuario</label>
						<input type="text" name="name" class="form-control">
						<label class form-label>Contraseña</label>
						<input type="password" name="pass" class="form-control">

						<input type="hidden" name="formulario">
						<br>
						<input type="submit" value="Acceder" class="btn btn-info">
					
					</form>

				</div>
			
			</div>

			<div class="row justify-content-center">

				<div class="col-md-5 mt-5 text-center">

					<p> <?= "<strong>".$usuario->mensaje."</strong>" ?> </p>

				</div>
			
			</div>

		</div>
		
	</body>

</html>