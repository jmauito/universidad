<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sede
 *
 * @author mauito
 */
require_once 'sysConnection.class.php';

class semestre extends connection {
    public $semestre = '';
    public $nombre = '';
    public $alias = '';
    public $vigente = '';
    public $estado = '';
    
    function __construct() {
        parent::__construct();
    }
    
    function getDataObject($semestre) {
        
        $query = "SELECT semestre,nombre,alias,vigente,estado FROM mae_semestre WHERE semestre = '$semestre'";
        if ( !$result = parent::getDataObject($query) ){
            return false;
        }
        
        $this->sede = $result[0]->semestre;
        $this->nombre = $result[0]->nombre;
        $this->alias = $result[0]->alias;
        $this->vigente = $result[0]->vigente;
        $this->estado = $result[0]->estado;
        
        return true;
    }
    
    public function getList(){
        $query = "SELECT semestre,nombre,alias,vigente,estado"
                . " FROM mae_semestre"
                . " WHERE estado = 'A'";
        if ( !$result = $this->getDataArray($query) ){
            return false;
        }
        return $result;
            
    }
            
    function getSemestreVigente(){
        $query = "SELECT semestre FROM mae_semestre WHERE estado = 'A' AND vigente = '1'";
        if ( !$result = parent::getDataObject($query) ){
            return false;
        }
        return $result[0]->semestre;
    }
}

