<?php

class homeModel
{
    public function agregarNuevoUsuario($correo, $password)
    {
            require_once("c://xampp/htdocs/login/config/db.php");
            $statement = $pdo->prepare("INSERT INTO usuarios VALUES(null,:correo,:password)");
            $statement->bindParam(":correo", $correo);
            $statement->bindParam(":password", $password);
            try {
                $statement->execute();
                return true;
            } catch (PDOException $e) {
                return false;
            }
         
        }
        public function obtenerClave($correo)
        {
            require_once("c://xampp/htdocs/login/config/db.php");
            $statement = $pdo->prepare("SELECT  password FROM usuarios WHERE correo = :correo");
            $statement->bindParam(":correo", $correo);
            return ($statement->execute()) ? $statement->fetch()['password'] : false;
         }
    }

?>