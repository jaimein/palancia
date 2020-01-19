<h1>Listado de Fiestas</h1>
<?php
//include 'conexion.php';
// Elegir los datos que deseamos recuperar de la tabla
$conexion = modelo::GetInstance();
$query = "SELECT *  "
    . "FROM buena ";
if ($stmt = $conexion->prepare($query)) {
    if (!$stmt->execute()) {
        die('Error de ejecución de la consulta. ' . $conexion->error);
    }

    echo "<a href='index.php?accion=altas'>Alta Fiesta</a>";
    echo "<table>"; 
    echo "<tr>";
    echo "<th>Fecha</th>";
    echo "<th>Grupo</th>";
    echo "<th>Poblacion</th>";
    echo "<th>Tipo</th>";
    echo "</tr>";
    
    foreach ($stmt as $row) {
        echo "<tr>";
        echo '<td>' . $row['fecha'] . '</td>';
        echo '<td>' . $row['grupo'] . '</td>';
        echo '<td>' . $row['poblacion'] . '</td>';
        echo '<td>' . $row['tipo'] . '</td>';
        //echo '<td colspan=0.5><img src=../img/basura.png height="25px"></img></td>';
        echo "</tr>";
    }
    // end table
    echo "</table>";

} else {
    die('Imposible preparar la consulta. ' . $conexion->error);
}
?>