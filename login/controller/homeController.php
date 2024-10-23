<?php

    class homeController
    {
        private $MODEL;
        public function __construct()
        {
            require_once("c://xampp/htdocs/login/model/homeModel.php");
            $this->MODEL = new homeModel(); 
        }
        public function guardarUsuarios($correo, $password)
        {
            
            $valor = $this->MODEL->agregarNuevoUsuario($this->limpiarCorreo($correo), $this->encriptarContraseña($this->limpiarCadena($password)));
            return $valor;
        }
        public function limpiarCadena($campo)
        {
            $campo = strip_tags($campo);
            $campo = filter_var($campo, FILTER_UNSAFE_RAW);
            $campo = htmlspecialchars($campo);
            return $campo;
        }
        public function limpiarCorreo($campo)
        {
            $campo = strip_tags($campo);
            $campo = filter_var($campo, FILTER_SANITIZE_EMAIL);
            $campo = htmlspecialchars($campo);
            return $campo;
        }
        public function encriptarContraseña($password)
        {
            return password_hash($password, PASSWORD_DEFAULT);
        }

        public function verificarUsuario($correo,$password)
        {
            $keydb= $this->MODEL->obtenerClave($correo);
            return (password_verify($password,$keydb)) ? true : false;   
        }
    }
?>