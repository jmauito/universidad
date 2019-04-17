<?php
require_once 'persona.class.php';

class usuario extends persona{
    public $estado;
    public $usuario;
    public $canInsert = false;
    public $canEdit = false;
    public $canDelete = false;
    
    public $interfaz = array();
    
    public function verificarUsuarioPassword($usuario,$password){
        
        $query = "SELECT count(u.persona) as valida"
                . " FROM sys_usuario u"
                . " WHERE u.usuario = '$usuario' and u.password = '$password'"
                    . " AND u.estado <> 'I'";
        
        if ( !$result = $this->getDataArray($query) ){
            return false;
        }
        foreach ($result as $data){
            $item = $data['valida'];
        }
        
        if ( !$item ){
            return false;
        }
        
        
        return true;
    }
    function getData($usuario){
        $query = "SELECT u.usuario,u.persona,u.estado,p.nombreCompleto "
                . " FROM sys_usuario u "
                . " INNER JOIN mae_persona p on p.persona = u.persona "
                . " WHERE u.usuario = '$usuario' AND u.estado <>  'I'"
        ;
        if ( !$result = $this->getDataArray($query) ){
            return false;
        }
        
        foreach ($result as $data){
            $this->usuario = $data['usuario'];
            $this->persona = $data['persona'];
            $this->estado = $data['estado'];
            $this->nombreCompleto = $data['nombreCompleto'];
        }
        
        if ( !parent::getData($this->persona)){
            return false;
        }
        return true;
    }
    public function getListModulos(){
        $query = "SELECT i.modulo,ui.interfaz,ui.canInsert,ui.canEdit,ui.canDelete,ui.nivelUsuario "
                . " FROM sys_usuarioInterfaz ui "
                . " INNER JOIN sys_interfaz i ON i.interfaz = ui.interfaz "
                . " WHERE ui.usuario = '{$this->usuario}'";
        if ( !$result = $this->getDataObject($query)){
            return false;
        }
               
        return $result;
    }
    public function getPermisosInterfaz($modulo,$interfaz){
        $query = "SELECT modulo,interfaz,canInsert,canEdit,canDelete,nivelUsuario "
                . " FROM sys_usuarioInterfaz "
                . " WHERE usuario = '{$this->usuario}' "
                . " AND modulo = '$modulo' "
                . " AND interfaz = '$interfaz'";
        if ( !$result = $this->getDataObject($query) ){
            return false;
        } 
        $data = $result[0];
        
        $this->canInsert = $data->canInsert;
        $this->canEdit = $data->canEdit;
        $this->canDelete = $data->canDelete;
    }
    
}

