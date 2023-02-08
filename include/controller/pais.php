<?php
require_once(__DIR__.'/../../config/config.php');
require_once($CNG->dirroot .'/include/controller/db.php');

class paises extends DB{
    public function getAllPaises()
    {
        $query = $this->connect()->prepare("SELECT id, nombre_pais AS pais FROM tbl_pais");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>