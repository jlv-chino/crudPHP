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

			$datosController = array("usuario"=>$_POST["usuarioRegistro"], "password"=>$_POST["passwordRegistro"], "email"=>$_POST["emailRegistro"]);
		
			$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:index.php?action=ok");

			}else{

				header("location:index.php");

			}

		}
		
		
	}

	#INGRESO DE USUARIOS
	public static function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

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

	#VISTA DE USUARIOS
	public static function vistaUsuariosController(){

		$respuesta = Datos::vistaUsuariosModel("usuarios");

		foreach($respuesta as $row => $item){
			echo '<tr>
					<td>'.$item["usuario"].'</td>
					<td>'.$item["password"].'</td>
					<td>'.$item["email"].'</td>
					<td><button>Editar</button></td>
					<td><button>Borrar</button></td>
				 </tr>';
		}
		
	}

}

?>