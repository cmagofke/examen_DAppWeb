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
            <h2>Crear Producto</h2>
            <?php
            if ($_POST) {
                $oProd = new productos();
                $oProd->descripcion = $_POST['descripcion'];
                $oProd->precio = $_POST['precio'];
                $oProd->unidad = $_POST['unidad'];
                $oProd->id_tipoProducto = $_POST['id_tipoProducto'];
                if ($oProd->crear()) {
                    echo "<div class=\"alert alert-success alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "Producto Ingresado";
                    echo "</div>";
                } else {
                    echo "<div class=\"alert alert-danger alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "No ha sido posible ingresar el Producto";
                    echo "</div>";
                }
            }
            ?>
            <form enctype="multipart/form-data" action="crearProducto.php"  method="post" id="form_producto">
                <p>Ingrese informaci&oacute;n para un nuevo producto al sistema, todos los campos son obligatorios.</p>
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Descripci&oacute;n</td>
                        <td><input type="text" class='form-control required text' name="descripcion"></td>
                    </tr>
                     <tr>
                        <td>Precio</td>
                        <td><input type="number" class='form-control required number' name="precio"></td>
                    </tr>
                    <tr>
                        <td>Unidad</td>
                        <td><input type="number" class='form-control required number' name="unidad"></td>
                    </tr>
                    <tr>
                        <td>Tipo Producto</td>
                        <td>
                            <?php
                            $oTp = new tipo_producto();
                            $stmt = $oTP->leer();
                            echo '<select class="form-control" name="id_tipoProducto">';
                            echo '<option>Seleccione...</option>';
                            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                extract($fila);
                                echo "<option value='{$id_tipoProducto}'>{$descripcion_tipo}</option>";
                            }
                            echo'</select>';
                            ?>
                        </td>
                    </tr>
                </table>
                <input type="submit"  class="btn btn-default btn-primary" value="Crear">
            </form>
        </div>
        <script>
            /*validacion de campos del producto*/
            $('#form_producto').validate({
                messages: {
                    descripcion: "Ingrese la descripci&oacute;n",
                    precio: "Ingrese el precio del producto",
                    unidad: "Ingrese la cantidad del producto",
                    id_tipoProducto: "Seleccione el tipo de producto"}
            });
        </script>
    </body>
</html>

