<h1>Listado de Fiestas</h1>
<?php
//include 'conexion.php';
// Elegir los datos que deseamos recuperar de la tabla
$query = "SELECT *  "
    . "FROM buena ";
if ($stmt = $conexion->prepare($query)) {
    if (!$stmt->execute()) {
        die('Error de ejecución de la consulta. ' . $conexion->error);
    }
    //echo $query;
    // recoger los datos
    $stmt->bind_result($fecha, $grupo, $poblacion, $tipo);
    //cabecera de los datos mostrados
    echo "<a href='index.php?accion=altas'>Alta Fiesta</a>";
    echo "<table>"; //start table
    //creating our table heading
    echo "<tr>";
    echo "<th>Fecha</th>";
    echo "<th>Grupo</th>";
    echo "<th>Poblacion</th>";
    echo "<th>Tipo</th>";
    echo "</tr>";
    //recorrido por el resultado de la consulta
    while ($stmt->fetch()) {
        echo "<tr>";
        echo '<td>' . $fecha . '</td>';
        echo '<td>' . $grupo . '</td>';
        echo '<td>' . $poblacion . '</td>';
        echo '<td>' . $tipo . '</td>';
        echo "</tr>\n";
    }
    // end table
    echo "</table>";
    $stmt->close();
} else {
    die('Imposible preparar la consulta. ' . $conexion->error);
}
?>