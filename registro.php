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
        <div class="container">
            <h1></h1>
            <h2>Registro de Usuario</h2>

            <?php
            if ($_POST) {
                $oUser = new Usuarios();
                $oUser->login_usuario = $_POST['login_usuario'];
                $oUser->pass_usuario = md5($_POST['pass_usuario']);
                $oUser->nombre_usuario = $_POST['nombre_usuario'];
                $oUser->apellido_usuario = $_POST['apellido_usuario'];
                $oUser->correo_usuario = $_POST['correo_usuario'];
                $oUser->edad_usuario = $_POST['edad_usuario'];
                $oUser->id_perfil = $_POST['id_perfil'];
                $oUser->fechanacimiento_usuario = $_POST['fechanacimiento_usuario'];
                
                if ($oUser->crear()) {
                    echo "<div class=\"alert alert-success alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "Usuario Ingresado";
                    echo "</div>";
                } else {
                    echo "<div class=\"alert alert-danger alert-dismissable\">";
                    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                    echo "No ha sido posible ingresar el Usuario";
                    echo "</div>";
                }
            }
            ?>
            
            <form action="crearUsuario.php"  method="post" id="form_usuario">
                <p>Para el registro ingrese la siguiente informaci&oacute;n, todos los campos son obligatorios.</p>
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Usuario</td>
                        <td><input type="text" class='form-control required text' name="login_usuario"></td>
                    </tr>
                    <tr>
                        <td>Clave</td>
                        <td><input type="password" class='form-control required text' name='pass_usuario'></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" class='form-control required text' name="nombre_usuario"></td>
                    </tr>
                    <tr>
                        <td>Apellido</td>
                        <td><input type="text" class='form-control required text' name="apellido_usuario"></td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td><input type="text" class='form-control required text' name="correo_usuario"></td>
                    </tr>
                    <tr>
                        <td>Edad</td>
                        <td><input type="number" class='form-control required text' name="edad_usuario"></td>
                    </tr>
                    <tr>
                        <td>Perfil</td>
                        <td><select class='form-control required' name="id_perfil">
                                <option> </option>
                                <option value="2">Consulta</option>
                                <option value="3">Vendedor</option>
                            </select></td>   
                    </tr>
                    <tr>
                        <td>Fecha Nacimiento</td>
                        <td><input type="date" class='form-control required text' name="fechanacimiento_usuario"></td>
                    </tr>
                </table>
                <input type="submit"  class="btn btn-default btn-primary" value="Crear">
                <input type="button" class="btn btn-default btn-primary" value="Volver" onclick="history.back(-1)" />
            </form>
        </div>
        <script>
            /*validación de campos del usuario*/
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
