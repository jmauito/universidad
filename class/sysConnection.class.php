<?php

/*
 Connect usign PDO
 */

/**
 * Description of sysConnection
 *
 * @author mauito
 */
class connection {
    
    private $pdo;
    //Datos de conexión
    private $user = 'root';
    private $password = 'micoletsa';
    private $dataBase = 'pruebas';
    private $host = 'localhost';
    private $driver = 'mysql';
    //Registro de errores
    public $errorNumber = 0;
    private $errorSystem = '';
    public $error = '';
    private $errorFile = '../log/error.log';
    
    public function __construct() {
        $stringConnection = "{$this->driver}:host={$this->host};dbname={$this->dataBase}";
        try {
            $this->pdo = new PDO($stringConnection, $this->user, $this->password);
        } catch (Exception $ex) {
            $this->setError($ex);
        }
        
    }
    
    public function __destruct(){
        $this->pdo = NULL;
    }
    
    private function setError($error = null){
        
        if ( is_null($error) ){
            $error = $this->pdo->errorInfo();
            $this->errorNumber = $error[1];
            $this->errorSystem = $error[2];
        }else{
            $this->errorNumber = $error->getCode();
            $this->errorSystem = $error->getMessage();
        }
        $this->error = $this->errorSystem;
        $config = parse_ini_file("error.ini");
        if (key_exists($this->errorNumber, $config)){
            $this->error = $config[$this->errorNumber];
        }
        $this->logError();
        
    }
    
    
    private function logError($modulo='0',$interfaz='0'){
        $date = getdate();
        $log = "{$date['year']}-{$date['mon']}-{$date['mday']} "
        . "{$date['hours']}:{$date['minutes']}:{$date['seconds']}"
        . " {$this->errorNumber}:{$this->errorSystem} ($modulo-$interfaz) \n";
        echo "<script>alert(' $log')</script>";
        file_put_contents($this->errorFile, $log, FILE_APPEND);
        
        
    }
    
    public function getDataArray($query){
        
        if ( !$result = $this->pdo->query($query) ){
            $this->setError();
            return false;
        }
        $data = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
        
    }
    
    public function getDataObject($query){
        
        if ( !$result = $this->pdo->query($query) ){
            $this->setError();
            return false;
        }
        $data = array();
        while ($row = $result->fetch(PDO::FETCH_OBJ)){
          $data[] = $row;   
        }
        return $data;
    }

    public function execute($query){    
        
        if ($this->pdo->exec($query) === false ){
            $this->setError();
            return FALSE;
        }
        return TRUE;
    }
    
    public function executeInsert($query){
        if ($this->pdo->exec($query) === false ){
            $this->setError();
            return FALSE;
        }
        return $this->pdo->lastInsertId();
    }
    
    public function getDataValue($query){
        
        if ( !$result = $this->pdo->query($query)){
            $this->setError();
            return false;
        }
        $row = $result->fetch(PDO::FETCH_NUM);
        return $row[0];
    }
    
    protected function executePrepareSQL($query){
        if ( !$stmt = $this->prepare($query) ){
            $this->setError();
            return false;
        }
        if ( !$stmt->execute() ){
            $this->setError();
            return false;
        }
        $data = $stmt->fetchAll();
        return $data[0]['result'];
    }


    protected function prepare($query){
        return $this->pdo->prepare($query);
    }
    
    protected function query($query){
        return $this->pdo->query($query);
    }
    
}
