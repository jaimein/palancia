<h1>Alta Ordenador</h1>
<?php
// include conexión a la base de datos
include 'conexion.php';
?>
<?php
if ($_POST) {
    // include conexión a la base de datos
    include 'conexion.php';
    // insert query
    $query = "INSERT INTO `vdc-ordenadores`.`ordenadores` (`id`, `id_ordenador`, `centro_id`, `aula`, `departamento`, `so_id`, `baja`) "
            . " VALUES (NULL, ?, ?, ?, ?, ?, '0')";
    //echo $query, "<br>";
    // prepare query for execution
    if ($stmt = $conexion->prepare($query)) {
        echo "<div>registro preparado.</div>";
    } else {
        die('Imposible preparar el registro.' . $conexion->error);
    }
    // asociar los parámetros
    $stmt->bind_param('iissi', $_POST['id_ordenador'], $_POST['centro'], $_POST['aula'], $_POST['departamento'], $_POST['so']);
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<div>Registro guardado.<br>Puede serguir añadiendo</div>";
    } else {
        die('Imposible guardar el registro: ' . $conexion->error .'Pongase en contacto con el administrador');
    }
}
?>
<form action='index.php?accion=altas' method='post'>
    <table border='0'>
        <tr>
            <td>id</td>
            <td><input type='number' name='id_ordenador' required/></td>
        </tr>
        <tr>
            <td>centro</td>
            <td>
                <select name='centro' required>
                    <option value='' selected='selected' >- Sin Centro -</option>
                    <?php
                    $centroasignado = "SELECT id, nombre FROM centro";
                    echo $centroasignado;
                    if ($stmt = $conexion->prepare($centroasignado)) {
                        if (!$stmt->execute()) {
                            die('Error de ejecución de la consulta. ' . $conexion->error);
                        };
                        $stmt->bind_result($id, $nombre);

                        while ($stmt->fetch()) {
                            echo "<option value='" . $id . "'>" . $nombre . "</option>";
                            $centrorowasignado = mysql_fetch_array($centroqueryasignado);
                        }
                    };
                    ?>                
                </select>

            </td>
        </tr>

        <tr>
            <td>aula</td>
            <td><input type='text' name='aula' /></td>
        </tr>
        <tr>
            <td>departamento/lugar</td>
            <td><input type='text' name='departamento' /></td>
        </tr>
        <tr>
            <td>so</td>
            <td>
                <select name='so' required>
                    <option value='' selected='selected' >- Sin SO -</option>
                    <?php
                    $asignado = "SELECT id, descripcion FROM so";
                    echo $asignado;
                    if ($stmt = $conexion->prepare($asignado)) {
                        if (!$stmt->execute()) {
                            die('Error de ejecución de la consulta. ' . $conexion->error);
                        };
                        $stmt->bind_result($id, $descripcion);

                        while ($stmt->fetch()) {
                            echo "<option value='" . $id . "'>" . $descripcion . "</option>";
                            $rowasignado = mysql_fetch_array($queryasignado);
                        }
                    };
                    ?>
                </select>

            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input type="submit" name="save" value="Save"/>
                <a href="./index.php">Volver al inicio</a>
            </td>
        </tr>
    </table>
</form> 