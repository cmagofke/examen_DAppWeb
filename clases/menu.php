<?php
class Menu{
    private $snombre_menu;
    private $sdestino_menu;
    private $nid_perfil;
    private $tabla = 'menu';

    function __construct($snom, $sdest, $ncodp) {
        $this->snombre_menu = $snom;
        $this->sdestino_menu = $sdest;
        $this->nid_perfil = $ncodp;
    }
  
    function nombre_menu() {
        return $this->snombre_menu;
    }

    function destino_menu() {
        return $this->sdestino_menu;
    }

    function codigo_perfil() {
        return $this->nid_perfil;
    }

   function cargaMenuPorPerfil() {
       $db = dbconnect(); 
       $query = "SELECT  nombre_menu, destino_menu FROM " . $this->tabla . " WHERE id_perfil =:perfil";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':perfil', $this->nid_perfil);
        $stmt->execute();
       return $stmt;
    }

}
