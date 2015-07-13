<?php
session_start();
include ("librerias.php");
?>
<!doctype html>
<html>
    <head>
        <meta charset="iso-8859-1">
        <title><?= TITULOAPP; ?></title>
    </head>
    <body>
        <?php include 'menu.php'; ?>
        <div class="container">
            <h1></h1>
            <h2>Editar Orden de compra</h2>
            <?php
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: no viene ID.');
            $oOC = new Orden_compras();
            $oOC->id_oc = $id;
            $oOC->buscarporId();

            if ($_POST) {
                $oOC->id_oc = $_POST['id_oc'];
                $oOC->fecha_emision = $_POST['fecha_emision'];
                $oOC->total_oc = $_POST['total_oc'];
                $oOC->estado = $_POST['estado'];
                $oOC->id_usuario = $_POST['id_usuario'];
                
                if ($oOC->modificar()) {
                    $oOC->buscarporId();
                    echo "<div class=\"alert alert-success alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "Orden de compra modificada";
                    echo "</div>";
                } else {
                    echo "<div class=\"alert alert-danger alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "No ha sido modificar la Orden de compra";
                    echo "</div>";
                }
            }
            ?>
            <form enctype="multipart/form-data" action="editarOC.php?id=<?php echo $id; ?>"  method="post" id="form_oc">
                <input type="hidden"  name="id_oc" value="<?php echo $id; ?>">
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Fecha Emisi&oacute;n</td>
                        <td><input type="date" class='form-control required date' name="fecha_emision" value="<?php echo $oOC->fecha_emision() ?>"></td>
                    </tr>
                    <tr>
                        <td>Total Orden de compra</td>
                        <td><input type="number" class='form-control required number' name='total_oc' value="<?php echo $oOC->total_oc() ?>"></td>
                    </tr>
                    <tr>
                        <td>Estado</td>
                        <td><input type="text" class='form-control required text' name="estado" value="<?php echo $oOC->estado() ?>"></td>
                    </tr>
                    <tr>
                        <td>Usuario</td>
                        <td><input type="text" class='form-control required text' name="cantidad" value="<?php echo $oOC->id_usuario() ?>"></td>
                    </tr>
                </table>
                <input type="submit"  class="btn btn-default btn-primary" value="Modificar">
            </form>
        </div>
        <script>
            /*validacion de campos de la orden de compra*/
            $('#form_oc').validate({
                messages: {
                    fecha_emision: "Ingrese una fecha de emisi&oacute;n",
                    total_oc: "Ingrese el total de la orden de compra",
                    estado: "Ingrese un estado (Emitida, Cerrada, Anulada)",
                    id_usuario: "Ingresa un id usuario"}
            });
        </script>
    </body>
</html>

