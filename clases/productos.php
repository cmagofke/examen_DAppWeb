<?php

class Productos{
    private $nid_producto;
    private $sdescripcion;
    private $nprecio;
    private $nunidad;
    private $nid_tipoProducto;
    private $tabla = "productos";

    function __construct($nid = NULL, $sdescrip = NULL, $npre = NULL, $nuni = NULL, $nidtipo = NULL){
        $this->nid_producto=$nid;
        $this->sdescripcion=$sdescrip;
        $this->nprecio=$npre;
        $this->nunidad=$nuni;
        $this->nid_tipoProducto=$nidtipo;
    }
	
    function id() {
        return $this->nid_producto;
    }
    function descripcion() {
        return $this->sdescripcion;
    }
    function precio() {
        return $this->nprecio;
    }
    function cantidad() {
        return $this->nunidad;
    }        
    function idTipoProducto() {
        return $this->nid_tipoProducto;
    }
        
    function VerificaProductos(){
        $db=dbconnect();
        $sqlsel="select descripcion from productos
        where id_producto=:nid";
        $querysel=$db->prepare($sqlsel);
        $querysel->bindParam(':nid',$this->nid_producto);
        $querysel->execute();

        if ($querysel->rowcount()==1){
            return true; 
        } else{
             return false;
        }
    }

  
    function leer() {
        $db = dbconnect();
        $query = "SELECT id_producto, descripcion, precio, cantidad, id_tipoProducto FROM " . $this->tabla . " ORDER BY id_producto";
        $this->stmt = $db->prepare($query);
        $this->stmt->execute();
        return $this->stmt;
    }
        
    function buscarporId() {
        $db = dbconnect();
        $query = "SELECT id_producto, descripcion, precio, unidad, id_tipoProducto FROM " . $this->tabla . " WHERE id_producto = ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->id_producto);
        $this->stmt->execute();
        $fila = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $this->sdescripcion = $fila['descripcion'];
        $this->nprecio = $fila['precio'];
        $this->nunidad = $fila['unidad'];
        $this->nid_tipoProducto = $fila['id_tipoProducto'];
    }
        
        
    function crear() {
        $db = dbconnect();
        $query = " INSERT INTO " . $this->tabla . " SET descripcion = ?, precio =?, unidad =?, id_tipoProducto =?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->descripcion);
        $this->stmt->bindParam(2, $this->precio);
        $this->stmt->bindParam(3, $this->unidad);
        $this->stmt->bindParam(4, $this->id_tipoProducto);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
        
    function modificar() {
        $db = dbconnect();
        $query = " UPDATE " . $this->tabla . " SET descripcion = ?, precio = ?, unidad = ?, id_tipoProducto=?  WHERE id_producto = ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->descripcion);
        $this->stmt->bindParam(2, $this->precio);
        $this->stmt->bindParam(3, $this->unidad);
        $this->stmt->bindParam(4, $this->id_tipoProducto);
        $this->stmt->bindParam(5, $this->id_producto);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
        
    function eliminar() {
        $db = dbconnect();
        $query = "DELETE FROM " . $this->tabla . " WHERE id_producto = ? ";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->id_producto);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }       
}



