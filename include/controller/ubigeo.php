<?php

require_once(__DIR__.'/../../config/config.php');
require_once($CNG->dirroot .'/include/controller/db.php');

class ubigeo extends DB{

    public function getUbigeoDet($ubigeo)
    {
        $query = $this->connect()->prepare('SELECT DISTINCT cod_dep, departamento, cod_prov, provincia, cod_dis, distrito FROM tbl_ubigeo WHERE ubigeo = :ubigeo');
        $query->bindParam(":ubigeo", $ubigeo);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDepartamento()
    {
        $query = $this->connect()->prepare('SELECT DISTINCT cod_dep, departamento FROM tbl_ubigeo');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProvinciaByDepartamento($cod_dep)
    {
        $query = $this->connect()->prepare('SELECT DISTINCT cod_prov, provincia FROM tbl_ubigeo WHERE cod_dep = :cod_dep');
        $query->bindParam(":cod_dep", $cod_dep);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDistritoByProvincia($cod_dep, $cod_prov)
    {
        $query = $this->connect()->prepare('SELECT cod_dis, distrito FROM tbl_ubigeo WHERE cod_dep = :cod_dep AND cod_prov = :cod_prov');
        $query->bindParam(":cod_dep", $cod_dep);
        $query->bindParam(":cod_prov", $cod_prov);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEstablecimientoByUbigeo($ubigeo)
    {
        $query = $this->connect()->prepare('SELECT "00225660" AS cod_renaes, "FARMACIA LOCAL/PRIVADA" AS establecimiento UNION SELECT cod_renaes, descripcion AS establecimiento FROM tbl_establecimiento WHERE ubigeo = :ubigeo');
        $query->bindParam(":ubigeo", $ubigeo);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>