<?php
    require_once("c://xampp/htdocs/login/controller/homeController.php");
    session_start();
    $obj = new homeController();
    $correo= $obj->limpiarCorreo($_POST['correo']);
    $password= $obj->limpiarCadena($_POST['password']);
    $bandera = $obj->verificarUsuario($correo, $password);
    if($bandera)
    {
        $_SESSION['usuario'] = $correo;
        header("location:panelControl.php");
    }else
    {
        $error = "<li>Las claves son incorrectas</li>";
        header("location:login.php?error=".$error);
    }
?>