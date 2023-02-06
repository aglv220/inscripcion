<?php
require_once(__DIR__.'/../../config/config.php');
require_once($CNG->dirroot .'/include/api/reniec/reniec_api.php');
require_once($CNG->dirroot .'/include/api/sunat/sunat_api.php');
require_once($CNG->dirroot .'/include/api/inforhus/inforhus_api.php');

class validaciones extends DB
{
    public function validar_documento($tipo, $documento, $fecha_nacimiento)
    {
        $query = $this->connect()->prepare('SELECT * FROM vw_alumno_sv WHERE nro_doc = :documento');
        $query->bindParam(":documento", $documento);
        $query->execute();

        if (!$query->rowCount())
        {
            $intentos = 1;
            while ($intentos <= 10) 
            {
                $r = new reniec_api();
                $data = $r->get_info_api($tipo, $documento);

                switch ($data->codRespuesta) {
                    case "0000":
                        if ($this->comparar_fechas($data->fecNacimiento, $fecha_nacimiento, $tipo))
                        {
                            $response = array(
                                "status" => 6,
                                "descripcion" => "Informacion Correcta",
                                "apepat" => $data->apePadre,
                                "apemat" => $data->apeMadre,
                                "apecas" => $tipo == "1" ? $data->apeCasada: "SIN DATOS",
                                "nombres" => $data->prenombres,
                                "fecnac" => $tipo == "1" ? $data->fecNacimiento : DateTime::createFromFormat('d/m/Y', $fecha_nacimiento)->format('Y-m-d'),
                                "ext" => false
                            );

                            $i = new inforhus_api();
                            $info = $i->get_info_api($documento);

                            if ($info->cargado != 0){
                                $response += ["entidad" => "MINSA"];
                                $response += ["id_entidad" => 1];
                                $response += ["ubigeo" => $info->registros[0]->id_ubigeo];

                                $response += ["cod_dep" => $info->registros[0]->id_departamento];
                                $response += ["departamento" => $info->registros[0]->departamento];

                                $response += ["cod_prov" => $info->registros[0]->id_provincia];
                                $response += ["provincia" => $info->registros[0]->provincia];

                                $response += ["cod_dis" => $info->registros[0]->id_distrito];
                                $response += ["distrito" => $info->registros[0]->distrito];

                                $response += ["c_uejecutora" => $info->registros[0]->codigo_unidad_ejecutora];
                                $response += ["uejecutora" => $info->registros[0]->unidad_ejecutora];

                                $response += ["c_pliego" => $info->registros[0]->id_pliego];
                                $response += ["pliego" => $info->registros[0]->pliego];
                                
                                $response += ["c_renaes" => $info->registros[0]->codigo_renaes];
                                $response += ["establecimiento" => $info->registros[0]->establecimiento];

                                $response += ["id_pro" => $info->registros[0]->id_profesion];
                                $response += ["profesion" => $info->registros[0]->profesion];

                                $response += ["id_reglab" => $info->registros[0]->id_regimen_laboral];
                                $response += ["reglab" => $info->registros[0]->regimen_laboral];

                                $response += ["id_condlab" => $info->registros[0]->id_condicion_laboral];
                                $response += ["condlab" => $info->registros[0]->condicion_laboral];

                            }else{
                                $response += ["entidad" => "EXTERNO"];
                                $response += ["id_entidad" => 5];
                                $response += ["ubigeo" => $data->codUbiDepartamentoDomicilio];
                            }
                            
                            return json_encode($response);
                            break 2;
                        }else{
                            $json = json_encode(array(
                                "status" => 5,
                                "descripcion" => "Numero de Documento o Fecha de nacimiento incorrectos."
                            ));
                            return $json;
                            break 2;
                        }
                        // return json_encode($response, JSON_FORCE_OBJECT);
                        // break 2;
                    
                    case "0001":
                        if ($data->codOrigen == '03') {
                            $json = json_encode(array(
                                "status" => 3,
                                "descripcion" => "La operación no se pudo completar debido a que el servicio de consulta de RENIEC no se encuentra disponible en este momento."
                            ), JSON_FORCE_OBJECT);
                        }else{
                            $json = json_encode(array(
                                "status" => 3,
                                "descripcion" => "Numero de Documento incorrecto o No Existe"
                            ), JSON_FORCE_OBJECT);
                        }
                        return $json;
                        break 2;
                    
                    case "9998":
                    case null:
                        if($intentos < 10){
                            $intentos++;
                            sleep(1);
                        }else{
                            $json = json_encode(array(
                                "status" => 4,
                                "descripcion" => "El servicio de consula de RENIEC no responde, por favor vuelva a intentarlo en unos minutos"
                            ), JSON_FORCE_OBJECT);
                            return $json;
                            break 2;
                        }break;
                    
                    // case null:
                    //     $json = json_encode(array(
                    //         "status" => 1,
                    //         "descripcion" => "Problemas con el servicio de RENIEC, comunicarse con  Soporte TI de ENSAP"
                    //     ), JSON_FORCE_OBJECT);
                    //     return $json;
                    //     break 2;

                    default:
                        $json = json_encode(array(
                            "status" => 1,
                            "descripcion" => $data->desRespuesta
                        ), JSON_FORCE_OBJECT);
                        return $json;
                        break 2;
                }
            }
        }
        else
        {
            $obj = $query->fetchAll(PDO::FETCH_OBJ);
            if ($this->comparar_fechas($obj[0]->fecnac, $fecha_nacimiento, $tipo)){
                $response = array(
                    "status" => 6,
                    "descripcion" => "Informacion Correcta",
                    "apepat" => $obj[0]->apepat,
                    "apemat" => $obj[0]->apemat,
                    "apecas" => $obj[0]->apecas,
                    "nombres" => $obj[0]->nombres,
                    "fecnac" => $obj[0]->fecnac,
                    // "correo" => $obj[0]->correo,
                    // "telefono" => $obj[0]->telefono,
                    // "cod_dep" => $obj[0]->cod_dep,
                    // "departamento" => $obj[0]->departamento,
                    // "cod_prov" => $obj[0]->cod_prov,
                    // "provincia" => $obj[0]->provincia,
                    // "cod_dis" => $obj[0]->cod_dis,
                    // "distrito" => $obj[0]->distrito,
                    // "c_uejecutora" => $obj[0]->id_uejecutora,
                    // "uejecutora" => $obj[0]->uejecutora,
                    // "c_pliego" => $obj[0]->id_pliego,
                    // "pliego" => $obj[0]->pliego,
                    // "c_renaes" => $obj[0]->cod_renaes,
                    // "establecimiento" => $obj[0]->establecimiento,
                    // "id_pro" => $obj[0]->id_pro,
                    // "profesion" => $obj[0]->profesion,
                    // "ubigeo" => $obj[0]->ubigeo,
                    "ext" => true
                );

                $i = new inforhus_api();
                $info = $i->get_info_api($documento);

                if ($info->cargado != 0){
                    $response += ["entidad" => "MINSA"];
                    $response += ["id_entidad" => 1];
                    $response += ["ubigeo" => $info->registros[0]->id_ubigeo];

                    $response += ["cod_dep" => $info->registros[0]->id_departamento];
                    $response += ["departamento" => $info->registros[0]->departamento];

                    $response += ["cod_prov" => $info->registros[0]->id_provincia];
                    $response += ["provincia" => $info->registros[0]->provincia];

                    $response += ["cod_dis" => $info->registros[0]->id_distrito];
                    $response += ["distrito" => $info->registros[0]->distrito];

                    $response += ["c_uejecutora" => $info->registros[0]->codigo_unidad_ejecutora];
                    $response += ["uejecutora" => $info->registros[0]->unidad_ejecutora];

                    $response += ["c_pliego" => $info->registros[0]->id_pliego];
                    $response += ["pliego" => $info->registros[0]->pliego];
                    
                    $response += ["c_renaes" => $info->registros[0]->codigo_renaes];
                    $response += ["establecimiento" => $info->registros[0]->establecimiento];

                    $response += ["id_pro" => $info->registros[0]->id_profesion];
                    $response += ["profesion" => $info->registros[0]->profesion];

                    $response += ["id_reglab" => $info->registros[0]->id_regimen_laboral];
                    $response += ["reglab" => $info->registros[0]->regimen_laboral];

                    $response += ["id_condlab" => $info->registros[0]->id_condicion_laboral];
                    $response += ["condlab" => $info->registros[0]->condicion_laboral];
                }else{
                    $response += ["cod_dep" => $obj[0]->cod_dep];
                    $response += ["departamento" => $obj[0]->departamento];
                    $response += ["cod_prov" => $obj[0]->cod_prov];
                    $response += ["provincia" => $obj[0]->provincia];
                    $response += ["cod_dis" => $obj[0]->cod_dis];
                    $response += ["distrito" => $obj[0]->distrito];
                    $response += ["c_uejecutora" => $obj[0]->id_uejecutora];
                    $response += ["uejecutora" => $obj[0]->uejecutora];
                    $response += ["c_pliego" => $obj[0]->id_pliego];
                    $response += ["pliego" => $obj[0]->pliego];
                    $response += ["c_renaes" => $obj[0]->cod_renaes];
                    $response += ["establecimiento" => $obj[0]->establecimiento];
                    $response += ["id_pro" => $obj[0]->id_pro];
                    $response += ["profesion" => $obj[0]->profesion];
                    $response += ["id_reglab" => $obj[0]->id_reglab];
                    $response += ["reglab" => $obj[0]->reglab];
                    $response += ["id_condlab" => $obj[0]->id_condlab];
                    $response += ["condlab" => $obj[0]->condlab];

                    $response += ["ubigeo" => $obj[0]->ubigeo];

                    if($obj[0]->institucion == 1){
                        $response += ["entidad" => "MINSA"];
                        $response += ["id_entidad" => $obj[0]->institucion];
                    }else{
                        $response += ["entidad" => "EXTERNO"];
                        $response += ["id_entidad" => $obj[0]->institucion];
                    }
                }
                return json_encode($response);
            }else{
                $json = json_encode(array(
                    "status" => 3,
                    "descripcion" => "Numero de Documento o fecha de nacimiento incorrectos."
                ));
                return $json;
            }
        }
    }

