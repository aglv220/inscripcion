<?php

require_once(__DIR__.'/../../config/config.php');
require_once($CNG->dirroot .'/include/controller/db.php');

class alumno extends DB{

    public function getAllParticipantes()
    {
        $query = $this->connect()->prepare('SELECT dni, nombres, apepat, apemat, correo, celular, c.largename ' .
                                            'FROM participantes AS p INNER JOIN cursos AS c ON p.curso = c.id');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllParticipantesMINSA()
    {
        $query = $this->connect()->prepare('SELECT id, nro_doc FROM tbl_alumno WHERE id_institucion = 1 AND ubigeo IS NULL');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProfesion()
    {
        $query = $this->connect()->prepare('SELECT id AS id_pro, descripcion AS profesion FROM tbl_profesion WHERE id <> ""');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCondicion()
    {
        $query = $this->connect()->prepare('SELECT id_cond, descripcion AS condicion FROM tbl_condicionlab WHERE id_cond <> ""');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function UpdateMINSA($id, $ubigeo)
    {
        $query = $this->connect()->prepare('UPDATE tbl_alumno set ubigeo = :ubigeo WHERE id = :id');
        $query->bindParam(":id", $id);
        $query->bindParam(":ubigeo", $ubigeo);
        $query->execute();

        return $query->fetchAll();
    }

    //MODIFICADO CON CÓDIGO MODULAR
    public function saveAlumnoByCurso($dni, $fecnac, $entidad, $pliego, $ipliego, $uejecutora, $iuejecutora, $establecimiento, $iestablecimiento, $region, $nombres, $apepat, $apemat, $apecas, $correo, $celular, $fecha, $curso, $ubigeo, $profesion, $reglab, $condlab, $icondlab, $ruc, $tipo, $file, $cod_modular, $pais){

        $conn = $this->connect();

        if ($nombres == '' || $apepat == '' || $correo == '' || $celular == '' || $curso == 0){
            return $result = array(
                "status" => 0,
                "mensaje"=> "Problemas al registrar la Información (0x0002)"
            );
        }
        
        $query = $conn->prepare('CALL registro_alumno(:dni, :fecnac, :nombres, :apepat, :apemat, :apecas, :correo, :celular, :fecha, :entidad, :region, :curso, :ipliego, :pliego, :iuejecutora, :uejecutora, :iestablecimiento, :establecimiento, :ubigeo, :profesion, :reglab, :icondlab, :condlab, :ruc, :tipo, :file, :cod_modular, :pais, @mensaje, @statu);');

        $query->bindParam(":dni", $dni);
        $query->bindParam(":fecnac", $fecnac);
        $query->bindParam(":nombres", $nombres);
        $query->bindParam(":apepat", $apepat);
        $query->bindParam(":apemat", $apemat);
        $query->bindParam(":apecas", $apecas);
        $query->bindParam(":correo", $correo);
        $query->bindParam(":celular", $celular);
        $query->bindParam(":entidad", $entidad);
        $query->bindParam(":region", $region);
        $query->bindParam(":fecha", $fecha);
        $query->bindParam(":curso", $curso);
        $query->bindParam(":ipliego", $ipliego);
        $query->bindParam(":pliego", $pliego);
        $query->bindParam(":iuejecutora", $iuejecutora);
        $query->bindParam(":uejecutora", $uejecutora);
        $query->bindParam(":iestablecimiento", $iestablecimiento);
        $query->bindParam(":establecimiento", $establecimiento);
        $query->bindParam(":ubigeo", $ubigeo);
        $query->bindParam(":profesion", $profesion);
        $query->bindParam(":reglab", $reglab);
        $query->bindParam(":condlab", $condlab);
        $query->bindParam(":icondlab", $icondlab);
        $query->bindParam(":ruc", $ruc);
        $query->bindParam(":tipo", $tipo);
        $query->bindParam(":file", $file);       
        //CODIGO MODULAR
        $query->bindParam(":cod_modular", $cod_modular);
        //IDPAIS
        $query->bindParam(":pais", $pais);

        try {
            $query->execute();
            $query->closeCursor();
            $r = $conn->query('SELECT @mensaje, @statu;')->fetch();

            return $result = array(
                "status" => $r['@statu'],
                "mensaje"=> $r['@mensaje']
            );
        } catch (Throwable $th) {
            return $result = array(
                "status" => 0,
                "mensaje" => "Problemas al guardar la Información (0x0003)"
            );
        }
    }
}
?>