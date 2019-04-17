<?php
require_once '../view/vistaMatricula.php';
require_once '../view/vistaAlumno.php';

require_once '../class/matricula.class.php';
require_once '../class/alumno.class.php';

session_start();
if ( empty($_SESSION) ){
    header('Location:../login.php');
}

$vista = new vistaMatricula();
    $vista->modulo = '002';
    $vista->interfaz = '001';

if (key_exists('action', $_POST) and key_exists('codigo', $_POST)){
    $action = filter_input(INPUT_POST, 'action');
    $codigo = filter_input(INPUT_POST, 'codigo');
    
    $vista->getPermisosUsuario($_SESSION['usuario']);
     
    switch ($action){
        case 'search':
            $cl = new alumno();
            $data = $cl->dataList($codigo);
            
            $vwAlumno = new vistaAlumno();
            $vista->drawList($data);
            break;
        
        case 'enroll':
            $vista->drawEnroll($codigo);
            break;
        
        case 'registrarMatricula':
            
            registrarMatricula();
            break;
        
        case 'view':
            $cl = new alumno();
            $cl->getData(base64_decode($codigo));
            $vista->drawView($cl);
            break;
        
        case 'edit':
            $cl = new alumno();
            $cl->getData(base64_decode($codigo));
            $vista->drawEdit($cl);
            break;
        
        case 'update':
            update();
            break;
        
        case 'delete':
            $vista->drawDelete($codigo);
            break;
        
        case 'eliminar':
            delete();
            break;
        
        case 'new':
            $vista->drawInsert();
            break;
        
        case 'insert':
            insert();
            break;
    }
    
    
}

function registrarMatricula(){
    
    #$cl = new matricula();
    
    $persona = filter_input(INPUT_POST,'codigo');
    $persona = base64_decode($persona);
    $bloqueo = verificarBloqueos($persona);
    
    if ( !$bloqueo ){
        print('El alumno se puede matricular'.PHP_EOL);
    }
    else{
        print ($bloqueo);
    }
            
}

function verificarBloqueos($persona){
    
    $cl = new matricula();
    $cl->alumno = $persona;

    $msjBloqueos = 'NO SE PUEDE REALIZAR LA MATRÍCULA<br>';
    $bloqueo = false;
    if ( !$cl->verificaPago() ){
        $msjBloqueos .= 'El alumno no se encuentra al día en sus pagos.'.'<br>';
        $bloqueo = true;
    }
    
    if (!$cl->verificarCondicion()){
        $msjBloqueos .= 'La condición del alumno no le permite matricularse.'.'<br>';
        $bloqueo = true;
    }
    
    if ($bloqueo){
        
        return $msjBloqueos;
    }
    return FALSE;
}


function insert(){
       
    $alumno = new alumno();
        $alumno->persona = $persona;
        $alumno->primerNombre = filter_input(INPUT_POST,'primerNombre');
        $alumno->segundoNombre = filter_input(INPUT_POST,'segundoNombre');
        $alumno->apellidoPaterno = filter_input(INPUT_POST,'apellidoPaterno');
        $alumno->apellidoMaterno = filter_input(INPUT_POST,'apellidoMaterno');
        $alumno->correoInstitucional = filter_input(INPUT_POST,'correoInstitucional');
        $alumno->correoPersonal = filter_input(INPUT_POST,'correoPersonal');
        $alumno->cedulaIdentidad = filter_input(INPUT_POST,'cedulaIdentidad');
        $alumno->ruc = filter_input(INPUT_POST,'ruc');
        $alumno->condicion = filter_input(INPUT_POST, 'condicion');
        if ( !$alumno->insertData() ){
              echo 'Error: no se actualiz&oactue; el registro. '.$alumno->error;
              return ;
            }
            echo 'Se ha generado un nuevo registro con el código: '.$alumno->persona ;
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
                echo 'Error: no se actualiz&oactue; el registro. '.$trabajador->error;
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