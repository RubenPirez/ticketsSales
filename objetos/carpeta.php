<?php

	class carpeta {

		public $ruta;
		public $fecha;
		public $file;

		function __construct(){
		}

		function abrir_archivo($path, $mode){
			fopen($path, $mode);
		}

		function cerrar_archivo(){
			fclose($this->file);
		}

		function explorar_archivo(){

			$file = fopen("seguridad.txt", "r");

			if($file){
				
				while ( ($bufer = fgets($file)) ){

					$lineFile = explode(":", trim($bufer), 3);
					
					return $lineFile;
				}
			}
			$this->cerrar_archivo($file);
		}	
		// guarda en el fichero que se le indique los datos pasados como argumentos
		function guardar_fichero($ruta, $dato, $mensaje=""){
			file_put_contents($ruta, $dato);
			return $mensaje;
		}
		// devuelve una lista de todos los archivos dentro de una ruta que se le pasa como argumento
		function listar_ficheros($dir){
			$ficheros = scandir($dir);
			return $ficheros;
		}

		function mostrar_contenido_fichero_json($path, $file){
			// obtiene el contenido del fichero y ruta que se le pase
			$archivo = @file_get_contents($path.$file);
			$campos = json_decode($archivo, true);
			// separa los campos con una barra invertida
			$datosUsuario = implode("/", $campos);
			return $datosUsuario;
		}
		//borra el fichero de la carpeta pasadas como argumentos
		function borrar_fichero($folder, $file){
			$path = $folder.$file;
			if ( file_exists($path) ){
				unlink($path);
				$mensaje = "Archivo <strong>".$file."</strong> borrado correctamente<br><br>";
			} else {
				$mensaje = "El archivo no existe";
			}
			return $mensaje;
		}

	}

	$carpeta = new carpeta();