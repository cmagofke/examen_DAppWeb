<?php
include ("librerias.php");
if($_POST){
$oProductos = new Productos();
$oProductos->id_producto = $_POST['id_producto'];
 if( $oProductos->eliminar() ){
        return true;
    }else{
        return false;
    }
}
?>
