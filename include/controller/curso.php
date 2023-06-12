<?php
require_once(__DIR__.'/../../config/config.php');
require_once($CNG->dirroot .'/include/controller/db.php');

class cursos extends DB{
    
    public function getAllCursos()
    {
        //AND (curso_libre = 0 OR curso_libre IS NULL)
        /*$query = $this->connect()->prepare("SELECT id, CONCAT(nombre_largo, ' ', DATE_FORMAT(fecha_inicio_ins,'%d de %M'),' - ', DATE_FORMAT(fecha_fin_ins,'%d de %M')) AS curso, fecha_inicio_ins, fecha_fin_ins FROM tbl_curso WHERE date(now()) BETWEEN date(fecha_inicio_ins) AND date(fecha_fin_ins) AND estado = 1 AND (curso_tipo_inscripcion = 1 OR curso_tipo_inscripcion = 3);");
        $query->execute();*/
        $conn = $this->connect();
        $query = $conn->prepare('CALL sp_listado_cursos_disponibles();');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCursosX()
    {
        $query = $this->connect()->prepare("SELECT id, CONCAT(nombre_largo, ' ', DATE_FORMAT(fecha_inicio_ins,'%d de %M'),' - ', DATE_FORMAT(fecha_fin_ins,'%d de %M')) AS curso, fecha_inicio_ins, fecha_fin_ins FROM tbl_curso WHERE id IN (199,200,201);");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCursosLibreAcceso()
    {
        $query = $this->connect()->prepare("SELECT id FROM tbl_curso WHERE date(now()) BETWEEN date(fecha_inicio_ins) AND date(fecha_fin_ins) AND curso_libre = 1;"); //AND curso_tipo = 0
        $query->execute();
        return $query->fetchAll(PDO::FETCH_COLUMN);
    }

    /****** LISTADO DE CURSOS LIBRES******/
    public function getCursosLibres()
    {
        $query = $this->connect()->prepare("SELECT id, id_curso_moodle, nombre_corto, nombre_largo , DATE_FORMAT(fecha_inicio_curso,'%d de %M %Y') AS fec_ini_curso, DATE_FORMAT(fecha_fin_curso,'%d de %M %Y') AS fec_fin_curso, d_descrip, curso_info, curso_detalle, curso_tipo FROM tbl_curso WHERE date(now()) BETWEEN date(fecha_inicio_curso) AND date(fecha_fin_curso) AND curso_libre =1; ");

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    /****** END LISTA DE CURSOS LIBRES ******/

    public function getCursoSet($id)
    {
        $query = $this->connect()->prepare("SELECT id, r_archivo, r_privado, r_descrip, d_descrip, curso_tipo, curso_detalle, curso_libre FROM tbl_curso WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCursosOld()
    {
        $query = $this->connect()->prepare('SELECT id, nombre_largo AS curso, fecha_inicio_ins, fecha_fin_ins FROM tbl_curso WHERE date(now()) BETWEEN date(fecha_inicio_ins) AND date(fecha_fin_ins);');

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>