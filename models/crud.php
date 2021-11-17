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

            $stmt = Conexion::conectar()->prepare("SELECT usuario, password, intentos FROM $tabla WHERE usuario = :usuario");

            $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;
        }

        #INTENTOS DE USUARIOS
        public static function intentosUsuarioModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intentos = :intentos WHERE usuario = :usuario");

            $stmt->bindParam(":intentos", $datosModel["actualizarIntentos"], PDO::PARAM_INT);
            $stmt->bindParam(":usuario", $datosModel["usuarioActual"], PDO::PARAM_STR);

            if($stmt->execute()){

                return "success";

            }else{

                return "error";

            }

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

        #EDITAR USUARIO
        public static function editarUsuarioModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;
        }

        #ACTUALIZAR USUARIO
        public static function actualizarUsuarioModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, email = :email WHERE id = :id");
            
            $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

            if($stmt->execute()){

                return "success";

            }else{

                return "error";

            }

            $stmt->closeCursor();
            $stmt = null;
            
        }

        #BORRAR USUARIO
        public static function borrarUsuarioModel($datosModel, $tabla){

            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");  
            
            $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

            if($stmt->execute()){

                return "success";

            }else{

                return "error";

            }

            $stmt->closeCursor();
            $stmt = null;

        }

    }