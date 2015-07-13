<?php
class Usuarios {

    private $nidusuario;
    private $slogin_usuario;
    private $spass_usuario;
    private $snombre_usuario;
    private $sapellido_usuario;
    private $scorreo_usuario;
    private $nedad_usuario;
    private $nid_perfil;
    private $ffechanacimiento_usuario;
    private $tabla = "usuarios";

    function __construct($nidu = NULL, $susr = NULL, $spass = NULL, $snom = NULL, $sape = NULL, $scorreo = NULL, $ned = NULL, $nper = NULL, $fnacim = NULL) {
        $this->nidusuario = $nidu;
        $this->slogin_usuario = $susr;
        $this->spass_usuario = md5($spass);
        $this->snombre_usuario = $snom;
        $this->sapellido_usuario = $sape;
        $this->scorreo_usuario = $scorreo;
        $this->nedad_usuario = $ned;
        $this->nid_perfil = $nper;
        $this->ffechanacimiento_usuario = $fnacim;
    }

    function id() {
        return $this->nidusuario;
    }

    function nombre() {
        return $this->snombre_usuario;
    }

    function apellido() {
        return $this->sapellido_usuario;
    }

    function email() {
        return $this->scorreo_usuario;
    }

    function usuario() {
        return $this->slogin_usuario;
    }

    function clave() {
        return $this->spass_usuario;
    }

    function perfil() {
        return $this->nid_perfil;
    }

    function edad() {
        return $this->sedad;
    }

    function fecha_nacimiento() {
        return $this->ffechanacimiento_usuario;
    }

    function verificaAdministrador() {
        $db = dbconnect();
        $query = 'select nombre_usuario from ' . $this->tabla . ' where login_usuario:=usr and id_perfil = 1';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':usr', $this->slogin_usuario);
        $stmt->execute();
        if ($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function VerificaAcceso() {
        $db = dbconnect();
        $query = 'select nombre_usuario from ' . $this->tabla . ' where login_usuario=:usr and pass_usuario=:pwd';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':usr', $this->slogin_usuario);
        $stmt->bindParam(':pwd', $this->spass_usuario);
        $stmt->execute();
        if ($stmt->rowcount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function buscarUsuario() {
        $db = dbconnect();
        $query = 'SELECT nombre_usuario, apellido_usuario, id_perfil FROM ' . $this->tabla . ' where login_usuario=:usr and pass_usuario=:pwd';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':usr', $this->slogin_usuario);
        $stmt->bindParam(':pwd', $this->spass_usuario);
        $stmt->execute();
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->snombre_usuario = $fila['nombre_usuario'];
        $this->sapellido_usuario = $fila['apellido_usuario'];
        $this->nid_perfil = $fila['id_perfil'];
    }

    function buscarporId() {
        $db = dbconnect();
        $query = "SELECT login_usuario, pass_usuario, nombre_usuario, apellido_usuario, correo_usuario, edad_usuario, id_perfil, fechanacimiento_usuario FROM " . $this->tabla . " WHERE idusuario= ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->idadministrador);
        $this->stmt->execute();
        $fila = $this->stmt->fetch(PDO::FETCH_ASSOC);
        $this->slogin_usuario = $fila['login_usuario'];
        $this->spass_usuario = $fila['pass_usuario'];
        $this->snombre_usuario = $fila['nombre_usuario'];
        $this->sapellido_usuario = $fila['apellido_usuario'];
        $this->scorreo_usuario = $fila['correo_usuario'];
        $this->nedad_usuario = $fila['edad_usuario'];
        $this->nid_perfil = $fila['id_perfil'];
        $this->ffechanacimiento_usuario = $fila['fechanacimiento_usuario'];
    }

    function leer() {
        $db = dbconnect();
        $query = "SELECT idusuario, login_usuario, pass_usuario, nombre_usuario, apellido_usuario, correo_usuario, edad_usuario, id_perfil, fechanacimiento_usuario FROM " . $this->tabla;
        $this->stmt = $db->prepare($query);
        $this->stmt->execute();
        return $this->stmt;
    }

    function crear() {
        $db = dbconnect();
        $query = " INSERT INTO " . $this->tabla . " SET login_usuario =?, pass_usuario = ?, nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, edad_usuario=?, id_perfil =?, fechanacimiento_usuario=?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->login_usuario);
        $this->stmt->bindParam(2, $this->pass_usuario);
        $this->stmt->bindParam(3, $this->nombre_usuario);
        $this->stmt->bindParam(4, $this->apellido_usuario);
        $this->stmt->bindParam(5, $this->correo_usuario);
        $this->stmt->bindParam(6, $this->edad_usuario);
        $this->stmt->bindParam(7, $this->id_perfil);
        $this->stmt->bindParam(8, $this->fechanacimiento_usuario);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function eliminar() {
        $db = dbconnect();
        $query = "DELETE FROM " . $this->tabla . " WHERE idusuario = ? ";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->idusuario);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function modificar() {
        $db = dbconnect();
        $query = " UPDATE " . $this->tabla . " SET login_usuario =?, pass_usuario =?, nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, edad_usuario=?, id_perfil =?, fechanacimiento_usuario =? WHERE idusuario = ?";
        $this->stmt = $db->prepare($query);
        $this->stmt->bindParam(1, $this->login_usuario);
        $this->stmt->bindParam(2, $this->pass_usuario);
        $this->stmt->bindParam(3, $this->nombre_usuario);
        $this->stmt->bindParam(4, $this->apellido_usuario);
        $this->stmt->bindParam(5, $this->correo_usuario);
        $this->stmt->bindParam(6, $this->edad_usuario);
        $this->stmt->bindParam(7, $this->id_perfil);
        $this->stmt->bindParam(8, $this->fechanacimiento_usuario);
        $this->stmt->bindParam(9, $this->idusuario);
        if ($this->stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
