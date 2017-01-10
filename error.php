<?php
$error = isset($_GET['error']) ? filter_input(INPUT_GET, 'error', $filter = FILTER_SANITIZE_STRING) : $error;
 
if (! $error) {
    $error = 'Error desconocido.';
}
    echo "Error: ",$error;

?>


