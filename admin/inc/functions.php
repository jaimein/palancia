<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function sec_session_start()
{
    $session_name = 'sec_session_id';   //Asignamos un nombre de sesión
    $secure = false; //SECURE; Lo ideal sería true para trabajar con https
    $httponly = true;
    // Obliga a la sesión a utilizar solo cookies.
    // Habilitar este ajuste previene ataques que impican pasar el id de sesión en la URL.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        $page = "error";
        $error = "No puedo iniciar una sesion segura (ini_set)";
    }
    // Obtener los parámetros de la cookie de sesión
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params(
        $cookieParams["lifetime"],
        $cookieParams["path"],
        $cookieParams["domain"],
        $secure, //si es true la cookie sólo se enviará sobre conexiones seguras
        $httponly
    );  //Marca la cookie como accesible sólo a través del protocolo HTTP. 
    //Esto siginifica que la cookie no será accesible por lenguajes de script, tales como JavaScript. 
    //Este ajuste puede ayudar de manera efectiva //a reducir robos de indentidad a través de ataques
    session_name($session_name);
    session_start();            // Incia la sesión PHP
    session_regenerate_id(true);  // Actualiza el id de sesión actual con uno generado más reciente  
    //Ayuda a evitar ataques de fijación de sesión
}

function login($usuario, $password, $conexion)
{
    // Usar consultas preparadas previene de los ataques SQL injection. 
    $query = "SELECT id, usuario, password, tipo FROM usuarios WHERE usuario = :usuario LIMIT 1";
    if ($stmt = $conexion->prepare($query)) {
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            $valor = $stmt->fetch();
            $id = $valor['id'];
            $user = $valor['usuario'];
            $db_password = $valor['password'];
            $tipo = $valor['tipo'];

            // Si el usuario existe comprobamos que la cuenta no esté bloqueada
            // por haber hecho demasiados intentos.
            if (checkbrute($id, $conexion) == true) { //la veremos luego
                // La cuenta está bloqueada. Aquí escribir las acciones de aviso al usuario pertinentes: enviar un correo
                $error = "Cuenta Bloqueada";
                echo $error;
                return false;
            } else {
                // Comprobar si el password y el user de la bd coincide con la enviada por el usuario
                if ($db_password == $password && $usuario == $user) { //las dos en sha512
                    // Password es correcto: Tomamos user-agent string del navegador del usuario
                    // por ejemplo Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // Esto es una protección contra ataques XSS
                    $user_id = preg_replace("/[^0-9]+/", "", $id);
                    $_SESSION['id'] = $id;
                    $_SESSION['tipo'] = $tipo;
                    // Esto es una protección contra ataques XSS
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $usuario);
                    $_SESSION['usuario'] = $username;
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                    // Éxito en la validación.
                    return true;
                } else {
                    // Password no es correcto. Registramos el intento
                    $now = time();
                    $query = "INSERT INTO login_attempts(id, time) VALUES (:id, :now)";
                    $stmt = $conexion->prepare($query);
                    $stmt->bindParam(':id', $id);
                    $stmt->bindParam(':now', $now);
                    $stmt->execute();
                    return false;
                }
            }
        } else {
            // No existe el usuario
            return false;
        }
    }
}

function checkbrute($id, $conexion)
{
    // Toma la hora actual
    $now = time();
    // Se cuentan los intentos de las 2 últimas horas 
    $valid_attempts = $now - (2 * 60 * 60);
    $query = "SELECT time FROM login_attempts WHERE id = :id AND time > :tiemposvalidos ;";
    if ($stmt = $conexion->prepare($query)) {
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tiemposvalidos', $valid_attempts);
        $stmt->execute();
        // Si ha habido más de 3 logins
        if ($stmt->rowCount() > 3) {
            return true;
        } else {
            return false;
        }
    }
}

function login_check($conexion)
{
    // Comprueba que todas las variables de sesión estén inicializadas
    if (isset($_SESSION['id'], $_SESSION['usuario'], $_SESSION['login_string'])) {
        $id = $_SESSION['id'];
        $login_string = $_SESSION['login_string'];
        $usuario = $_SESSION['usuario'];
        // Obtener el user-agent string.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        $query = "SELECT password FROM usuarios WHERE id = :id and usuario = :usuario LIMIT 1";
        if ($stmt = $conexion->prepare($query)) {
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':usuario',$usuario);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $valor = $stmt->fetch();
                $password = $valor['password'];
                $login_check = hash('sha512', $password . $user_browser);

                if ($login_check == $login_string) {
                    // coinciden 
                    return true;
                } else {
                    // No está logado
                    return false;
                }
            } else {
                // No está logado el usuario no existe
                return false;
            }
        } else {
            // No está logado
            return false;
        }
    } else {
        // No está logado
        return false;
    }
}

function logout()
{
    // Unset all session values 
    $_SESSION = array();

    // get session parameters 
    $params = session_get_cookie_params();

    // Delete the actual cookie. 
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

    // Destroy session 
    session_destroy();
}
