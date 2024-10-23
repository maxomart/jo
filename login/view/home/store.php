<?php
    require_once("c://xampp/htdocs/login/controller/homeController.php");
    $obj = new homeController();
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $confirmarPassword = $_POST['confirmarPassword'];
    $error = "";

    if(empty($correo) || empty($password) || empty($confirmarPassword))
    {
        $error .= "<li>Completa los compos</li>";
        header("Location:signup.php?error=".$error."&&correo=".$correo,"&&password=".$password."&&confirmarPassword=".$confirmarPassword);
    } else if ($correo && $password && $confirmarPassword)
    {
        if($password == $confirmarPassword)
        {
             if($obj->guardarUsuarios($correo,$password)== false )
             {
                $error .= "<li>El correo ya esta registrado</li>";
                header("Location:signup.php?error=".$error."&&correo=".$correo,"&&password=".$password."&&confirmarPassword=".$confirmarPassword);
             }else{
                header("Location:login.php");
             }
        }else 
        {
            $error .= "<li> Las contraseñas son diferentes </li>";
            header("Location:signup.php?error=".$error."&&correo=".$correo,"&&password=".$password."&&confirmarPassword=".$confirmarPassword);
        }
    }

?>