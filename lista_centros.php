<h1>Listado de Centros</h1>
<?php
//include 'conexion.php';
// Elegir los datos que deseamos recuperar de la tabla
$query = "SELECT id, nombre, dirrecion, telefono, poblacion  "
        . "FROM centro ";
if ($stmt = $conexion->prepare($query)) {
    if (!$stmt->execute()) {
        die('Error de ejecución de la consulta. ' . $conexion->error);
    }
    //echo $query;
    // recoger los datos
    $stmt->bind_result($id, $nombre, $dirrecion, $telefono, $poblacion);
    // enlace a alta de cliente
    echo "<div>";
    echo "<a href='index.php?accion=altas'>Alta ordenadores</a>";
    echo "<a href='index.php?incidencias.php'>Añadir incidencia</a>";
    echo "</div>";
    //cabecera de los datos mostrados
    echo "<table>"; //start table
    //creating our table heading
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>Nombre</th>";
    echo "<th>Dirreción</th>";
    echo "<th>telefono</th>";
    echo "<th>poblacion</th>";
    echo "</tr>";
    //recorrido por el resultado de la consulta
    while ($stmt->fetch()) {
        echo "<tr>";
        echo '<form method="get" action="index.php?accion=altas_especifico">';
        echo '<input type="hidden" name="accion" value="lista"/>';
        echo '<td><input type="text" name="idCentro" size="3" value="' . $id . '" readonly /></td>';
        echo '<td><input type="text" name="nombreCentro" value="' . $nombre . '" readonly /></td>';
        echo '<td><input type="text" name="dirrecion" value="' . $dirrecion . '" readonly /></td>';
        echo '<td><input type="text" name="telefono" value="' . $telefono . '" readonly /></td>';
        echo '<td><input type="text" name="poblacion" value="' . $poblacion . '" readonly /></td>';
        echo '<td>';
        // echo "<input type='submit' value='Añadir para este centro' onclick=this.form.action='index.php?accion=altas'>";
        echo '<input type="submit" value="Lista este centro">';
        echo '</form></td>';

        echo "</tr>\n";
    }
    // end table
    echo "</table>";
    $stmt->close();
} else {
    die('Imposible preparar la consulta. ' . $conexion->error);
}
?>