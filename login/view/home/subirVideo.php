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

                        <form action="procesarVideo.php" method="POST" enctype="multipart/form-data" id="videoForm">
                            <!-- Título del Video -->
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título del Video</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingresa el título del video" required>
                            </div>

                            <!-- Descripción del Video -->
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción del Video</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Agrega una descripción sobre el video" required></textarea>
                            </div>

                            <!-- Selección del Video -->
                            <div class="mb-3">
                                <label for="archivo" class="form-label">Seleccionar Video</label>
                                <div class="input-group">
                                    <label class="input-group-text" for="archivo">Subir</label>
                                    <input type="file" class="form-control" id="archivo" name="archivo" accept="video/mp4" required>
                                </div>
                            </div>

                            <!-- Barra de Progreso -->
                            <div id="progressContainer" class="progress">
                                <div id="progressBar" class="progress-bar" role="progressbar">0%</div>
                            </div>

                            <!-- Botón para subir -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-block">Subir Video</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para la barra de progreso -->
    <script>
        const form = document.getElementById('videoForm');
        const progressBar = document.getElementById('progressBar');
        const progressContainer = document.getElementById('progressContainer');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir el envío inmediato del formulario

            // Mostrar barra de progreso
            progressContainer.style.display = 'block';

            const xhr = new XMLHttpRequest();
            const formData = new FormData(form);

            xhr.open('POST', form.action, true);

            xhr.upload.onprogress = function(event) {
                if (event.lengthComputable) {
                    const percentage = Math.round((event.loaded / event.total) * 100);
                    progressBar.style.width = percentage + '%';
                    progressBar.textContent = percentage + '%';
                }
            };

            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Video subido correctamente
                    alert('Video subido correctamente');
                    // Aquí puedes redirigir a una nueva página si lo prefieres
                    window.location.href = 'panelControl.php'; 
                } else {
                    alert('Error al subir el video');
                }
            };

            xhr.send(formData);
        });
    </script>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
