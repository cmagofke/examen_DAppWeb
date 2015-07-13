<?php
session_start();

include ("librerias.php");
$usr = new Usuarios("", $_POST['input_usuario'], $_POST['input_clave'], "", "", "", "", "", "");
        
$usr->buscarUsuario();
if ($usr->VerificaAcceso()) {
echo' <script>
	document.location.href="inicio.php";
</script>';
    $_SESSION['logeado'] = true;
    $_SESSION['nombre_usuario'] = $usr->nombre();
    $_SESSION['apellido_usuario'] = $usr->apellido();
    $_SESSION['id_perfil'] = $usr->perfil();
    die();
} else {
    echo' <script>
	document.location.href="index.php?error=true";
</script>';
}



 
  