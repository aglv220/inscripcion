<?php
require_once(__DIR__.'/../../../config/config.php');
require_once($CNG->dirroot .'/include/controller/db.php');

class sunat_api extends DB
{
    private function refresh_token_api($url, $username, $password, $basic)
    {
        $body = array(
            'username' => $username,
            'password' => $password,
            'grant_type' => 'password'
        );
        
        $ch = curl_init($url); 
        $post = http_build_query($body); 
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded', 
            'Authorization: Basic ' . $basic)
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode($post)); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        try {
            $result = curl_exec($ch);

            // if($errno = curl_errno($ch)) {
            //     $error_message = curl_strerror($errno);
            //     echo "cURL error ({$errno}):\n {$error_message}";
            // }

            // echo "resultado token\n";
            // var_dump($result);

            curl_close($ch);
        } catch (\Throwable $th) {

            curl_close($ch);
        }

        $refresh = json_decode($result);
        $expire_token = date("Y-m-d H:i:s", strtotime( '+'. $refresh->expires_in .' second', strtotime(date("Y-m-d H:i:s"))));
        
        if ($refresh != null)
        {
            if ($refresh->expires_in == 3600)
            {
                $query = $this->connect()->prepare('UPDATE tbl_system SET value = :value WHERE id = :id');

                try {
                    $query->execute(array(':value'=> $refresh->access_token, ':id' => 13));
                    $query->execute(array(':value'=> $refresh->refresh_token, ':id' => 14));
                    $query->execute(array(':value'=> $refresh->token_type, ':id' => 16));
                    $query->execute(array(':value'=> $expire_token, ':id' => 15));
                } catch (\Throwable $th) {}

                return $refresh->access_token;
            }
            else{
                return $refresh->access_token;
            }
        }
    }

    private function get_token()
    {
        $data = null;
        $query = $this->connect()->prepare('SELECT * FROM tbl_system WHERE id_context = 3');
        
        try {
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) { echo "Problemas con API"; }

        if ($data != null){
            $expire = strtotime($data[2]['value']);
            $now = strtotime(date("Y-m-d H:i:s"));

            if ($now >= $expire)
            {
                // echo "actualizando...";
                $key = $this->refresh_token_api($data[7]['value'], $data[4]['value'], 
                                                $data[5]['value'], $data[6]['value']);
                return array(
                    "url" => $data[8]['value'],
                    "token" => $key
                );
            }else{
                return array(
                    "url" => $data[8]['value'],
                    "token" => $data[0]['value']
                );
            }
        }
    }

    public function get_info_api($documento)
    {
        //$data = $this->get_token();
        // var_dump($data);
        //$token = $data['token'];
        $token = "5MAwW6hUQLcqG1fgLQzGTIZJhLRN65EtKyAvmADcfnSPu4zafN1jEHpGnsQD";

        $body = array(
            'document' => $documento
        );

        //$ch = curl_init($data['url']); 
        $ch = curl_init("https://api.peruapis.com/v1/ruc"); 
        $post = json_encode($body); 
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json', 
            'Authorization: Bearer ' . $token)
            
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // var_dump($ch);

        $result = curl_exec($ch);
        // var_dump($result);
        curl_close($ch);
       
        $json = json_decode($result);
        return $json;
    }
}

// $s = new sunat_api();
// var_dump($s->get_info_api("10724769964"));