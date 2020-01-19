<?php
include 'conexion.php';
include_once 'inc/functions.php';
sec_session_start();
$usuario =  filter_input(INPUT_POST, 'usuario', $filter = FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'psha', $filter = FILTER_SANITIZE_STRING); // The hashed password.
$default_action = "login";
$conexion2 = modelo::GetInstance();
if (!login_check($conexion2)) { //no estas autorizado/logueado
    if (isset($usuario, $password)) {
        if (login($usuario, $password, $conexion2) == true) {
            // Éxito
            $accion = "lista_fiestas"; //acción por defecto
            echo "<div class=\"login\"> <a href=\"index.php?accion=logout\"> logout {$_SESSION['usuario']} </a></div>";
        } else {
            // Login error: no coinciden usuario y password
            echo "Contraseña o usuario erroneos<br/>Si lo ha intentado 3 veces espere 2 horas";
            $accion = "login";
        }
    } else {
        //significa que aún no has valores para usuario y password
        $accion = "login";
    }
} else { //estás autorizado  

    $accion = basename(filter_input(INPUT_GET, 'accion', $filter = FILTER_SANITIZE_STRING));
    switch ($accion) {

        case 'logout':
            logout();
            $accion = 'login';
            break;
        case 'login':
        case '':
            $accion = 'lista_fiestas';
            echo "<div class=\"login\"> <a href=\"index.php?accion=logout\"> logout {$_SESSION['usuario']} </a></div>";
    }

    if (!isset($accion)) {
        $accion = 'lista_fiestas'; //acción por defecto $default_action = "lista_fiestas"
    }
    if (!file_exists($accion . '.php')) { //comprobamos que el fichero exista
        $accion = 'lista_fiestas'; //si no existe mostramos la página por defecto
        //echo "Operación no soportada: Podíamos mostrar la página 404";
    }
}
include($accion . '.php'); //y ahora mostramos la pagina llamada
