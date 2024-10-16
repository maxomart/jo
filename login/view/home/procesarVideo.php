<?php
// Incluir la conexión a la base de datos
require_once("c://xampp/htdocs/login/config/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Conectar a la base de datos
        $pdo = new db();
        $conn = $pdo->conexion();

        // Obtener los datos del formulario
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $id_usuario = 1; // Deberías obtener este valor desde la sesión del usuario autenticado

        // Comprobar si se ha subido un archivo
        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
            // Obtener detalles del archivo
            $archivoTmpPath = $_FILES['archivo']['tmp_name'];
            $nombreArchivo = $_FILES['archivo']['name'];
            $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

            // Validar extensión del archivo (solo mp4 permitido)
            if ($ext !== 'mp4') {
                echo "Error: Solo se permiten archivos de video mp4.";
                exit;
            }

            // Crear una nueva ruta de archivo
            $nuevoNombreArchivo = uniqid('video_', true) . '.' . $ext;
            $rutaDestino = 'videos' . $nuevoNombreArchivo;

            // Mover el archivo subido a la carpeta de destino
            if (move_uploaded_file($archivoTmpPath, $rutaDestino)) {
                // Insertar la información del video en la base de datos
                $statement = $conn->prepare("INSERT INTO videos (id_usuario, titulo, descripcion, url_video) VALUES (:id_usuario, :titulo, :descripcion, :url_video)");
                $statement->bindParam(':id_usuario', $id_usuario);
                $statement->bindParam(':titulo', $titulo);
                $statement->bindParam(':descripcion', $descripcion);
                $statement->bindParam(':url_video', $rutaDestino);

                if ($statement->execute()) {
                    echo "El video se ha subido y guardado correctamente.";
                } else {
                    echo "Error al guardar el video en la base de datos.";
                }
            } else {
                echo "Error al mover el archivo al servidor.";
            }
        } else {
            echo "Error: No se ha subido ningún archivo.";
        }
    } catch (PDOException $e) {
        // Mostrar el error específico de la base de datos
        echo "Error de conexión o consulta a la base de datos: " . $e->getMessage();
    }
}
?>
