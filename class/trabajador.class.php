<?php

/**
 * Description of trabajador
 *
 * @author mauito
 */
require_once 'persona.class.php';

class trabajador extends persona{
    public $cargo;
    
    public function getData($persona){
        if ( !$objPersona = parent::getData($persona) ){
            return false;
        }
                        
        $query = "SELECT cargo FROM per_trabajador WHERE persona = '$persona'";
        if( !$result = parent::getDataObject($query) ){
            return false;
        }
        
        foreach ($result as $trabajador){
            $this->cargo = $trabajador->cargo;
        }
        return true;
        
    }
    
    public function insertData(){
        if ( !$persona = parent::insertData() ){
            return false;
        }
               
        $query = "call per_trabajadorInsert('$persona','{$this->cargo}')";
        
        parent::execute($query);
            
        return true;
    }
    
    public function updateData(){
        if ( !parent::updateData() ){
            return false;
        }
        $query = "UPDATE per_trabajador SET "
                . "cargo = '$this->cargo'"
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
        $query = "DELETE FROM per_trabajador WHERE persona = '{$this->persona}'";
        
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
            $query = "SELECT * FROM v_perTrabajador "
                . " WHERE persona = '$valor'"
                ;
        }
        else {
            $query = "SELECT * FROM v_perTrabajador "
                . " WHERE nombreCompleto LIKE '$valor%'"
                ;
        }
        
        if ( !$result = $this->getDataObject($query) ){
            return false;
        }
                
        
        return $result;
    }
    
}

