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

				$datosController = array("usuario"=>$_POST["usuarioRegistro"], "password"=>$_POST["passwordRegistro"], "email"=>$_POST["emailRegistro"]);
			
				$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");
	
				if($respuesta == "success"){
	
					header("location:index.php?action=ok");
	
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

				$datosController = array("usuario"=>$_POST["usuarioIngreso"], "password"=>$_POST["passwordIngreso"]);
		
				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
	
				if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password" == $_POST["passwordIngreso"]]){
	
					session_start();
					$_SESSION["validar"] = true;
	
					header("location:index.php?action=usuarios");
	
				}else{
	
					header("location:index.php?action=fallo");
	
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

		<input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" maxlength="6" required>

		<input type="text" value="'.$respuesta["password"].'" name="passwordEditar" minlength="6" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
	
		<input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>
	
		<input type="submit" value="Actualizar">';

	}

	#ACTUALIZAR USUARIO
	public static function actualizarUsuarioController(){

		if(isset($_POST['usuarioEditar'])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioEditar"]) && 
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordEditar"]) && 
			   preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/', $_POST["emailEditar"])){

				$datosController = array("id"=>$_POST["idEditar"], "usuario"=>$_POST["usuarioEditar"], "password"=>$_POST["passwordEditar"], "email"=>$_POST["emailEditar"]);

				$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");
	
				if($respuesta == "success"){
	
					header("location:index.php?action=cambio");
	
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

				header("location:index.php?action=usuarios");

			}

		}	

	}

}

?>