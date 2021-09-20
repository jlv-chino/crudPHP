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

		if(isset($_POST["usuario"])){

			$datosController = array("usuario"=>$_POST["usuario"], "password"=>$_POST["password"], "email"=>$_POST["email"]);
		
			$respuesta = Datos::registroUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:index.php?action=ok");

			}else{

				header("location:index.php");

			}

		}
		
		
	}

}

?>