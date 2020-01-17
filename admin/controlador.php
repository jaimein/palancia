<?php
include 'conexion.php';
include_once 'inc/functions.php';
sec_session_start();
$usuario =  filter_input(INPUT_POST, 'usuario', $filter = FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'psha', $filter = FILTER_SANITIZE_STRING); // The hashed password.
$default_action = "login";
if (!login_check($conexion)) { //no estas autorizado
    if (isset($usuario, $password)) {
        if (login($usuario, $password, $conexion) == true) {
            // Éxito
            $accion = "lista_fiestas"; //acción por defecto
            echo "<div class=\"login\"> <a href=\"index.php?accion=logout\"> logout {$_SESSION['usuario']} </a></div>";
        } else {
            // Login error: no coinciden usuario y password
            $accion = "login";
        }
    } else {
        //significa que aún no has valores para usuario y password
        $accion = "login";
    }
} else { //estás autorizado  

    $accion = basename(filter_input(INPUT_GET, 'accion', $filter = FILTER_SANITIZE_STRING));
    switch ($accion) {
        case 'login':
            $accion = $default_action;
            echo "<div class=\"login\"> <a href=\"index.php?accion=logout\"> logout {$_SESSION['usuario']} </a></div>";
            break;
        case 'logout':
            logout();
            $accion = 'login';
    }

    if (!isset($accion)) {
        $accion = 'lista_fiestas'; //acción por defecto $default_action = "lista_fiestas"
    }
    if (!file_exists($accion . '.php')) { //comprobamos que el fichero exista
        $accion = 'lista_fiestas'; //si no existe mostramos la página por defecto
        echo "Operación no soportada: Podíamos mostrar la página 404";
    }
}
include($accion . '.php'); //y ahora mostramos la pagina llamada
