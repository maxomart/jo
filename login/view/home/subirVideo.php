<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Video</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .form-control:focus {
            border-color: #ABF600;
            box-shadow: none;
        }
        .btn-primary {
            background-color: #ABF600;
            border-color: #ABF600;
        }
        .btn-primary:hover {
            background-color: #94d500;
            border-color: #94d500;
        }
        .custom-file-input {
            display: none;
        }
        .custom-file-label {
            cursor: pointer;
        }
        #progressContainer {
            display: none;
            margin-top: 20px;
        }
        #progressBar {
            width: 0;
            height: 20px;
            background-color: #ABF600;
            text-align: center;
            color: white;
            line-height: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center">Subir Nuevo Video</h2>
                        <p class="text-center">Llena los siguientes campos para subir tu video</p>

                        <form id="videoForm" action="procesarVideo.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título del Video</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="archivo" class="form-label">Subir Video (mp4)</label>
                                <input type="file" class="form-control" id="archivo" name="archivo" accept="video/mp4" required>
                            </div>
                            <div class="mb-3">
                                <label for="miniatura" class="form-label">Subir Miniatura (jpg o png)</label>
                                <input type="file" class="form-control" id="miniatura" name="miniatura" accept="image/*" required>
                            </div> -->
                            <button type="submit" class="btn btn-primary">Subir Video</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
