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
            <h2>Editar Usuario</h2>
            <form method="post" action="eliminarUsuario.php">
                <p>Lista de usuarios ingresados al sistema.  Presione en la acci&oacute;n que desea realizar.</p>
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td align="center">id</td>
                        <td>Usuario</td>
                        <td>Clave</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Correo</td>
                        <td>Edad</td>
                        <td>Perfil</td>
                        <td>Fecha Nacimiento</td>
                        <td align="center">Acciones</td>
                    </tr>
                    <?php
                    $oUsuario = new Usuarios();
                    $conteo = $oUsuario->leer();
                    dumpo($conteo->fetch(PDO::FETCH_ASSOC));
                    
                  while ($fila = $conteo->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td align='center'>$fila[idusuario]</td>";
                        echo "<td>$fila[login_usuario]</td>";
                        echo "<td><input type='password' readonly value='$fila[pass_usuario]'></td>";
                        echo "<td>$fila[nombre_usuario]</td>";
                        echo "<td>$fila[apellido_usuario]</td>";
                        echo "<td>$fila[correo_usuario]</td>";
                        echo "<td>$fila[edad_usuario]</td>";
                        echo "<td>$fila[id_perfil]</td>";
                        echo "<td>$fila[fechanacimiento_usuario]</td>";
                        echo "<td width='1%' align='center' nowrap>";
                        echo "<a href='editarUsuario.php?id=$fila[idusuario]' class='btn btn-info left-margin' data-toggle='tooltip' data-placement='bottom' title='Editar Usuario'> <span class='glyphicon glyphicon-pencil'> </span></a> ";
                        echo " <a elimina-id='$fila[idusuario]'  admin-eliminar='$fila[nombre_usuario] $fila[apellido_usuario]'  class='btn btn-danger elimina-objecto' class='btn btn-info left-margin' data-toggle='tooltip' data-placement='bottom' title='Eliminar Usuario'><span class='glyphicon glyphicon-trash'> </span></a>";
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
                var nombreEliminar = $(this).attr('admin-eliminar');
                var q = confirm('Esta seguro, de eliminar a: ' + nombreEliminar +' ?');
                if (q === true) {
                    $.post('eliminarUsuario.php', {
                        idusuario: id
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