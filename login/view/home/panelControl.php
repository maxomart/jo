<?php
    // Incluir la conexión a la base de datos y otros archivos necesarios
    require_once("c://xampp/htdocs/login/config/db.php");
    require_once("c://xampp/htdocs/login/view/head/header.php");

    // Verificar si el usuario está autenticado
    if(empty($_SESSION['usuario'])) {
        header("location:login.php");
        exit; // Asegurarse de que no se ejecute más código
    }

    // Conectar a la base de datos
    $pdo = new db();
    $conn = $pdo->conexion();

    // Consultar videos
    $statement = $conn->prepare("SELECT * FROM videos ORDER BY fecha_subida DESC");
    $statement->execute();
    $videos = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #212121;
        }
        .container {
            margin-top: 50px;
        }
        .video-card {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
       
        <div class="row">
            <?php foreach ($videos as $video): ?>
                <div class="col-md-4 video-card">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="verVideo.php?id=<?= htmlspecialchars($video['id']); ?>">
                                    <?= htmlspecialchars($video['titulo']); ?>
                                </a>
                            </h5>
                            <p class="card-text"><?= htmlspecialchars($video['descripcion']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    // Incluir el footer
    require_once("c://xampp/htdocs/login/view/head/footer.php");
?>
