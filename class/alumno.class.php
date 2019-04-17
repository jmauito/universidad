<?php

/**
 * Description of alumno
 *
 * @author mauito
 */
include 'persona.class.php';

class alumno extends persona{
    public $condicion;
    
    public function getData($persona){
        if ( !$objPersona = parent::getData($persona) ){
            return false;
        }
                        
        $query = "SELECT condicion FROM aca_alumno WHERE persona = '$persona'";
        if( !$result = parent::getData($query) ){
            return false;
        }
        
        foreach ($result as $alumno){    
            $this->condicion = $alumno->condicion;
        }
        return true;
        
    }
    
    public function insertData(){
        if ( !$persona = parent::insertData() ){
            return false;
        }
               
        $query = "INSERT INTO aca_alumno (persona,condicion) "
                . "VALUES ('$persona','{$this->condicion}')";
        
        if ( !parent::execute($query) ){
            return false;
        }
        return true;
    }
    
    public function updateData(){
        if ( !parent::updateData() ){
            return false;
        }
        $query = "UPDATE aca_alumno SET "
                . "condicion = '$this->cargo'"
                . " WHERE persona = '{$this->persona}'";
        if ( !parent::execute($query) ){
            return false;
        }
        return true;
    }
    public function deleteData(){
        if ( !isset($this->persona)){
            return false;
        }
        $query = "DELETE FROM aca_alumno WHERE persona = '{$this->persona}'";
        
        if (!parent::execute($query)){
            return false;
        }

        if ( !parent::deleteData() ){
            return false;
        }
        return true;   
        
    }
    public function dataList($valor){
        $array = array();
        
        if ($valor == ''){
            return $array;
        }
        
        if ( $this->isCodigoPersona($valor) ){
            $query = "SELECT * FROM v_acaAlumno "
                . " WHERE persona = '$valor'"
                ;
        }
        else {
            $query = "SELECT * FROM v_acaAlumno "
                . " WHERE nombreCompleto LIKE '$valor%'"
                ;
        }
        
        if ( !$result = $this->getDataObject($query) ){
            return false;
        }
        
        foreach ($result as $object){
            $array[] = $object;
        }
        
        return $array;
    }
    
    public function getEstructuraCurricula(){
        $query = "call getCarreraCurricula_persona('{$this->persona}')";
        if ( !$result = $this->getData($query) ){
            return false;
        }
        return $result;
    }
    
}
