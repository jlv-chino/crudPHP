<?php

require_once "../../controllers/controller.php";
require_once "../../models/crud.php";

class ajax{

    public $validarUsuario;
    
    public function validarUsuarioAjax(){

        $datos = $this->validarUsuario;

        $respuesta = MvcController::validarUsuarioController($datos);

        echo $respuesta;

    }
    

    public $validarEmail;

    public function validarEmailAjax(){

        $datos = $this->validarEmail;

        $respuesta = MvcController::validarEmailController($datos);

        echo $respuesta;

    }

}

if(isset($_POST["validarUsuario"])){
    $a = new Ajax();
    $a->validarUsuario = $_POST["validarUsuario"];
    $a->validarUsuarioAjax();
}

if(isset($_POST["validarEmail"])){
    $b = new Ajax();
    $b->validarEmail = $_POST["validarEmail"];
    $b->validarEmailAjax();
}
