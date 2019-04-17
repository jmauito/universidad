<?php

/**
 * Description of sysInterfaz
 *
 * @author mauito
 */
require_once 'sysConnection.class.php';

class sysInterfaz extends connection {
    
    public $interfaz;
    public $nombreInterfaz;
    public $modulo;
    public $nombreModulo;
    public $file;
    
    function __construct($modulo,$interfaz){
        
        parent::__construct();
        
        if ($modulo=='' || $interfaz == ''){
            return false;
        }
        
        if ( !$data = $this->getDataModuloInterfaz($modulo,$interfaz) ){
            return false;
        }
        
        foreach ($data as $value) {
            $this->interfaz = $interfaz;
            $this->nombreInterfaz = $value->nombreInterfaz;
            $this->modulo = $value->modulo;
            $this->nombreModulo = $value->nombreModulo;
            $this->file = $value->file;
        }
        return true;
    }
    
    function getDataModuloInterfaz($modulo,$interfaz){
        $query = "SELECT i.nombre as nombreInterfaz,i.file,i.modulo,m.nombre as nombreModulo "
                . " FROM sys_interfaz i "
                . " INNER JOIN sys_modulo m ON i.modulo = m.modulo"
                . " WHERE i.interfaz = '$interfaz' AND i.modulo = '$modulo'";
        if ( !$data = $this->getDataObject($query) ){
            return false;
        }
        return $data;
    }
    
    
    
    
}
