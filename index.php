<?php
session_start(); 
include ("librerias.php");
?>

<!doctype html>
<html>
    <head>
        <meta charset="iso-8859-1">
        <title>Lo Tenemos Todo</title>
        <?php
            $error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_SPECIAL_CHARS);
        ?>
    </head>
    <body>
        <div class="container">
            <div class="row"  style="max-width: 330px; padding: 10px;  margin: 80 auto;">
                <img src="images/image_u27.png" alt="LoTenemosTodo"/>
                <form method="post" action="login.php" id="form_login">
                    <?php
                    if ($error) {
                        echo "<div class=\"alert alert-danger alert-dismissable\">";
                        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                        echo "Usuario no encontrado";
                        echo "</div>";
                    }
                    ?>
                    <div class="form-group">
                        <input type="text" name='input_usuario' id='input_usuario' class="form-control text required" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <input type="password" name='input_clave' id='input_clave' class="form-control text required" placeholder="Clave">
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
                    <a href="registro.php">Registrar usuario</a>
                </form>
            </div>
        </div>
        <script>
            /*validacion de campos del login*/
            $('#form_login').validate({
                messages: {
                    input_usuario: "Ingrese su Usuario",
                    input_clave: "Ingrese su Clave"}
            });
        </script>
    </body>
</html>
