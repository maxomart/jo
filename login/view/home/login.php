<?php
    require_once("c://xampp/htdocs/login/view/head/head.php");
    if(!empty($_SESSION['usuario']))
    {
        header("location:panelControl.php");
    }
?>

<body>
    <div class="fondo-login">
        <div class="icon">
                <a href="/login/index.php">
                    <img src="logo.png" alt="Logo" class="login-logo">
                </a>
        </div>
            <div class="titulo">
                    Inicia sesión
            </div>
            <form action="verificar.php" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" name="correo" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa tu correo">
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <div class="box-eye">
                            <button type="button" onclick="mostrarContraseña('Password', 'eye_password')">
                                <i id="eye_password" class="fa-regular fa-eye changePassword"></i>
                            </button>
                        </div>
                        <input type="password" name="password" class="form-control" id="Password" placeholder="Ingresa tu contraseña">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Recuérdame</label>
                </div>
                <?php if(!empty($_GET['error'])):?>
                        <div id="alertError" style="margin: auto;" class="alert alert-danger mb-2" role="alert">
                            <?= !empty($_GET['error']) ? $_GET['error'] : "" ?>
                        </div>
                    <?php endif;?>
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </form>
        <div class="login">
                ¿No tienes cuenta? <a href="signup.php">Regístrate</a>
        </div>
    </div>
</body>





<?php
    require_once("c://xampp/htdocs/login/view/head/footer.php")
?>