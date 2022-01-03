<?php

	class entrada{
		
		public $precio_base;
		public $num_files;	

		function configuracion($carpeta_datos, $carpeta_guardar, $extension){
			// Declaración de atributos
				$this->carpeta_datos = $carpeta_datos;
				$this->carpeta_guardar = $carpeta_guardar;
				$this->extension = $extension;
		}

		function get_numero_entrada(){

			$folder = $this->carpeta_datos;

			// el número de entrada
			$num_files = count(glob($folder))+1;
			// el id tendrá el numero de archivos +1, será de 4 digitos y rellenará con 0s a la izquierda
			return str_pad($num_files, 4, "0", STR_PAD_LEFT);
		}

		function calcular_precio($precio_base, $edad, $disc){
			
			if ( $edad < 15 ){
				$precio_base = 40;
			}
			if ( $edad > 60 ){
				$precio_base = 20;
			}
			// comparamos 2 string sin importar mayúsculas o minúsculas
			if ( strnatcasecmp($disc, 'visual') == 0 ){
				$precio_base = $precio_base * 0.5;
			}
			if ( strnatcasecmp($disc, 'auditiva') == 0 ){
				$precio_base = $precio_base * 0.75;
			}

			return $precio_base;

		}

		function guardar_fichero_json(){
			
			$next_id = $this->get_numero_entrada();
			
			// formamos la ruta archivo con el id, la fecha y la extensión .txt
			$ruta = $this->carpeta_guardar.date('Y-m-d')."-".$next_id.$this->extension;
			// codificamos como json
			$file = json_encode($_POST);
			//escribimos los datos en el fichero, que si no existe, se crea

			$carpeta = new carpeta();
			$carpeta->guardar_fichero($ruta, $file);

		}
	}

	$entrada = new entrada();

