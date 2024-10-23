<?php
    require_once("c://xampp/htdocs/login/view/head/head.php");
    if(!empty($_SESSION['usuario']))
    {
        header("location:panelControl.php");
    }
?>

<body>
    <div class="fondo-login2">
        <div class="icon">
                <a href="/login/index.php">
                    <img src="logo.png" alt="Logo" class="login-logo">
                </a>
        </div>
            <div class="titulo">
                    Regístrate 
            </div>
            <form action="store.php" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" value="<?= (!empty($_GET['correo'])) ? $_GET['correo'] :  "" ?>" name="correo" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa tu correo">
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <div class="box-eye">
                            <button type="button" onclick="mostrarContraseña('Password', 'eye_password')">
                                <i id="eye_password" class="fa-regular fa-eye changePassword"></i>
                            </button>
                        </div>
                        <input type="password" name="password"  class="form-control" id="Password" placeholder="Ingresa tu contraseña">
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Repite la contraseña</label>
                        <div class="box-eye">
                            <button type="button" onclick="mostrarContraseña('Password2', 'eye_password2')">
                                <i id="eye_password2" class="fa-regular fa-eye changePassword"></i>
                            </button>
                        </div>
                        <input type="password" name="confirmarPassword" class="form-control" id="Password2" placeholder="Ingresa tu contraseña">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2" required>
                        <label class="form-check-label" for="exampleCheck2">Acepto los términos y condiciones</label>
                    </div>
                    <?php if(!empty($_GET['error'])):?>
                        <div id="alertError" style="margin: auto;" class="alert alert-danger mb-2" role="alert">
                            <?= !empty($_GET['error']) ? $_GET['error'] : "" ?>
                        </div>
                    <?php endif;?>
                <button type="submit" class="btn btn-primary btn-block">Crear cuenta</button>
            </form>
            <div class="login">
                ¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>
            </div>
    </div>
</body>





<?php
    require_once("c://xampp/htdocs/login/view/head/footer.php")
?>