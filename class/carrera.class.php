<?php

/**
 * Description of carrera
 *
 * @author mauito
 */
require_once 'sysConnection.class.php';

class carrera extends connection {
    public $carrera = '';
    public $nombre = '';
    public $alias = '';
    public $estado = '';
    
    function __construct() {
        parent::__construct();
    }
    
    function getDataObject($carrera) {
        
        $query = "SELECT carrera,nombre,alias,estado FROM mae_carrera WHERE carrera = '$carrera'";
        if ( !$result = parent::getDataObject($query) ){
            return false;
        }
        
        $this->carrera = $result[0]->carrera;
        $this->nombre = $result[0]->nombre;
        $this->alias = $result[0]->alias;
        $this->estado = $result[0]->estado;
        
        return true;
    }
    
    function getList(){
        $query = "SELECT carrera,nombre,alias,estado FROM mae_carrera WHERE estado = 'A'";
        if ( !$result = parent::getDataArray($query) ){
            return false;
        }
        return $result;
    }
}
