<?php

/**
 * Description of persona
 *
 * @author mauito
 */

require_once 'sysConnection.class.php';

abstract class persona extends connection {
    public $persona;
    public $nombreCompleto;
    public $apellidoPaterno;
    public $apellidoMaterno;
    public $primerNombre;
    public $segundoNombre;
    public $correoInstitucional;
    public $correoPersonal;
    public $cedulaIdentidad;
    public $ruc;
    
    private function setNombreCompleto(){
        $this->primerNombre = trim($this->primerNombre);
        $this->segundoNombre = trim($this->segundoNombre);
        $this->apellidoPaterno = trim($this->apellidoPaterno);
        $this->apellidoMaterno = trim($this->apellidoMaterno);
        
        $this->nombreCompleto  = $this->apellidoPaterno . ' '
                                . $this->apellidoMaterno . ' '
                                . $this->primerNombre . ' '
                                . $this->segundoNombre;
                
    }
    
    
    public function getData($persona){
        $query = "SELECT persona,nombreCompleto,apellidoPaterno,apellidoMaterno"
                . ",primerNombre,segundoNombre,correoInstitucional,correoPersonal"
                . ",cedulaIdentidad,ruc "
                . "FROM mae_persona "
                . "WHERE persona = '$persona'";
        
        if ( !$result = parent::getDataObject($query) ){
            return false;
        }
        
        $object = $result[0];
        
        $this->persona = $object->persona;
        $this->nombreCompleto = $object->nombreCompleto;
        $this->apellidoPaterno = $object->apellidoPaterno;
        $this->apellidoMaterno = $object->apellidoMaterno;
        $this->primerNombre = $object->primerNombre;
        $this->segundoNombre = $object->segundoNombre;
        $this->correoInstitucional = $object->correoInstitucional;
        $this->correoPersonal = $object->correoPersonal;
        $this->cedulaIdentidad = $object->cedulaIdentidad;
        $this->ruc = $object->ruc;
        return true;
    }
    public function insertData(){
        $this->setNombreCompleto();
        $query = "CALL mae_personaInsert('{$this->nombreCompleto}','{$this->apellidoPaterno}',"
                . "'{$this->apellidoMaterno}','{$this->primerNombre}','{$this->segundoNombre}',"
                . "'{$this->correoInstitucional}','{$this->correoPersonal}',"
                . "'{$this->cedulaIdentidad}','{$this->ruc}')";
        
        if ( !$value = parent::getDataObject($query)){
            return false;
        }
        return $value[0]->result;
        
    }
    public function updateData(){
        $this->setNombreCompleto();
        $query = "UPDATE mae_persona SET "
                . "nombreCompleto = '{$this->nombreCompleto}' "
                . ",apellidoPaterno = '{$this->apellidoPaterno}' "
                . ",apellidoMaterno = '{$this->apellidoMaterno}' "
                . ",primerNombre = '{$this->primerNombre}' "
                . ",segundoNombre = '{$this->segundoNombre}' "
                . ",correoInstitucional = '{$this->correoInstitucional}' "
                . ",correoPersonal = '{$this->correoPersonal}' "
                . ",cedulaIdentidad = '{$this->cedulaIdentidad}' "
                . ",ruc = '{$this->ruc}' "
                . " WHERE persona = '{$this->persona}'";
          
        if ( !parent::execute($query) ){
            return false;
        }
        return true;
    }
    
    public function deleteData(){
        $query = "DELETE FROM mae_persona "
                . " WHERE persona = '{$this->persona}'";
        if ( !parent::execute($query) ){
            return false;
        }
        return true;
    }
    
    //--Funciones de validaciones
    public function isCodigoPersona($valor){
        $regex = '/^[0-9]{8}$/';
        if ( !preg_match($regex, $valor) ){
            return false;
        }
        return true;
    }
    
}