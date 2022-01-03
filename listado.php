<?php

	include_once "objetos/usuario.php";
	include_once "objetos/carpeta.php";

	if ( $usuario->access("usuario") == false ){
		$usuario->redirect("index.php");
	}

	if (isset($_POST["borrar"])){
		$mensaje = $carpeta->borrar_fichero('datos/', $_POST["borrar"]);
	}

	$ficheros = $carpeta->listar_ficheros("datos");

	if (isset($_POST["ver"])){
		$datosUsuario = $carpeta->mostrar_contenido_fichero_json('datos/', $_POST["ver"]);
		$mensaje = "Mostrando datos del fichero: ".$_POST["ver"];
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
		<title>Listado Ficheros</title>
	</head>

	<body>

		<div class="container">

			<div class="row justify-content-center">

				<div class="col-md-10 text-center mt-5">
					<img src="media/img/cac_logo.png">
				</div>

				<div class="col-md-4 mt-5">
						
					<table class="table table-danger table-striped table-bordered text-center">

						<thead>
							<tr>
								<th> Archivo </th>
								<th colspan="2"> Acciones </th>
							</tr>
						</thead>

						<?php

							foreach ($ficheros as $fichero){

								if ($fichero !== "." && $fichero !== ".."){
									?>
									<tr>
										<td> <?= $fichero ?> </td> 
										<td> <form action='' method='POST'> <input type='hidden' name='ver' value='<?= $fichero ?>'> <input type='submit' value='Ver'> </form> </td>
										<td> <form action='' method='POST'> <input type='hidden' name='borrar' value='<?= $fichero ?>'> <input type='submit' value='Borrar'> </form> </td>
									</tr>
								<?php
							}
								
						} ?>

					</table>
				
				</div>
			
			</div>

			<div class="row justify-content-center">

				<div class="col md-4 text-center">
					<p> <?= @$mensaje ?> </p> 
					<p> <?= @$datosUsuario ?></p>	
				</div>
			
			</div>

		</div>
	
	</body>

</html>

