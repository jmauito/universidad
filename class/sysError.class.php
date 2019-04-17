<?php
require_once 'sysConnection.class.php';

class sysError {
    public function registrarError($errorNumber,$modulo,$interfaz){
        $query = "insert into sys_errorLog (errorNumber,fecha,modulo,interfaz)"
                . "VALUES '$errorNumber',NOW(),'$modulo','$interfaz')";
        $cl = new connection();
        $cl->execute($query);
        
    }
}
