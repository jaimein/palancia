<?php

if ($_POST) {
    include('conexion.php');
    $conexion = modelo::GetInstance();
    $id = urldecode($_POST['id']);
    $query = "DELETE FROM `fiesta` WHERE id = :id";
    if ($stmt = $conexion->prepare($query)) {
        echo "<div>registro evento preparado.</div>";
    } else {
        die('Imposible preparar el registro del evento.' . $conexion->error);
    }
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        echo "<div>Registro eliminado</div>";
        echo '<input type="button" class="boton-login" value="Atras" onclick="location.href=\'./\'">';
    } else {
        die('Imposible guardar el registrodel evento: ' . $conexion->error . 'Pongase en contacto con el administrador');
    }
} elseif ($_GET) {
    $fecha = urldecode($_GET['fecha']);
    $grupo = urldecode($_GET['grupo']);
    $poblacion = urldecode($_GET['poblacion']);
    $tipo = urldecode($_GET['tipo']);
    $id = urldecode($_GET['id']);

    $fecha = str_replace(" ","T",$fecha);
    echo "<form action='eliminar.php' method='post'>";
    echo '<input readonly type=hidden name=id value=' . $id . ' >';
    echo "<h1> Va a proceder a eliminar el siguiente registro</h1>";

    echo "<table>";
    echo "<tr>";
    echo "<th>Fecha</th>";
    echo "<th>Grupo</th>";
    echo "<th>Poblacion</th>";
    echo "<th>Tipo</th>";
    echo "</tr>";

    echo "<tr>";
    echo '<td><input readonly type=datetime name=fecha value=' . $fecha . ' ></td>';
    echo '<td><input readonly type=text name=grupo value=' . $grupo . ' ></td>';
    echo '<td><input readonly type=text name=poblacion value=' . $poblacion . ' ></td>';
    echo '<td><input readonly type=text name=tipo value=' . $tipo . ' ></td>';
    echo "</tr>";

    echo "</table>";
    echo '<div style="text-align:center">';
    echo '<input type="button" class="boton-login" value="Atras" onclick="location.href=\'./index.php\'">';
    echo '<input type="submit" name="save" value="Eliminar" />';
    echo '</div>';
} else {
    include('index.php');
}
