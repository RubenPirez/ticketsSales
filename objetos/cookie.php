<?php

	class cookie{

		public $nombre;
		//public $valor;
		//public $expire;

		function __construct($nombre){
			$this->nombre = $nombre;
		}
		// crea una cookie con el valor y la duración que se le pasen como argumentos
		function crear_cookie($valor, $expire = 0){

			if ( isset($_COOKIE[$this->nombre]) == false){
				setcookie( $this->nombre, $valor, $expire );	
			} else {
				echo "La Cookie ya existe";
			}	
		}	

		function get_nombre_cookie(){
			return $this->nombre;
		}

		function get_valor_cookie(){
			return $_COOKIE[$this->nombre];
		}
		//borra la cookie que se le pase como argumento
		function borrar_cookie(){
			setcookie($this->nombre, false, -1);			
		}

	}

	//$cookie = new cookie($nombre);

