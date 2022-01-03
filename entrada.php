<?php

include_once "objetos/entrada.php";
include_once "objetos/usuario.php";
// comprueba si la cookie existe, en caso de que no esté definida redirige a la página de login
if ( $usuario->access("usuario") == false ){
	$usuario->redirect("index.php");
// comprueba que los campos mínimos que necesitamos no estén vacíos, en caso de que alguno esté vacío redirige a la página de gestión
} else if ( empty($_POST["nombre"]) || empty($_POST["edad"]) || empty($_POST["discapacidad"]) ) {	
	$usuario->redirect("gestion.php");
} else {
	$usuario->loader($_POST);
	$entrada->configuracion("datos/*.txt", "datos/", ".txt");
	// calcula el precio de la entrada
		$tmp = $precio_entrada = $entrada->calcular_precio(50, $usuario->edad, $usuario->disc);
	// obtiene el número de la entrada
		$num_entrada = $entrada->get_numero_entrada();
	// guarda los datos del cliente
		$entrada->guardar_fichero_json();
}

?>


<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<link rel="stylesheet" href="css/styles.css">
		<title>Entrada</title>
	</head>

	<body>

		<h1 class="text-center font-monospace mt-5"> ¡Aquí tienes tu entrada!</h1>
	
		<div class="container bg-entrada altura font-monospace">

			<div class="row justify-content-center mt-5">

				<div class="col-md-5 justify-content-center">
					<div class="col-md p-3 text-center">
						<img src="media/img/cac_logo.png">
					</div>
			
					<div class="col-md text-center">
						<h4 class="text-center text-capitalize mt-2"> <?= $usuario->nombre." ".$usuario->apellidos; ?> </h4>
						<h4 class=""> DNI: <?= $usuario->dni; ?> </h4>
						<h4 class = ""> Edad: <?= $usuario->edad; ?> </h4>	
					</div>

					<div class="col-md">
						<h4 class="text-center"> Discapacidad: <?= $usuario->disc; ?></h4>
						<h4 class="text-center">  <?= "pvp: <strong>".@$precio_entrada."€</strong>"; ?></h4>
					</div>
					<div class="col-md mt-4">
						<h4 class="text-center pt-5"> Nº: <?= @$num_entrada; ?></h4>
					</div>
				</div>

			</div>
			
		</div>

		<div class="row">
		
			<div class="col-md text-center mt-4">

				<form action="index.php" method="POST">
					
					<input type="hidden" name="logout">
					<input type="submit" value="Desconectar" class="btn btn-success">
				
				</form>

			</div>

		</div>
	
	</body>

</html>