    public function validar_ruc($nroruc){
        $r = new sunat_api();
        $data = $r->get_info_api($nroruc);

        if ($data != null){
            if ($data->success){
                $json = json_encode(array(
                    "status" => 6,
                    "descripcion" => "Correcto",
                    "rsocial" => $data->data->name,
                    "direccion" => $data->data->address,
                    "departamento" => $data->data->region,
                    "provincia" => $data->data->province,
                    "distrito" => $data->data->district,
                    "ubigeo" => $data->data->location,
                    "estado" => $data->data->status
                ), JSON_FORCE_OBJECT);
                return $json;
            }else{
                $json = json_encode(array(
                    "status" => 3,
                    "descripcion" => "Número de RUC incorrecto o no está registrado."
                ), JSON_FORCE_OBJECT);
                return $json;
            }
        }else{
            $json = json_encode(array(
                "status" => 4,
                "descripcion" => "La operación no se pudo completar debido a que el servicio de consulta de SUNAT no se encuentra disponible en este momento."
            ), JSON_FORCE_OBJECT);
            return $json;
        }
    }

    public function comparar_fechas($fecNacimiento, $fecha_nacimiento, $tipo)
    {
        if ($tipo == "2"){
            return true;
        }else{
            $fecNacimiento = date("Y-m-d", strtotime($fecNacimiento));
            $fecha_nacimiento = DateTime::createFromFormat('d/m/Y', $fecha_nacimiento)->format('Y-m-d');
            
            if ($fecha_nacimiento == $fecNacimiento){
                return true;
            }
            else {
                return false;
            }
        }
    }
}


//echo strtotime("22/2/1989");
//echo date("Y-m-d", strtotime("22/02/1989"));
// $v = new validaciones();
// var_dump($v->validar_documento("1", "72476996", "01/08/1993"));
