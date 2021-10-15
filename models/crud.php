<?php

require_once "conexion.php";

    class Datos extends Conexion{

        #REGISTRO DE USUARIOS
        public static function registroUsuarioModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, password, email) VALUES (:usuario, :password, :email)");

            $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

            if($stmt->execute()){

                return "success";

            }else{

                return "error";

            }

            $stmt->closeCursor();
            $stmt = null;

        }

        #INGRESO DE USUARIOS
        public static function ingresoUsuarioModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("SELECT usuario, password FROM $tabla WHERE usuario = :usuario");

            $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;
        }

        #VISTA DE USUARIOS
        public static function vistaUsuariosModel($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();
            return $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;
        }

    }

?>