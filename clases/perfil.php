<?php

class perfil {

    private $sdescripcion_perfil;
    private $nid_perfil;
    private $tabla = "perfil";
  
    function __construct($snom, $ncod) {
        $this->sdescripcion_perfil = $snom;
        $this->nid_perfil = $ncod;
    }

     function nombre() {
        return $this->sdescripcion_perfil;
    }
    
     function id_perfil() {
        return $this->nid_perfil;
    }
    
    function leer() {
        $query = "SELECT id_perfil, descripcion_perfil FROM
                    " . $this->tabla . " ORDER BY descripcion_perfil";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function buscaPorId() {
        $query = "SELECT descripcion_perfil FROM " . $this->tabla . " WHERE id_perfil = ? limit 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->nid_perfil);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->sdescripcion_perfil = $fila['ndescripcion_perfil'];
    }
}
