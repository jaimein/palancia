<h1>Alta Ordenador</h1>
<?php
// include conexión a la base de datos
include 'conexion.php';
?>
<?php
if ($_POST) {
    // include conexión a la base de datos
    include 'conexion.php';
    $postgrupo=$_POST['grupo'];
    $posttipo=$_POST['tipo'];
    $postfecha=$_POST['fecha'];
    $postpoblacion=$_POST['poblacion'];
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
        $congrupos = "SELECT id FROM `grupo` WHERE nombre = ".$postgrupo;
        echo 'ab ok';
        if ($stmtcongrupos = $conexion->prepare($congrupos)) {
            if (!$stmtcongrupos->execute()) {
                die('Error de ejecución de la consulta. ' . $conexion->error.'afsdgas');
            };
            $stmtqcongrupos->bind_result($conidgrupos);

            while ($stmtcongrupos->fetch()) {
                $postgrupo = $conidgrupos;
                $congruposrowasignado = mysql_fetch_array($congruposqueryasignado);
            }
            echo '<br>b ok'.$postgrupo.'<br>';};
    }
    echo 'paso 1 ok';
    //Añadir tipo si no existe
    if (!is_numeric($posttipo)) {
        echo 'tipo no numerico';
        $inserttipo = "INSERT INTO `palancia`.`tipo` (`id` ,`descripcion`)VALUES (NULL , ?);";
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
        $contipo = "SELECT id FROM `tipo` WHERE descripcion='?' ";
        if ($stmtcontipo = $conexion->prepare($contipo)) {
            if (!$stmtcontipo->execute()) {
                die('Error de ejecución de la consulta. ' . $conexion->error);
            };
            $stmtqcontipo->bind_result($conidtipo);

            while ($stmtcontipo->fetch()) {
                $posttipo = $conidtipo;
                $contiporowasignado = mysql_fetch_array($contipoqueryasignado);
            }
        };
    }
    echo 'paso2 ok';
    // insert query
    $queryevento = "INSERT INTO `palancia`.`fiesta` ( `id` , `fecha` , `grupo_id` , `tipo_id` , `poblacion_id` ) "
            . "VALUES (NULL , ?, ?, ?, ?);";
    //echo $query, "<br>";
    // prepare query for execution
    if ($stmtevento = $conexion->prepare($queryevento)) {
        echo "<div>registro evento preparado.</div>";
    } else {
        die('Imposible preparar el registro evento.' . $conexion->error);
    }
    // asociar los parámetros
    $stmtevento->bind_param('siii', $postfecha, $postgrupo, $posttipo, $postpoblacion);
    // Ejecutar la consulta
    if ($stmtevento->execute()) {
        echo "<div>Registro evento guardado.<br>Puede serguir añadiendo</div>";
    } else {
        die('Imposible guardar el registro evento : ' . $conexion->error . 'Pongase en contacto con el administrador');
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