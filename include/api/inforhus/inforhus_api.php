<?php
require_once(__DIR__.'/../../../config/config.php');
require_once($CNG->dirroot .'/include/controller/db.php');

class inforhus_api extends DB
{
    public function get_info_api($numdoc)
    {
        $persona = array(
            'recursos' => array(
                "id1" => 1,
                "usuario_acceso" => "9000005", 
                "descripcion_usuario" => "app_ensap",
                "clave_acceso" => "2546uieroptyiyaiusdfis32324hgisdii30930ophpr9ph5349090u3450u",
                "numero_documento" => $numdoc  
            )
        );
        
        $recursos = json_encode($persona);
        //var_dump($recursos);
        
        $odata = http_build_query(
            array(
                'data' => $recursos
            )
        );
        //var_dump($odata);
        
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded; charset=utf-8',
                'content' => urldecode($odata)
            )
        );
        //var_dump($opts);
    
        $context = stream_context_create($opts);
        //var_dump($context);
    
        $url = 'http://inforhus.minsa.gob.pe/api/rest_inforhus_ensap.php';
            
        try {
            $json = file_get_contents($url, false, $context);
            //var_dump($json);
     
        } catch (\Throwable $th) {
            echo "Error";
        }
        
        $data = json_decode($json);
        //var_dump($data);
        
        return $data;
    }
}