<?php
class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host     = 'localhost';
        $this->db       = 'ensapadmin_db';
        $this->user     = 'root';
        $this->password = '';
        $this->charset  = 'utf8mb4';
    }
    // public function __construct(){
    //     $this->host     = '10.0.0.46';
    //     $this->db       = 'ensapadmin_db';
    //     $this->user     = 'app_ensap';
    //     $this->password = 'app_ensap123app_ensap';
    //     $this->charset  = 'utf8mb4';
    // }
    
    // public function __construct(){
    //     $this->host     = '127.0.0.1:3307';
    //     $this->db       = 'ensapadmin_db';
    //     $this->user     = 'adminmoodle';
    //     $this->password = 'P@M#asdTT$MM';
    //     $this->charset  = 'utf8mb4';
    // }

    function connect(){
        try{

            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $pdo = new PDO($connection, $this->user, $this->password, $options);

           return $pdo;
       }catch(PDOException $e){
           print_r('Error connection: ' . $e->getMessage());
       }
   }
}

?>
