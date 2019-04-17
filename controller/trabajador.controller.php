<?php
require_once '../view/vistaTrabajador.php';
require_once '../class/trabajador.class.php';

session_start();
if ( empty($_SESSION) ){
    header('Location:../login.php');
}

$vista = new vistaTrabajador();
    $vista->modulo = '002';
    $vista->interfaz = '001';

if (key_exists('action', $_POST) and key_exists('codigo', $_POST)){
    $action = filter_input(INPUT_POST, 'action');
    $codigo = filter_input(INPUT_POST, 'codigo');
    
    $vista->getPermisosUsuario($_SESSION['usuario']);
        
    switch ($action){
        case 'search':
            
            $cl = new trabajador();
            $data = $cl->dataList($codigo);
            $vista->drawList($data);
            break;
        
        case 'view':
            $persona = base64_decode($codigo);
            $cl = new trabajador();
            $cl->getData($persona);
            $vista->drawView($cl);
            break;
        
        case 'edit':
            $persona = base64_decode($codigo);
            $cl = new trabajador();
            $cl->getData($persona);
            $vista->drawEdit($cl);
            break;
        
        case 'update':
            update();
            break;
        
        case 'delete':
            $persona = base64_decode($codigo);
            $vista->drawDelete($persona);
            break;
        
        case 'eliminar':
            delete();
            break;
        
        case 'new':
            $cl = new trabajador();
            $vista->drawInsert($cl);
            break;
        
        case 'insert':
            insert();
            break;
    }
    
    
}

function insert(){
    
    $trabajador = new trabajador();
        $trabajador->persona = $persona;
        $trabajador->primerNombre = filter_input(INPUT_POST,'primerNombre');
        $trabajador->segundoNombre = filter_input(INPUT_POST,'segundoNombre');
        $trabajador->apellidoPaterno = filter_input(INPUT_POST,'apellidoPaterno');
        $trabajador->apellidoMaterno = filter_input(INPUT_POST,'apellidoMaterno');
        $trabajador->correoInstitucional = filter_input(INPUT_POST,'correoInstitucional');
        $trabajador->correoPersonal = filter_input(INPUT_POST,'correoPersonal');
        $trabajador->cedulaIdentidad = filter_input(INPUT_POST,'cedulaIdentidad');
        $trabajador->ruc = filter_input(INPUT_POST,'ruc');
        $trabajador->cargo = filter_input(INPUT_POST, 'cargo');
        if ( !$trabajador->insertData() ){
              echo 'Error: no se actualiz&oactue; el registro. '.$trabajador->error;
              return ;
            }
            echo 'Se ha generado un nuevo registro con el código: '.$trabajador->persona ;
}

function update(){
    $codigo = filter_input(INPUT_POST, 'codigo');
    $persona = base64_decode($codigo);
    $trabajador = new trabajador();
            $trabajador->persona = $persona;
            $trabajador->primerNombre = filter_input(INPUT_POST,'primerNombre');
            $trabajador->segundoNombre = filter_input(INPUT_POST,'segundoNombre');
            $trabajador->apellidoPaterno = filter_input(INPUT_POST,'apellidoPaterno');
            $trabajador->apellidoMaterno = filter_input(INPUT_POST,'apellidoMaterno');
            $trabajador->correoInstitucional = filter_input(INPUT_POST,'correoInstitucional');
            $trabajador->correoPersonal = filter_input(INPUT_POST,'correoPersonal');
            $trabajador->cedulaIdentidad = filter_input(INPUT_POST,'cedulaIdentidad');
            $trabajador->ruc = filter_input(INPUT_POST,'ruc');
            $trabajador->cargo = filter_input(INPUT_POST, 'cargo');
            if ( !$trabajador->updateData() ){
                echo 'Error: no se actualiz&oacute; el registro. '.$trabajador->errno;
                return;
            }
            echo 'Registro actualizado';
            
}

function delete(){
    $codigo = filter_input(INPUT_POST, 'codigo');
    $persona = base64_decode($codigo);
    
    $trabajador = new trabajador();
        $trabajador->persona = $persona;
        if ( !$trabajador->deleteData() ){
            echo 'Error: no se elimin&oactute; el registro. '.$trabajador->error ;
        }
        echo 'Registro eliminado';
}


