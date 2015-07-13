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
            <?php
            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: no viene ID.');
            $oUsuario = new Usuarios();
            $oUsuario->idusuario = $id;
            $oUsuario->buscarporId();

            if ($_POST) {
                $oUsuario->idusuario = $_POST['idusuario'];
                $oUsuario->login_usuario = $_POST['login_usuario'];
                $oUsuario->pass_usuario = $_POST['pass_usuario'];
                $oUsuario->nombre_usuario = $_POST['nombre_usuario'];
                $oUsuario->apellido_usuario = $_POST['apellido_usuario'];
                $oUsuario->correo_usuario = $_POST['correo_usuario'];
                $oUsuario->edad_usuario = $_POST['edad_usuario'];
                $oUsuario->id_perfil = $_POST['id_perfil'];
                $oUsuario->fechanacimiento_usuario = $_POST['fechanacimiento_usuario'];

                if ($oUsuario->modificar()) {
                    $oUsuario->buscarporId();
                    echo "<div class=\"alert alert-success alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "Usuario modificado";
                    echo "</div>";
                } else {
                    echo "<div class=\"alert alert-danger alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "No ha sido modificar el Usuario";
                    echo "</div>";
                }
            }
            ?>
            <form action="editarUsuario.php?id=<?php echo $id; ?>"  method="post" id="form_usuario">
                <input type="hidden"  name="idusuario" value="<?php echo $id; ?>">
                <table class='table table-hover table-responsive table-bordered'>
                        <td>Usuario</td>
                        <td><input type="text" class='form-control required text' name="login_usuario" value="<?php echo $oUsuario->usuario()?>"></td>
                    </tr>
                    <tr>
                        <td>Clave</td>
                        <td><input type="password" class='form-control required pass' name='pass_usuario' value="<?php echo $oUsuario->clave()?>"></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" class='form-control required text' name="nombre_usuario" value="<?php echo $oUsuario->nombre()?>"></td>
                    </tr>
                    <tr>
                        <td>Apellido</td>
                        <td><input type="text" class='form-control required text' name="apellido_usuario" value="<?php echo $oUsuario->apellido()?>"></td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td><input type="text" class='form-control required text' name="correo_usuario" value="<?php echo $oUsuario->email()?>"></td>
                    </tr>
                    <tr>
                        <td>Edad</td>
                        <td><input type="number" class='form-control required number' name="edad_usuario" value="<?php echo $oUsuario->edad()?>"></td>
                    </tr>
                    <tr>
                        <td>Perfil</td>
                        <td><select class='form-control required' name="id_perfil" selected='<?php echo $oUsuario->perfil()?>'>
                                <option> </option>
                                <option value="1">Administrador</option>
                                <option value="2">Consulta</option>
                                <option value="3">Vendedor</option>
                            </select></td>   
                    </tr>
                    <tr>
                        <td>Fecha Nacimiento</td>
                        <td><input type="date" class='form-control required date' name="fechanacimiento_usuario" value="<?php echo $oUsuario->fecha_nacimiento()?>"></td>
                    </tr>
                </table>
                <input type="submit"  class="btn btn-default btn-primary" value="Modificar">
            </form>
        </div>
        <script>
            /*validacion de campos del usuario*/
            $('#form_usuario').validate({
                messages: {
                    login_usuario: "Ingrese usuario",
                    pass_usuario: "Ingrese clave",
                    nombre_usuario: "Ingrese nombre",
                    apellido_usuario: "Ingrese apellido",
                    correo_usuario: "Ingrese correo",
                    edad_usuario: "Ingrese edad",
                    id_perfil: "Ingrese tipo de perfil",
                    fechanacimiento_usuario: "Ingrese fecha de nacimiento"}
            });
        </script>
    </body>
</html>

