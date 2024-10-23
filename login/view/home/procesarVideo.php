<?php

require_once("c://xampp/htdocs/login/config/db.php");
session_start();
var_dump($_SESSION);

if ($_POST) {

    if (!isset($_SESSION['id_usuario'])) {
        echo "Error: ID de usuario no definido.";
        exit; 
    }
    

    $id_usuario = $_SESSION['id_usuario'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $file = $_FILES['archivo'];
    $miniatura = $_FILES['miniatura'];

   echo "ID de usuario: " . $id_usuario; 
    
    if ($file['error'] === 0 && $miniatura['error'] === 0) {
        $directorio_videos = "videos/"; 
        $directorio_miniaturas = "miniaturas/";       
        $video_destino = $directorio_videos . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $video_destino)) {
            $miniatura_destino = $directorio_miniaturas . basename($miniatura['name']);
            if (move_uploaded_file($miniatura['tmp_name'], $miniatura_destino)) {
                $sql_insertar = 'INSERT INTO videos (titulo, descripcion, url_video, url_miniatura) VALUES (?, ?, ?, ?)';
                $sentencia = $pdo->prepare($sql_insertar);
                $sentencia->execute(array($titulo, $descripcion, $video_destino, $miniatura_destino));

                echo'Se guardo bien';
            }    
        }   
    }
} else {
    echo 'Error';
}
?>
