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
            <h2>Ingreso de Orden de Compra</h2>

            <?php
            if ($_POST) {
                $oOC = new Orden_compras();
                $oOC->fecha_emision = $_POST['login_usuario'];
                $oOC->total_oc = $_POST['total_oc'];
                $oOC->estado = $_POST['nombre_usuario'];
                $oOC->id_usuario = $_POST['id_usuario'];
         
                if ($oOC->crear()) {
                    echo "<div class=\"alert alert-success alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "Orden de compra Ingresada";
                    echo "</div>";
                } else {
                    echo "<div class=\"alert alert-danger alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "No ha sido posible ingresar la orden de compra";
                    echo "</div>";
                }
            }
            ?>
            <form enctype="multipart/form-data" action="crearOC.php"  method="post" id="form_oc">
                <p>Ingrese informaci&oacute;n para la creaci&oacute;n de una Orden de Compra.</p>
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Fecha emisi&oacute;n</td>
                        <td><input type="date" class='form-control required date' name="fecha_emision"></td>
                    </tr>
                    <tr>
                        <td>Total Orden de Compra</td>
                        <td><input type="number" class='form-control required number' name='total_oc'></td>
                    </tr>
                    <tr>
                        <td>Estado</td>
                        <td><input type="text" class='form-control required text' name="estado"></td>
                    </tr>
                    <tr>
                        <td>Usuario</td>
                        <td><input type="text" class='form-control required text' name="id_usuario"></td>
                    </tr>
                </table>
                <input type="submit"  class="btn btn-default btn-primary" value="Crear">
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

