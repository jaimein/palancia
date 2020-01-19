<div class="login"><a href="./admin/index.php">Login</a></div>
<div>
    <h1>Listado de Fiestas</h1>
    <?php

    include 'conexion.php';
    $conexion = modelo::GetInstance();
    $query = "SELECT *  "
        . "FROM buena ";
    if ($stmt = $conexion->prepare($query)) {
        if (!$stmt->execute()) {
            die('Error de ejecución de la consulta. ' . $conexion->error);
        }
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
            echo "</tr>\n";
        }
        // end table
        echo "</table>";
        $conexion = null;
    } else {
        die('Imposible preparar la consulta. ' . $conexion->error);
    }
    ?>
</div>