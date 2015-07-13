<?php

class tipo_producto {

    private $sdescripcion_tipo;
    private $nid_tipoProducto;
    private $tabla = "tipo_producto";
  
    function __construct($snom, $ncod) {
        $this->sdescripcion_tipo = $snom;
        $this->nid_tipoProducto = $ncod;
    }

     function nombre() {
        return $this->sdescripcion_tipo;
    }
    
     function id_perfil() {
        return $this->nid_tipoProducto;
    }
    
    function leer() {
        $query = "SELECT id_tipoProducto, descripcion_tipo FROM
                    " . $this->tabla . " ORDER BY descripcion_tipo";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function buscaPorId() {
        $query = "SELECT descripcion_tipo FROM " . $this->tabla . " WHERE id_tipo = ? limit 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->nid_tipoProducto);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->sdescripcion_tipo = $fila['ndescripcion_tipo'];
    }
}
