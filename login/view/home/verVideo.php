<?php
    require_once("c://xampp/htdocs/login/config/db.php");
    require_once("c://xampp/htdocs/login/view/head/header.php");

  


    if (isset($_GET['id'])) {
        $videoId = $_GET['id'];

        $statement = $pdo->prepare("SELECT * FROM videos WHERE id = :id");
        $statement->bindParam(':id', $videoId);
        $statement->execute();
        $video = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$video) {
            echo "Video no encontrado.";
            exit;
        }
    } else {
        echo "ID de video no proporcionado.";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($video['titulo']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <div class="text-center">
    <img src="<?= htmlspecialchars($video['url_miniatura']); ?>" alt="Miniatura del video" class="img-fluid mb-3">
    <video width="600" controls>
        <source src="<?= htmlspecialchars($video['url_video']); ?>" type="video/mp4">
        Tu navegador no soporta la etiqueta de video.
    </video>
    <h1 class="text-center"><?= htmlspecialchars($video['titulo']); ?></h1>
    <p class="text-center"><?= htmlspecialchars($video['descripcion']); ?></p>
</div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    require_once("c://xampp/htdocs/login/view/head/footer.php");
?>
