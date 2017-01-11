<h1>Alta Ordenador</h1>
<?php
// include conexión a la base de datos
include 'conexion.php';
?>
<?php
if ($_POST) {
    // include conexión a la base de datos
    include 'conexion.php';
    $postgrupo = $_POST['grupo'];
    $posttipo = $_POST['tipo'];
    $postfecha = $_POST['fecha'];
    $postpoblacion = $_POST['poblacion'];
    //Añadir grupo si no existe
    if (!is_numeric($postgrupo)) {
        $insertgrupo = "INSERT INTO `palancia`.`grupo` (`id` ,`nombre`)VALUES (NULL , ?);";
        if ($stmtinsertgrupo = $conexion->prepare($insertgrupo)) {
            echo "<div>registro grupo preparado.</div>";
        } else {
            die('Imposible preparar el registro del grupo.' . $conexion->error);
        }
        $stmtinsertgrupo->bind_param('s', $postgrupo);
        if ($stmtinsertgrupo->execute()) {
            echo "<div>Registro del grupo guardado.Puede serguir añadiendo</div>";
        } else {
            die('Imposible guardar el registrodel grupo: ' . $conexion->error . 'Pongase en contacto con el administrador');
        }
        echo 'a ok';
        $queryidgrupo = "SELECT `grupo`.`id` "
                . "FROM `grupo`  "
                . "WHERE `grupo`.`nombre` = ? ";
        if ($stmtidgrupo = $conexion->prepare($queryidgrupo)) {

            // inicializamos el parámetro
            $stmtidgrupo->bind_param('s', $postgrupo);

            // ejecutamos la consulta
            $stmtidgrupo->execute();
            $stmtidgrupo->bind_result($conidgrupo);
            // recuperamos la variable
            $stmtidgrupo->fetch();
            $postgrupo = $conidgrupo;
        } echo $conidgrupo . "gañkjgñkabvnjrsw" . $postgrupo;
    }
    echo 'paso 1 ok';
    //Añadir tipo si no existe
    if (!is_numeric($posttipo)) {
        echo 'tipo no numerico';
        $inserttipo = "INSERT INTO `palancia`.`tipo` (`id` ,`descripcion`) VALUES (NULL , ?);";
        if ($stmtinserttipo = $conexion->prepare($inserttipo)) {
            echo "<div>registro tipo preparado.</div>";
        } else {
            die('Imposible preparar el registro del tipo.' . $conexion->error);
        }
        $stmtinserttipo->bind_param('s', $posttipo);
        if ($stmtinserttipo->execute()) {
            echo "<div>Registro del tipo guardado.<br>Puede serguir añadiendo</div>";
        } else {
            die('Imposible guardar el registrodel tipo: ' . $conexion->error . 'Pongase en contacto con el administrador');
        }
        $queryidtipo = "SELECT `tipo`.`id` "
                . "FROM `tipo`  "
                . "WHERE `tipo`.`descripcion` = ? ";
        if ($stmtidtipo = $conexion->prepare($queryidtipo)) {

            // inicializamos el parámetro
            $stmtidtipo->bind_param('s', $posttipo);

            // ejecutamos la consulta
            $stmtidtipo->execute();
            $stmtidtipo->bind_result($conidtipo);
            // recuperamos la variable
            $stmtidtipo->fetch();
            $posttipo = $conidtipo;
        } echo $conidtipo . "gañkjgñkabvnjrsw" . $posttipo;
    }
    echo '<br>paso2 ok<br>';

    if (is_numeric($postgrupo) && is_numeric($posttipo) && is_numeric($postpoblacion)) {
        
    } else {
        die('Imposible preparar el registro del evento. Variables erroneas');
    }
}
?>
<form action='index.php?accion=altas' method='post'>
    <table border='0'>
        <tr>
            <td>fecha</td>
            <td><input type='datetime' name='fecha' min="<?php echo date("Y-m-d H:i:s"); ?>" value="<?php echo date("Y-m-d H:i:s"); ?>" required/></td>
        </tr>
        <tr>
            <td>grupo</td>
            <td>
                <!-- Campo de texto combinado con lista de opciones -->
                <input type="text" list="itemsgrupo" name="grupo" required>
                <!-- Lista de opciones -->
                <datalist id="itemsgrupo">
                    <?php
                    $querrygrupos = "SELECT id, nombre FROM `grupo` ";
                    if ($stmtquerrygrupos = $conexion->prepare($querrygrupos)) {
                        if (!$stmtquerrygrupos->execute()) {
                            die('Error de ejecución de la consulta. ' . $conexion->error);
                        };
                        $stmtquerrygrupos->bind_result($idgrupos, $nombregrupos);

                        while ($stmtquerrygrupos->fetch()) {
                            echo "<option value='" . $idgrupos . "'>" . $nombregrupos . "</option>";
                            $querrygruposrowasignado = mysql_fetch_array($querrygruposqueryasignado);
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
                    $querrytipo = "SELECT id, descripcion FROM `tipo` ";
                    if ($stmtquerrytipo = $conexion->prepare($querrytipo)) {
                        if (!$stmtquerrytipo->execute()) {
                            die('Error de ejecución de la consulta. ' . $conexion->error);
                        };
                        $stmtquerrytipo->bind_result($idtipo, $descripciontipo);

                        while ($stmtquerrytipo->fetch()) {
                            echo "<option value='" . $idtipo . "'>" . $descripciontipo . "</option>";
                            $querrytiporowasignado = mysql_fetch_array($querrytipoqueryasignado);
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
                    <option value='' selected='selected' >Poblacion</option>
                    <?php
                    $asignado = "SELECT id, poblacion FROM poblacion";
                    if ($stmtasignado = $conexion->prepare($asignado)) {
                        if (!$stmtasignado->execute()) {
                            die('Error de ejecución de la consulta. ' . $conexion->error);
                        };
                        $stmtasignado->bind_result($id, $descripcion);

                        while ($stmtasignado->fetch()) {
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