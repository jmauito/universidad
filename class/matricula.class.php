<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of matricula
 *
 * @author mauito
 */
require_once 'sysConnection.class.php';

class matricula extends connection{
    public $semestre = '';
    public $sede = '';
    public $carrera = '';
    public $curricula = '';
    public $alumno = '';
    
    public function getCursoProgramado(){
        $query = "CALL getCursoProgramadoSemestreSedeCarrera("
                . "'{$this->semestre}'"
                . ",'{$this->sede}'"
                . ",'{$this->carrera}'"
                . ")";
        
        if ( !$result = $this->getDataObject($query) ){
            return false;
        }
        return $result;
        
    }
    
    public function verificaPago(){
        $query = "SELECT debe FROM cob_ctacteAlumno WHERE persona = '{$this->alumno}'";
        
        if ( !$result = $this->getDataArray($query) ){
            return false;
        }
        
        if ($result[0]['debe'] > 0){
            return false;
        }
        return true;
        
    }
    
    public function verificarCondicion(){
        $query = "SELECT condicion FROM aca_alumno WHERE persona = '{$this->alumno}'";
        
        if ( !$result = $this->getDataArray($query) ){
            return false;
        }
        
        if ($result[0]['condicion'] == 1){
            return true;
        }
        return false;
    }
    
    public function recordMatricula($materias){
        foreach ($materias as $key=>$value){
            
        }
        if ( !$result = $this->execute($query) ){
            return false;
        }
        return true;
    }
    
    
    public function recordRendimiento(){
        return true;
    }
    
}
