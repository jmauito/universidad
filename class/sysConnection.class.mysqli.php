<?php


class connection_mysqli {
    
    private $host = 'localhost';
    private $database = 'pruebas';
    private $user = 'root';
    private $password = 'micoletsa';
    private $mysqli;
    public $errno = 0;
    public $error = 'Error'; //Alamacena el error con mensaje personalizado de error.ini
    private $errorSystem = ''; //Almacena el error enviado por mysql
    private $errorFile = '../log/error.log';
    
        
    public function __construct() {
        $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->database);
        
        if (mysqli_connect_error()) {
            $this->setError(mysqli_connect_errno() , mysqli_connect_error());
        }
    }
    public function __destruct() {
        
        $this->mysqli->close();
        unset($this);
    }
    
    private function setError($errno,$error){
        
        $this->errno = $errno;
        $this->errorSystem = $error;
        $config = parse_ini_file("error.ini");
        if (key_exists($this->errno, $config)){
            $this->error = $config[$errno];
        }
        $this->logError();
        
    }
    
    private function logError($modulo='0',$interfaz='0'){
        $date = getdate();
        $log = "{$date['year']}-{$date['mon']}-{$date['mday']} {$this->errno}:$this->errorSystem} ($modulo-$interfaz)";
        file_put_contents($this->errorFile, $log, FILE_APPEND);
        
    }

    public function getDataArray($query){
        
        if ( !$result = $this->mysqli->query($query) ){
            $this->setError($this->mysqli->errno, $this->mysqli->error);
            return false;
        }
        $data = array();
        while ($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function getDataObject($query){
        
        if ( !$result = $this->mysqli->query($query) ){
            $this->setError($this->mysqli->errno, $this->mysqli->error);
            return false;
        }
        $data = array();
        while ($row = $result->fetch_object()){
            $data[] = $row;
        }
        return $data;
    }
    
    public function execute($query){
        return $this->mysqli->query($query);
        
    }
    public function query($query){
        return $this->mysqli->query($query);
    }
    
    protected function prepare($query){
        return $this->mysqli->prepare($query);
    }

}//class


