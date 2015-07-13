<?php
include ("librerias.php");
if($_POST){
$oOC = new Orden_compras();
$oOC->id_oc = $_POST['id_oc'];
 if( $oOC->eliminar() ){
        return true;
    }else{
        return false;
    }
}
?>