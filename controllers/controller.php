<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	public function pagina(){	
		
		include "views/template.php";
	
	}

	#ENLACES
	public function enlacesPaginasController(){

		if(isset( $_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}

		else{

			$enlaces = "index";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}

	#REGISTRO DE USUARIOS
	public function registroUsuarioController(){

		if(isset($_POST["usuarioRegistro"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioRegistro"]) && 
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordRegistro"]) && 
			   preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/', $_POST["emailRegistro"])){

				$encriptar = crypt($_POST["passwordRegistro"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array("usuario"=>$_POST["usuarioRegistro"], "password"=>$encriptar, "email"=>$_POST["emailRegistro"]);
			
				$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");
	
				if($respuesta == "success"){
	
					header("location:ok");
	
				}else{
	
					header("location:index.php");
	
				}
				
			}

		}
			
	}

	#INGRESO DE USUARIOS
	public static function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioIngreso"]) && 
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordIngreso"])){

				$encriptar = crypt($_POST["passwordIngreso"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array("usuario"=>$_POST["usuarioIngreso"], "password"=>$encriptar);
		
				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

				$intentos = $respuesta["intentos"];
				$usuario = $_POST["usuarioIngreso"];
				$maximoIntentos = 2;

				if($intentos < $maximoIntentos ){

					if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $encriptar){
	
						session_start();
						$_SESSION["validar"] = true;

						$intentos = 0;

						$datosController = array("usuarioActual"=>$usuario, "actualizarIntentos"=>$intentos);
	
						$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "usuarios");
		
						header("location:usuarios");
		
					}else{

						++$intentos;

						$datosController = array("usuarioActual"=>$usuario, "actualizarIntentos"=>$intentos);

						$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "usuarios");
		
						header("location:fallo");
		
					}

				}else{

					$intentos = 0;

					$datosController = array("usuarioActual"=>$usuario, "actualizarIntentos"=>$intentos);

					$respuestaActualizarIntentos = Datos::intentosUsuarioModel($datosController, "usuarios");

					header("location:fallo3intentos");
				}
	
			}

		}

	}

	#VISTA DE USUARIOS
	public static function vistaUsuariosController(){

		$respuesta = Datos::vistaUsuariosModel("usuarios");

		foreach($respuesta as $row => $item){
			echo '<tr>
					<td>'.$item["usuario"].'</td>
					<td>'.$item["password"].'</td>
					<td>'.$item["email"].'</td>
					<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
					<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
				 </tr>';
		}
		
	}

	#EDITAR USUARIO
	public static function editarUsuarioController(){

		$datosController = $_GET['id'];

		$respuesta = Datos::editarUsuarioModel($datosController, "usuarios");

		echo '
		<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

		<input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required>

		<input type="text" value="" placeholder="Ingrese la contraseña actual o una nueva" minlength="6" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="passwordEditar" required>
	
		<input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>
	
		<input type="submit" value="Actualizar">';

	}

	#ACTUALIZAR USUARIO
	public static function actualizarUsuarioController(){

		if(isset($_POST['usuarioEditar'])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioEditar"]) && 
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordEditar"]) && 
			   preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/', $_POST["emailEditar"])){

				$encriptar = crypt($_POST["passwordEditar"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array("id"=>$_POST["idEditar"], "usuario"=>$_POST["usuarioEditar"], "password"=>$encriptar, "email"=>$_POST["emailEditar"]);

				$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");
	
				if($respuesta == "success"){
	
					header("location:cambio");
	
				}else{
	
					echo "error";
	
				}

			}
	
		}

	}

	#BORRAR USUARIO
	public static function borrarUsuarioController(){

		if(isset($_GET['idBorrar'])){

			$datosController = $_GET['idBorrar'];

			$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");
			
			if($respuesta == "success"){

				header("location:usuarios");

			}

		}	

	}

	#VALIDAR USUARIO EXISTENTE
	public static function validarUsuarioController($validarUsuario){

		$datosController = $validarUsuario;

		$respuesta = Datos::validarUsuarioModel($datosController, "usuarios");

		if(strlen($respuesta["usuario"]) > 0){

			echo 'encontrado';

		}

	}

	#VALIDAR EMAIL EXISTENTE
	public static function validarEmailController($validarEmail){

		$datosController = $validarEmail;

		$respuesta = Datos::validarEmailModel($datosController, "usuarios");

		if(strlen($respuesta["email"]) > 0){

			echo 'encontrado';

		}

	}

}