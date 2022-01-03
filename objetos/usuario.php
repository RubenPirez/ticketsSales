<?php

	include_once "carpeta.php";
	include_once "cookie.php";

	class usuario{

		public $nombre;
		public $apellidos;
		public $edad;
		public $dni;
		public $disc;
		public $genero;
		public $pais;
		public $pass;
		public $newPass;
		public $newUser;
		public $passNewUser;
		public $mensaje;
		public $is_user_reg = false;

		// carga los datos que vienen desde el formulario correspondiente
		function loader($datos){

			$this->nombre = @$datos["nombre"];
			$this->apellidos = (empty($datos['apellidos'])?"":$datos['apellidos']);
			$this->dni = (empty($datos['dni'])?"":$datos['dni']);
			$this->edad = (int)@$datos['edad'];
			$this->pais = (empty($datos['pais'])?"":$datos['pais']);
			$this->genero = (empty($datos['genero'])?"":$datos['genero']);
			$this->disc = @$datos['discapacidad'];
			$this->pass = @$datos["pass"];
			$this->newPass = @$datos["new-pass"];
			$this->newUser = @$datos["new-user-name"];
			$this->passNewUser = @$datos["new-user-pass"];
		}
		// obtiene y guarda en un array asociativo los datos de acceso de los distintos usuarios
		function file_array($path="seguridad.txt", $mode="r"){
			$file = fopen($path, $mode);
			$datos_acceso_users = [];
			while ( $linea = fgets($file)){
				$lineFile = explode(":", trim($linea), 3);
				$datos_acceso_users[] = [
					"user" => $lineFile[0],
					"password" => $lineFile[1],
					"token" => $lineFile[2]
				]; 
			}
			return $datos_acceso_users;
		}

		function access($nombre_cookie){
			if ( isset($_COOKIE[$nombre_cookie]) ){
				return true;
			} 		
		}
		// redirige a la ruta que se le pase como argumento
		function redirect($ruta){
			header("Location: ".$ruta);
		}

		function logout(){
			if ( isset($_POST["logout"])){
				return true;
			}
		}

		function get_nombre($lineFile){
			$nombre = $lineFile[0];
			return $nombre;
		}

		function get_pass($lineFile){	
			$pass = $lineFile[1];
			return $pass;
		}

		function get_token($lineFile){
			$token = $lineFile[2];
			return $token;
		}

		function comprueba_formulario($metodo){
			if ( empty($metodo) == false ){
				return true;
			}
		}

		function crea_usuario($archivo, $nombre, $pass){
			file_put_contents($archivo, "\n". $nombre, $pass);
			return "Usuario creado correctamente";
		}

		function borra_usuario(){

		}
		// comprueba si un usuario está en la lista de seguridad comparando nombre y password
		function comprueba_usuario($usuario, $password){

			$file = $this->file_array();

			foreach ($file as $datos) {
				if ( $datos["user"] == $usuario && $datos["password"] == $password){
					$this->is_user_reg = $datos;
				}
			}
		}
		// loguea al usuario y crea la cookie correspondiente
		function login_user(){
			if ( $this->is_user_reg != false ){
				$cookie = new cookie("usuario");
				$cookie->crear_cookie($this->is_user_reg["token"], time()+(60*60*24));
				$this->redirect("gestion.php");
				$this->is_user_reg = false;
			} else {
				$this->mensaje = "Datos de acceso erróneos";					
			}	
		}

		function cerrar_archivo($file){
			fclose($file);
		}
		// otra forma de comprobar si un usuario está en la lista de seguridad, utilizado después en la función cambia_password
		function is_user_reg($lineFile){
			if ( $this->get_nombre($lineFile) == $this->nombre AND $this->get_pass($lineFile) == $this->pass){
				return true;
			}
		}

		function cambia_password($mode){

			$file = fopen("seguridad.txt", $mode);
			$users = "";
				
				while ( ($bufer = fgets($file)) ){
					// recorre el fichero y obtiene el password de cada usuario
					$lineFile = explode(":", trim($bufer), 3);
					$pass_actual = $this->get_pass($lineFile);
					// cuando encuentra la línea del usuario actual, cambia el antigua pass por el nuevo
					if ( $this->is_user_reg($lineFile) ){
						$pass_actual = $this->newPass;
						$this->is_user_reg = true;

					}
					// concatena y guarda en la variable, todos los usuarios con los pass
					$users .= $this->get_nombre($lineFile).":".$pass_actual.":".$this->get_token($lineFile);
					$users .= "\r\n";
						
				}
				
			return $users;
			$this->cerrar_archivo($file);
		}

		function guarda_nuevo_usuario(){
			//controla que no haya campos vacíos en los datos del nuevo usuario
			if ( empty($this->newUser) == false && empty($this->passNewUser) == false ){
				// asigna un token aleatorio
				$randomToken = mt_rand(100000000000000000, 999999999999999999);
				//obtiene los datos del nuevo usuario y los guarda, haciendo un salto de línea
				$newUser = $this->newUser.":".$this->passNewUser.":".$randomToken;
				file_put_contents("seguridad.txt", "\n".$newUser, FILE_APPEND);
				$mensaje = "Usuario nuevo registrado correctamente";
			} else {
				$mensaje = "El nuevo usuario no puede tener campos vacíos";
			}
			return $mensaje;		
		}
	}

	$usuario = new usuario();

?>