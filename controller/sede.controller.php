<?php
require_once '../view/vistaSede.php';
require_once '../class/sede.class.php';

session_start();
if ( empty($_SESSION) ){
    header('Location:../login.php');
}

$vista = new vistaSede();
    $vista->modulo = '003';
    $vista->interfaz = '001';

if (key_exists('action', $_POST) and key_exists('codigo', $_POST)){
    $action = filter_input(INPUT_POST, 'action');
    $codigo = filter_input(INPUT_POST, 'codigo');
    
    $vista->getPermisosUsuario($_SESSION['usuario']);
        
    switch ($action){
        case 'search':
            $cl = new sede();
            $data = $cl->dataList($codigo);
            $vista->drawList($data);
            break;
        
        case 'view':
            $codigo = base64_decode($codigo);
            $cl = new sede();
            $cl->getData($codigo);
            $vista->drawView($cl);
            break;
        
        case 'edit':
            $codigo = base64_decode($codigo);
            $cl = new sede();
            $cl->getData($codigo);
            $vista->drawEdit($cl);
            break;
        
        case 'update':
            update();
            break;
        
        case 'delete':
            $codigo = base64_decode($codigo);
            $vista->drawDelete($codigo);
            break;
        
        case 'eliminar':
            delete();
            break;
        
        case 'new':
            $cl = new sede();
            $vista->drawInsert($cl);
            break;
        
        case 'insert':
            
            insert();
            break;
    }
    
    
}

function insert(){
    
    $sede = new sede();
        $sede->sede = '';
        $sede->nombre = filter_input(INPUT_POST,'nombre');
        $sede->alias = filter_input(INPUT_POST,'alias');
        
        if ( !$sede->insertData() ){
              echo 'Error: no se actualiz&oactue; el registro. '.$sede->error;
              return ;
            }
            echo 'Se ha generado un nuevo registro con el código: '.$sede->sede ;
}

function update(){
    
    $codigo = base64_decode(filter_input(INPUT_POST, 'codigo'));
    $sede = new sede();
            $sede->sede = $codigo;
            $sede->nombre = filter_input(INPUT_POST,'nombre');
            $sede->alias = filter_input(INPUT_POST,'alias');
            $sede->estado = filter_input(INPUT_POST,'estado');
            
            if ( !$sede->updateData() ){
                echo 'Error: no se actualiz&oacute; el registro. '.$sede->errno;
                return;
            }
            echo 'Registro actualizado';
            
}

function delete(){
    
    $codigo = base64_decode(filter_input(INPUT_POST, 'codigo'));
    
    $sede = new sede();
        $sede->sede = $codigo;
        if ( !$sede->deleteData() ){
            echo 'Error: no se elimin&oactute; el registro. '.$sede->error ;
        }
        echo 'Registro eliminado';
}




