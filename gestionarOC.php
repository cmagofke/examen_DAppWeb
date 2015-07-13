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
            <h2>Editar Orden de Compra</h2>
            <form method="post" action="">
                <p>Lista de orden de compra ingresados al sistema.  Presione en la acci&oacute;n que desea realizar.</p>
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td align="center">id</td>
                        <td>Fecha emisi&oacute;n</td>
                        <td>Total Orden de Compra</td>
                        <td>Estado</td>
                        <td>Usuario</td>
                        <td align="center">Acciones</td>
                    </tr>
                    <?php
                    $oOC = new Orden_compras();
                    $conteo = $oOC->leer();
                    while ($fila = $conteo->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td align='center'>$fila[id_oc]</td>";
                        echo "<td>$fila[fecha_emision]</td>";
                        echo "<td>$fila[total_oc]</td>";
                        echo "<td>$fila[estado]</td>";
                        echo "<td>$fila[id_usuario]</td>";
                        echo "<td width='1%' align='center' nowrap>";
                        echo "<a href='editarOC.php?id=$fila[id_oc]' class='btn btn-info left-margin' data-toggle='tooltip' data-placement='bottom' title='Editar Orden de Compra'> <span class='glyphicon glyphicon-pencil'> </span></a> ";
                        echo " <a elimina-id='$fila[id_oc]'  prod-eliminar='$fila[fecha_emision]'  class='btn btn-danger elimina-objecto' class='btn btn-info left-margin' data-toggle='tooltip' data-placement='bottom' title='Eliminar Orden de Compra'><span class='glyphicon glyphicon-trash'> </span></a>";
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
                    $.post('eliminarOC.php', {
                        id_oc: id
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