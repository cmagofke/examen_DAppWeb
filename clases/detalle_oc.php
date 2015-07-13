<?php

class Detalle_oc{
    private $nid_oc;
    private $nid_producto;
    private $ncantidad;
    private $nsub_total;
    private $tabla = "detalle_oc";

    function __construct($nid = NULL, $nid_prod = NULL, $ncant = NULL, $nsub = NULL){
        $this->nid_oc=$nid;
        $this->nid_producto=$nid_prod;
        $this->ncantidad=$ncant;
        $this->nsub_total=$nsub;
    }
	
    function id() {
        return $this->nid_oc;
    }
    function id_producto() {
        return $this->nid_producto;
    }
    function cantidad() {
        return $this->ncantidad;
    }
    function sub_total() {
        return $this->nsub_total;
    }
    function VerificaDetalleOC(){
        $db=dbconnect();
        $sqlsel="select id_oc from detalle_oc
        where id_oc=:nid";
        $querysel=$db->prepare($sqlsel);
        $querysel->bindParam(':nid',$this->nid_oc);
        $querysel->execute();

        if ($querysel->rowcount()==1){
            return true; 
        } else{
             return false;
        }
    }

    function leer() {
        $db = dbconnect();
        $query = "SELECT id_oc, id_producto, cantidad, sub_total FROM " . $this->tabla . " ORDER BY id_oc";
        $this->stmt = $db->prepare($query);
        $this->stmt->execute();
        return $this->stmt;
    }
        
    function buscarporId() {
        $db = dbconnect();
        $query = "SELECT id_oc, id_producto, cantidad, sub_total FROM " . $this->tabla . " WHERE id_oc = ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->id_oc);
        $this->stmt->execute();
        $fila = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $this->nid_producto = $fila['id_producto'];
        $this->ncantidad = $fila['cantidad'];
        $this->nsub = $fila['sub_total'];
        $this->nid_usuario = $fila['id_usuario'];
    }
        
    function crear() {
        $db = dbconnect();
        $query = " INSERT INTO " . $this->tabla . " SET id_producto = ?, cantidad=?, sub_total=?, id_oc=?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->id_producto);
        $this->stmt->bindParam(2, $this->cantidad);
        $this->stmt->bindParam(3, $this->sub_total);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
        
    function modificar() {
        $db = dbconnect();
        $query = " UPDATE " . $this->tabla . " SET id_producto= ?, cantidad= ?, sub_total= ? WHERE id_oc= ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->id_producto);
        $this->stmt->bindParam(2, $this->cantidad);
        $this->stmt->bindParam(3, $this->sub_total);
        $this->stmt->bindParam(5, $this->id_oc);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
        
    function eliminar() {
        $db = dbconnect();
        $query = "DELETE FROM " . $this->tabla . " WHERE id_oc= ? ";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->id_oc);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }       
}
