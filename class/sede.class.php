<?php

/**
 * Description of sede
 *
 * @author mauito
 */
require_once 'sysConnection.class.php';

class sede extends connection {
    public $sede = '';
    public $nombre = '';
    public $alias = '';
    public $estado = '';
    
    function __construct() {
        parent::__construct();
    }
    
    function getData($sede){
        $query = "SELECT * FROM mae_sede WHERE sede = '$sede'"; 
        $data = parent::getDataObject($query);
        if ($data === false){
            return false;
        }
        
        $this->sede = $data[0]->sede;
        $this->nombre = $data[0]->nombre;
        $this->alias = $data[0]->alias;
        $this->estado = $data[0]->estado;
    }
    
    function getDataObject($sede) {
        
        $query = "SELECT sede,nombre,alias,estado FROM mae_sede WHERE sede = '$sede'";
        if ( !$result = parent::getDataObject($query) ){
            return false;
        }
        
        $this->sede = $result[0]->sede;
        $this->nombre = $result[0]->nombre;
        $this->alias = $result[0]->alias;
        $this->estado = $result[0]->estado;
        
        return true;
    }
    
    function getList(){
        $query = "SELECT sede,nombre,alias,estado FROM mae_sede WHERE estado = 'A'";
        if ( !$result = parent::getDataArray($query) ){
            return false;
        }
        return $result;
    }
    
    function insertData(){
        $query = "INSERT INTO mae_sede (nombre,alias)"
                . " VALUES ('{$this->nombre}','$this->alias')";
        return  $this->executeInsert($query);
        
    }
    
    function updateData(){
        $query = "UPDATE mae_sede SET nombre = '{$this->nombre}',alias='{$this->alias}',estado='{$this->estado}' "
        . " WHERE sede = '{$this->sede}' ";
        return $this->execute($query);
            
    }
    
    function deleteData(){
        $query = "DELETE FROM mae_sede WHERE sede = '{$this->sede}'";
        return $this->execute($query);
    }
    
    public function dataList($valor){
        $array = array();
        
        if ($valor == ''){
            return $array;
        }
        
        if ( $this->isCodigoSede($valor) ){
            $query = "SELECT * FROM mae_sede "
                . " WHERE sede = '$valor'"
                ;
        }
        else {
            $query = "SELECT * FROM mae_sede "
                . " WHERE nombre LIKE '$valor%'"
                ;
        }
        
        if ( !$result = parent::getDataObject($query) ){
            return false;
        }
                
        
        return $result;
    }
    
    //--Funciones de validaciones
    public function isCodigoSede($valor){
        $regex = '/^[0-9]{4}$/';
        if ( !preg_match($regex, $valor) ){
            return false;
        }
        return true;
    }
}
