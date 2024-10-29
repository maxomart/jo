<?php

require_once '../lib/jwt_helper.php';
require_once '../config/db.php';
require_once '../config/jwt.php';

/***************************** RUTEO ********************************/

if (!isset($_GET['accion'])) {
    outputError();
}

$metodo = strtolower($_SERVER['REQUEST_METHOD']);
$accion = explode('/', strtolower($_GET['accion']));
$funcionNombre = $metodo . ucfirst($accion[0]);
$parametros = array_slice($accion, 1);
if (count($parametros) >0 && $metodo == 'get') {
    $funcionNombre = $funcionNombre.'ConParametros';
}
if (function_exists($funcionNombre)) {
    call_user_func_array ($funcionNombre, $parametros);
} else {
    outputError(400, "No existe " . $funcionNombre);
}


/***************************** SALIDA ********************************/

function outputJson($data, $codigo = 200)
{
    header('', true, $codigo);
    header('Content-type: application/json');
    print json_encode($data);
    die;
}

function outputError($codigo = 500, $mensaje = "")
{
    switch ($codigo) {
        case 400:
            header($_SERVER["SERVER_PROTOCOL"] . " 400 Bad request", true, 400);
            break;
        case 401:
            header($_SERVER["SERVER_PROTOCOL"] . " 401 Unauthorized", true, 401);
            break;
        case 403:
            header($_SERVER["SERVER_PROTOCOL"] . " 403 Forbidden", true, 403);
            break;
        case 404:
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
            break;
        default:
            header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error", true, 500);
            break;
    }
    print json_encode($mensaje);
    die;
}


/***************************** BBDD ********************************/

function conectarBD()
{
    $link = mysqli_connect(DBHOST, DBUSER, DBPASS, DBBASE);
    if ($link === false) {
        outputError(500, "Falló la conexión: " . mysqli_connect_error());
    }
    mysqli_set_charset($link, 'utf8');
    return $link;
}


/***************************** SEGURIDAD ********************************/

function requireLogin () {
    $authHeader = getallheaders();
    try
    {
        list($jwt) = @sscanf($authHeader['Authorization'], 'Bearer %s');
        $datos = JWT::decode($jwt, JWT_KEY, JWT_ALG);
        $link = conectarBD();
        $jwtSql = mysqli_real_escape_string($link, $jwt);
        $resultado = mysqli_query($link, $sql = "SELECT 1 FROM tokens WHERE token = '$jwtSql'");
        if (!$resultado) {
            outputError(500, mysqli_error($link));
        } elseif (mysqli_num_rows($resultado)!=1) {
            outputError(401);
        }
        mysqli_close($link);
    } catch(Exception $e) {
        outputError(401);
    }
}


function limpiarTokensExpirados () {
    $link = conectarBD();
    $resultado = mysqli_query($link, "SELECT token FROM tokens");
    while ($fila=mysqli_fetch_assoc($resultado)) {
        $jwt = $fila['token'];
        try {
            JWT::decode($jwt, JWT_KEY, JWT_ALG);
        } catch(Exception $e) {
            $jwtSql = mysqli_real_escape_string($link, $jwt);
            mysqli_query($link, "DELETE FROM tokens WHERE token = '$jwtSql'");
        }
    }
    mysqli_close($link);
}


/***************************** API ********************************/

function postLogin() {
    limpiarTokensExpirados(); // borra de la BBDD todos los tokens inválidos (expirados).
    $loginData = json_decode(file_get_contents("php://input"), true);
    $link = conectarBD();

    $email = mysqli_real_escape_string($link, $loginData['email']);
    $clave = mysqli_real_escape_string($link, $loginData['clave']);

    var_dump($email, $clave);

    $sql = "SELECT id, nombre FROM usuarios WHERE email='$email' AND clave='$clave'";
    $resultado = mysqli_query($link, $sql);
    if($resultado && mysqli_num_rows($resultado)==1) {
    var_dump($email,$clave);

        $logged = mysqli_fetch_assoc($resultado);
        $data = [
            'uid'       => $logged['id'],
            'nombre'    => $logged['nombre'],
            'exp'       => time() + JWT_EXP,
        ];
        $jwt = JWT::encode($data, JWT_KEY, JWT_ALG);
        $jwtSql = mysqli_real_escape_string($link, $jwt);
        mysqli_query($link, "DELETE FROM tokens WHERE token = '$jwtSql'");
        if (mysqli_query($link, "INSERT INTO tokens (token) VALUES ('$jwtSql')")) {
            outputJson(['jwt' => $jwt]);
        } else {
            outputError(500, mysqli_error($link));
        }
    }
    outputError(401);
}

function postLogout() {
    requireLogin();
    $link = conectarBD();
    $authHeader = getallheaders();
    list($jwt) = @sscanf( $authHeader['Authorization'], 'Bearer %s');
    if (!mysqli_query($link, "DELETE FROM tokens WHERE token = '$jwt'")) {
        outputError(403);
    }
    mysqli_close($link);
    outputJson([]);
}

