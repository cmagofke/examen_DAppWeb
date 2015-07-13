<?php
include ("librerias.php");
if($_POST){
$oUsuario = new usuarios();
$oUsuario->idusuario = $_POST['idusuario'];
 if( $oUsuario->eliminar() ){
        return true;
    }else{
        return false;
    }
}
?>