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
            <form method="post" action="">
                <p>Lista de productos ingresados al sistema.  Presione en la acci&oacute;n que desea realizar.</p>
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td align="center">Id</td>
                        <td>Descripci&oacute;n</td>
                        <td>Precio</td>
                        <td>Unidad</td>
                        <td>Tipo Producto</td>
                        <td align="center">Acciones</td>
                    </tr>
                    <?php
                    $oprod = new productos();
                    $conteo = $oprod->leer();
                    while ($fila = $conteo->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td align='center'>$fila[id_producto]</td>";
                        echo "<td>$fila[descripcion]</td>";
                        echo "<td>$fila[precio]</td>";
                        echo "<td>$fila[unidad]</td>";
                        echo "<td>$fila[id_tipoProducto]</td>";
                        echo "<td width='1%' align='center' nowrap>";
                        echo "<a href='editarProducto.php?id=$fila[id_producto]' class='btn btn-info left-margin' data-toggle='tooltip' data-placement='bottom' title='Editar Producto'> <span class='glyphicon glyphicon-pencil'> </span></a> ";
                        echo " <a elimina-id='$fila[id_producto]'  prod-eliminar='$fila[descripcion]'  class='btn btn-danger elimina-objecto' class='btn btn-info left-margin' data-toggle='tooltip' data-placement='bottom' title='Eliminar Producto'><span class='glyphicon glyphicon-trash'> </span></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <input type="button" class="btn btn-default btn-primary" value="Volver" onclick="history.back(-1)" />
            </form>
        </div>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });

            $(document).on('click', '.elimina-objecto', function () {
                var id = $(this).attr('elimina-id');
                var nombreEliminar = $(this).attr('prod-eliminar');
                var q = confirm('Esta seguro, de eliminar a: ' + nombreEliminar +' ?');
                if (q === true) {
                    $.post('eliminarProducto.php', {
                        id_producto: id
                    }, function (data) {
                        location.reload();
                    }).fail(function () {
                        alert('No se ha podido eliminar.');
                    });
                }
                return false;
            });
        </script>
    </body>
</html>