function getContactos()
{
    requireLogin();
    $link = conectarBD();
    $sql = "SELECT id, nombre, apellido, email FROM contactos";
    $resultado = mysqli_query($link, $sql);
    if ($resultado === false) {
        outputError(500, "Falló la consulta: " . mysqli_error($link));
    }
    $ret = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $ret[] = [
            'id' => $fila['id'],
            'apellido' => $fila['apellido'],
            'nombre'   => $fila['nombre'],
            'email'    => $fila['email']
        ];
    }
    mysqli_free_result($resultado);
    mysqli_close($link); 
    outputJson($ret);
}

function getContactosConParametros($id)
{
    requireLogin();
    $id+=0;
    $link = conectarBD();
    $sql = "SELECT * FROM contactos WHERE id=$id";
    $resultado = mysqli_query($link, $sql);
    if ($resultado === false) {
        outputError(500, "Falló la consulta: " . mysqli_error($link));
        die;
    }
    if (mysqli_num_rows($resultado) == 0) {
        outputError(404);
    }

    $ret = mysqli_fetch_assoc($resultado);

    mysqli_free_result($resultado);
    mysqli_close($link);
    outputJson($ret);
}

function postContactos()
{
    requireLogin();
    $link = conectarBD();
    $dato = json_decode(file_get_contents('php://input'), true);
    if (json_last_error()) {
        outputError(400, "El formato de datos es incorrecto");
    }
    if (! (isset($dato['nombre']) && isset($dato['apellido']) && isset($dato['email']))) {
        outputError(400, "Los datos email, nombre y apellido deben estar completos.");
    }
    $nombre = mysqli_real_escape_string($link, $dato['nombre']);
    $apellido = mysqli_real_escape_string($link, $dato['apellido']);
    $email = mysqli_real_escape_string($link, $dato['email']);
    $domicilio = isset($dato['domicilio']) ? ("'" . mysqli_real_escape_string($link, $dato['domicilio']) . "'") : 'NULL';
    $fdn = isset($dato['fecha_de_nacimiento']) ? ("'" . mysqli_real_escape_string($link, substr($dato['fecha_de_nacimiento'], 0, 10)) . "'") : 'NULL';
    if ($fdn != 'NULL') {
        list($anio, $mes, $dia) = explode('-', str_replace("'", "", $fdn));
        if(!checkdate($mes, $dia, $anio)) {
            outputError(400, "La fecha de nacimiento no es válida");
        }
    }
    
    $sql = "INSERT INTO contactos (nombre, apellido, email, fecha_de_nacimiento, domicilio) VALUES ('$nombre', '$apellido', '$email', $fdn, $domicilio)";
    
    $resultado = mysqli_query($link, $sql);
    if ($resultado === false) {
        outputError(500, "Falló la consulta: " . mysqli_error($link));
    }

    $ret = [
        'id' => mysqli_insert_id($link)
    ];

    mysqli_close($link);
    outputJson($ret, 201);
}

function patchContactos($id)
{
    requireLogin();
    $id += 0;
    $link = conectarBD();
    $dato = json_decode(file_get_contents('php://input'), true);
    if (json_last_error()) {
        outputError(400, "El formato de datos es incorrecto");
    }
    if (! (isset($dato['nombre']) && isset($dato['apellido']) && isset($dato['email']))) {
        outputError(400, "Los datos email, nombre y apellido deben estar completos.");
    }
    $nombre = mysqli_real_escape_string($link, $dato['nombre']);
    $apellido = mysqli_real_escape_string($link, $dato['apellido']);
    $email = mysqli_real_escape_string($link, $dato['email']);
    $domicilio = isset($dato['domicilio']) ? ("'" . mysqli_real_escape_string($link, $dato['domicilio']) . "'") : 'NULL';
    $fdn = isset($dato['fecha_de_nacimiento']) ? ("'" . mysqli_real_escape_string($link, substr($dato['fecha_de_nacimiento'], 0, 10)) . "'") : 'NULL';
    if ($fdn != 'NULL') {
        list($anio, $mes, $dia) = explode('-', str_replace("'", "", $fdn));
        if(!checkdate($mes+0, $dia+0, $anio+0)) {
            outputError(400, "La fecha de nacimiento no es válida");
        }
    }
    
    $sql = "UPDATE contactos SET nombre = '$nombre', apellido = '$apellido', email = '$email', fecha_de_nacimiento = $fdn, domicilio = $domicilio WHERE id = $id";
    
    $resultado = mysqli_query($link, $sql);
    if ($resultado === false) {
        outputError(500, "Falló la consulta: " . mysqli_error($link));
    }

    $ret = [];

    mysqli_close($link);
    outputJson($ret, 201);
}

function deleteContactos($id)
{
    requireLogin();
    $id+=0;
    $link = conectarBD();
    $sql = "SELECT id FROM contactos WHERE id=$id";
    $resultado = mysqli_query($link, $sql);
    if ($resultado === false) {
        outputError(500, "Falló la consulta: " . mysqli_error($link));
    }
    if (mysqli_num_rows($resultado) == 0) {
        outputError(404);
    }
    mysqli_free_result($resultado);
    $sql = "DELETE FROM contactos WHERE id=$id";
    $resultado = mysqli_query($link, $sql);
    if ($resultado === false) {
        outputError(500, "Falló la consulta: " . mysqli_error($link));
    }
    mysqli_close($link);
    outputJson([]);
}
