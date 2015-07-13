<?php

class Orden_compras{
    private $nid_oc;
    private $ffecha_emision;
    private $ntotal_oc;
    private $sestado;
    private $nid_usuario;
    private $tabla = "orden_compras";

    function __construct($nid = NULL, $ffecha = NULL, $ntotal = NULL, $sestado = NULL, $nidusuario = NULL){
        $this->nid_oc=$nid;
        $this->ffecha_emision=$ffecha;
        $this->ntotal_oc=$ntotal;
        $this->sestado=$sestado;
        $this->nid_usuario=$nidusuario;
    }
	
    function id() {
        return $this->nid_oc;
    }
    function fecha_emision() {
        return $this->ffecha_emision;
    }
    function total_oc() {
        return $this->ntotal_oc;
    }
    function estado() {
        return $this->sestado;
    }        
    function id_usuario() {
        return $this->nid_usuario;
    }
        
    function VerificaOrdenCompra(){
        $db=dbconnect();
        $sqlsel="select id_oc from orden_compras
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
        $query = "SELECT id_oc, fecha_emision, total_oc, estado, id_usuario FROM " . $this->tabla . " ORDER BY id_oc";
        $this->stmt = $db->prepare($query);
        $this->stmt->execute();
        return $this->stmt;
    }
        
    function buscarporId() {
        $db = dbconnect();
        $query = "SELECT id_oc, fecha_emision, total_oc, estado, id_usuario FROM " . $this->tabla . " WHERE id_oc = ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->id_oc);
        $this->stmt->execute();
        $fila = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $this->ffecha_emision = $fila['fecha_emision'];
        $this->ntotal_oc = $fila['total_oc'];
        $this->sestado = $fila['estado'];
        $this->nid_usuario = $fila['id_usuario'];
    }
        
    function crear() {
        $db = dbconnect();
        $query = " INSERT INTO " . $this->tabla . " SET fecha_emision = ?, total_oc=?, estado=?, id_usuario=?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->fecha_emision);
        $this->stmt->bindParam(2, $this->total_oc);
        $this->stmt->bindParam(3, $this->estado);
        $this->stmt->bindParam(4, $this->id_usuario);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
        
    function modificar() {
        $db = dbconnect();
        $query = " UPDATE " . $this->tabla . " SET fecha_emision= ?, total_oc= ?, estado= ?, id_usuario=?  WHERE id_oc= ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->fecha_emision);
        $this->stmt->bindParam(2, $this->total_oc);
        $this->stmt->bindParam(3, $this->estado);
        $this->stmt->bindParam(4, $this->id_usuario);
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
