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
            <h2>Editar Productos</h2>
            <?php
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: no viene ID.');
            $oProductos = new Productos();
            $oProductos->id_producto = $id;
            $oProductos->buscarporId();

            if ($_POST) {
                $oProductos->id_producto = $_POST['idproducto'];
                $oProd->descripcion = $_POST['descripcion'];
                $oProd->precio = $_POST['precio'];
                $oProd->unidad = $_POST['unidad'];
                $oProd->id_tipoProducto = $_POST['id_tipoProducto'];
                if ($oProductos->modificar()) {
                    $oProductos->buscarporId();
                    echo "<div class=\"alert alert-success alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "Producto modificado";
                    echo "</div>";
                } else {
                    echo "<div class=\"alert alert-danger alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "No ha sido modificar el Producto";
                    echo "</div>";
                }
            }
            ?>
            <form enctype="multipart/form-data" action="editarProductos.php?id=<?php echo $id; ?>"  method="post" id="form_producto">
                <input type="hidden"  name="idproductos" value="<?php echo $id; ?>">
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Descripci&oacute;n</td>
                        <td><input type="text" class='form-control required text' name='descripcion' value="<?php echo $oProductos->descripcion() ?>"></td>
                    </tr>
                    <tr>
                        <td>Precio</td>
                        <td><input type="number" class='form-control required number' name="precio" value="<?php echo $oProductos->precio() ?>"></td>
                    </tr>
                    <tr>
                        <td>Unidad</td>
                        <td><input type="number" class='form-control required number' name="cantidad" value="<?php echo $oProductos->unidad() ?>"></td>
                    </tr>
                    <tr>
                        <td>Tipo Producto</td>
                        <td><input type="text" class='form-control required text' name="id_tipoProducto" value="<?php echo  $oProductos->idTipoProducto()?>"></td>
                    </tr>
                </table>
                <input type="submit"  class="btn btn-default btn-primary" value="Modificar">
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

