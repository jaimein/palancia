<h1>Alta Ordenador</h1>
<?php
// include conexión a la base de datos
//include 'conexion.php';
?>
<?php
if ($_POST) {
    // include conexión a la base de datos
    $conexion = modelo::GetInstance();
    $postgrupo = $_POST['grupo'];
    $posttipo = $_POST['tipo'];
    $postfecha = $_POST['fecha'];
    $postpoblacion = $_POST['poblacion'];

    //Añadir grupo si no existe
    if (!is_numeric($postgrupo)) {
        $insertgrupo = "INSERT INTO `palancia`.`grupo` (`id` ,`nombre`)VALUES (NULL , ?);";
        if ($stmt = $conexion->prepare($insertgrupo)) {
            echo "<div>registro grupo preparado.</div>";
        } else {
            die('Imposible preparar el registro del grupo.' . $conexion->error);
        }
        $stmt->bindParam(1, $postgrupo);
        if ($stmt->execute()) {
            echo "<div>Registro del grupo guardado.Puede serguir añadiendo</div>";
        } else {
            die('Imposible guardar el registrodel grupo: ' . $conexion->error . 'Pongase en contacto con el administrador');
        }
        echo 'grupo insertado ok';
        $queryidgrupo = "SELECT id "
            . "FROM grupo  "
            . "WHERE nombre = ? ";
        if ($stmt = $conexion->prepare($queryidgrupo)) {

            // inicializamos el parámetro
            $stmt->bindParam(1, $postgrupo);
            // ejecutamos la consulta
            $stmtidgrupo->execute();
            foreach ($stmt as $row) {
                $postgrupo = $row['id'];
            }
        }
    }

    //Añadir tipo si no existe
    if (!is_numeric($posttipo)) {
        echo 'tipo no numerico';
        $inserttipo = "INSERT INTO `palancia`.`tipo` (`id` ,`descripcion`) VALUES (NULL , ?);";
        if ($stmt = $conexion->prepare($inserttipo)) {
            echo "<div>registro tipo preparado.</div>";
        } else {
            die('Imposible preparar el registro del tipo.' . $conexion->error);
        }
        $stmt->bindParam(1, $posttipo);
        if ($stmtinserttipo->execute()) {
            echo "<div>Registro del tipo guardado.<br>Puede serguir añadiendo</div>";
        } else {
            die('Imposible guardar el registrodel tipo: ' . $conexion->error . 'Pongase en contacto con el administrador');
        }
        $queryidtipo = "SELECT id "
            . "FROM tipo  "
            . "WHERE descripcion = ? ";
        if ($stmt = $conexion->prepare($queryidtipo)) {

            // inicializamos el parámetro
            $stmt->bindParam(1, $postgrupo);

            // ejecutamos la consulta
            $stmt->execute();
            foreach ($stmt as $row) {
                $posttipo = $row['id'];
            }
        }
    }




    if (is_numeric($postgrupo) && is_numeric($posttipo) && is_numeric($postpoblacion)) {
        $querryevento = "INSERT INTO `palancia`.`fiesta` (`id` ,`fecha` ,`grupo_id` ,`tipo_id` ,`poblacion_id`) VALUES (NULL , ?, ?, ?, ?);";
        if ($stmt = $conexion->prepare($querryevento)) {
            echo "<div>registro evento preparado.</div>";
        } else {
            die('Imposible preparar el registro del evento.' . $conexion->error);
        }
        $stmt->bindParam(1, $postfecha);
        $stmt->bindParam(2, $postgrupo);
        $stmt->bindParam(3, $posttipo);
        $stmt->bindParam(4, $postpoblacion);
        if ($stmt->execute()) {
            echo "<div>Registro del evento guardado.<br>Puede serguir añadiendo</div>";
        } else {
            die('Imposible guardar el registrodel evento: ' . $conexion->error . 'Pongase en contacto con el administrador');
        }
    } else {
        die('Imposible preparar el registro del evento. Variables erroneas');
    }
}
?>
<form action='index.php?accion=altas' method='post'>
    <table border='0'>
        <tr>
            <td>fecha</td>
            <td><input type='datetime' name='fecha' min="<?php echo date("Y-m-d H:i:s"); ?>" value="<?php echo date("Y-m-d H:i:s"); ?>" required /></td>
        </tr>
        <tr>
            <td>grupo</td>
            <td>
                <!-- Campo de texto combinado con lista de opciones -->
                <input type="text" list="itemsgrupo" name="grupo" required>
                <!-- Lista de opciones -->
                <datalist id="itemsgrupo">
                    <?php
                    $conexion = modelo::GetInstance();
                    $querrygrupos = "SELECT id, nombre FROM `grupo` ";
                    if ($stmt = $conexion->prepare($querrygrupos)) {
                        if (!$stmt->execute()) {
                            die('Error de ejecución de la consulta. ' . $conexion->error);
                        };
                        foreach ($stmt as $row) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                        }
                    };
                    ?>
                </datalist>
            </td>
        </tr>

        <tr>
            <td>tipo</td>
            <td>
                <!-- Campo de texto combinado con lista de opciones -->
                <input type="text" list="itemstipo" name="tipo" required>
                <!-- Lista de opciones -->
                <datalist id="itemstipo">
                    <?php
                    $conexion = modelo::GetInstance();
                    $querrytipo = "SELECT id, descripcion FROM `tipo` ";
                    if ($stmt = $conexion->prepare($querrytipo)) {
                        if (!$stmt->execute()) {
                            die('Error de ejecución de la consulta. ' . $conexion->error);
                        };
                        foreach ($stmt as $row) {
                            echo "<option value='" . $row['id'] . "'>" . $row['descripcion'] . "</option>";
                        }
                    };
                    ?>
                </datalist>
            </td>
        </tr>
        <tr>
            <td>poblacion</td>
            <td>
                <select name='poblacion' required>
                    <option value='' selected='selected'>Poblacion</option>
                    <?php
                    $conexion = modelo::GetInstance();
                    $asignado = "SELECT id, poblacion FROM poblacion";
                    if ($stmt = $conexion->prepare($asignado)) {
                        if (!$stmt->execute()) {
                            die('Error de ejecución de la consulta. ' . $conexion->error);
                        };
                        foreach ($stmt as $row) {
                            echo "<option value='" . $row['id'] . "'>" . $row['poblacion'] . "</option>";
                        }
                    };
                    ?>
                </select>

            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input type="submit" name="save" value="Save" />
                <a href="./index.php">Volver al inicio</a>
            </td>
        </tr>
    </table>
</form>