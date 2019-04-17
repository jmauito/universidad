<?php
require_once '../class/sysVista.class.php';
require_once '../class/sysControls.class.php';
require_once 'vistaSede.php';
require_once 'vistaSemestre.php';
require_once 'vistaCarrera.php';
require_once '../class/alumno.class.php';

class vistaMatricula extends vista{

    public $modulo;
    public $interfaz;
    public $canInsert = false;
    public $canEdit = false;
    public $canDelete = false;
    public $controller = '../controller/matricula.controller.php';
    
    function getPermisosUsuario($usuario){
        if ( $data = parent::getPermisosModuloInterfazUsuario($this->interfaz, $usuario) ){
            $this->canInsert = $data->canInsert;
            $this->canEdit = $data->canEdit;
            $this->canDelete = $data->canDelete;
        }
    }
    
    function drawView($cl){
        
        $content = '';
        
        if ( !$cl ){
            $content .= "No se encuentra el alumno";
        }
        $hd = new inputHidden('hdController',$this->controller);
        $content .= $hd->draw();
        $content .= $this->head('Datos del alumno:');
        $content .= $this->label('Código') . $this->data($cl->persona) .'<br>';
        $content .= $this->label('Apellidos y nombres') . $this->data($cl->nombreCompleto) .'<br>';
        $content .= $this->label('Correo institucional') . $this->data($cl->correoInstitucional) .'<br>';
        $content .= $this->label('Correo personal') . $this->data($cl->correoPersonal) .'<br>';
        $content .= $this->label('Cédula de identidad') . $this->data($cl->cedulaIdentidad) .'<br>';
        $content .= $this->label('RUC') . $this->data($cl->ruc) .'<br>';
        $content .= $this->label('Condicion') . $this->data($cl->condicion).'<br>';
        $this->data = $content;
        $this->file = '../template/data.html';
        $this->drawHTML();
        
    }
    
    function drawForm($action){
        
        $content = '';           
        $hd = new inputHidden('hdAction', $action);
            $content .= $hd->draw();
        
        $hdCodigo = new inputHidden('hdCodigo', '{codigo}');
            $content .= $hdCodigo->draw();
            
        $content .= $this->label('Código') .'{persona} <br>';
        $content .= $this->label('Primer nombre') ;
        $content .= "<input type = \"text\" name=\"txtPrimerNombre\" id=\"txtPrimerNombre\""
                . "  value = \"{primerNombre}\"> <br>";
        $content .= $this->label('Segundo nombre') ;
        $content .= "<input type = \"text\" name=\"txtSegundoNombre\" id=\"txtSegundoNombre\" "
                . " value = \"{segundoNombre}\"> <br>";
        $content .= $this->label('Apellido Paterno') ;
        $content .= "<input type = \"text\" name=\"txtApellidoPaterno\" id=\"txtApellidoPaterno\""
                . " value = \"{apellidoPaterno}\"> <br>";
        $content .= $this->label('Apellido Materno') ;
        $content .= "<input type = \"text\" name=\"txtApellidoMaterno\" id=\"txtApellidoMaterno\""
                . " value = \"{apellidoMaterno}\"> <br>";
        $content .= $this->label('Correo institucional') ;
        $content .= "<input type = \"mail\" name=\"txtCorreoInstitucional\" id=\"txtCorreoInstitucional\""
                . " value = \"{correoInstitucional}\"> <br>";
        $content .= $this->label('Correo personal') ;
        $content .= "<input type = \"mail\" name=\"txtCorreoPersonal\" id=\"txtCorreoPersonal\""
                . " value = \"{correoPersonal}\"> <br>";
        $content .= $this->label('Cédula de identidad') ;
        $content .= "<input type = \"text\" name=\"txtCedulaIdentidad\" id=\"txtCedulaIdentidad\""
                . " value = \"{cedulaIdentidad}\"> <br>";
        $content .= $this->label('RUC') ;
        $content .= "<input type = \"text\" name=\"txtRuc\" id=\"txtRuc\""
                . " value = \"{ruc}\"> <br>";
        $content .= $this->label('Condicion');
        $content .= "<input type = \"text\" name=\"txtCondicion\" id=\"txtCondicion\""
                . " value = \"{condicion}\"> <br>";
        return $content;
    }
    
    function drawInsert(){
        $content = '';
        $content .= $this->head('Insertar nuevo alumno');
        $form = $this->drawForm('insert');
               
        $cl = new alumno();
        foreach ($cl as $key=>$value){
            $form = str_replace('{'.$key.'}' , $value, $form);
        }
        $content .= $form;
        $content .= $this->formButtons('insert');
        
        $this->data = $content;
        $this->file = '../template/data.html';
        #$this->action = "aceptar()";
        $this->action = "insertAlumno()";
        $this->drawHTML();
    }
    
    function drawEdit($cl){
        
        $content = '';
        
        if ( !$cl ){
            $content .= "No se encuentra el alumno";
        }
        else{
            $content .= $this->head('Editar alumno:');
                        
            $form = $this->drawForm('update');
            
            foreach ($cl as $key=>$value){
                $form = str_replace('{'.$key.'}', $value, $form);
            }
            $form = str_replace('{codigo}', $codigo, $form);
            
            $content .= $form;
        }           
        $content .= $this->formButtons('edit');
        $this->data = $content;
        
        $this->file = '../template/data.html';
        $this->action = "aceptar()";
        $this->drawHTML();
    }
    
    function drawDelete($codigo){
        
        $persona = base64_decode($codigo);
        $content = '';
        $content .= $this->head("Confirme eliminación");
        
        $content .=  "¿Est&aacute; seguro de eliminar alumno: $persona?";
        $content .= "<br>";
        
        $hd = new inputHidden('hdCodigo', $codigo);
            $content .= $hd->draw();
        
        $btnSi = new inputSubmit('S&iacute;');
            $content .= $btnSi->draw();
        
        $btnNo = new inputCancel();
            $btnNo->value = 'No';
            $btnNo->onclick = 'search()';
            $content .= $btnNo->draw();
        
        $this->data = $content;
             
        $this->file = '../template/data.html';
        $this->action = "eliminar()";
        $this->drawHTML();
    }
    
    function drawSearch(){
        $cls = new inputSearch();
        $cls->id = 'txtSearch';
        $cls->name = 'txtSearch';
        $cls->placeholder = 'Búsqueda por c&oacute;digo, c&eacute;dula o nombre del alumno';
        $cls->required = true;
                        
        $content = $cls->draw();
        $hd = new inputHidden('hdController', $this->controller);
        $content .= $hd->draw();
        
        return $content;
    }
       
    
    function drawList($data){
                        
        $this->dataTitle = "<th>Nro.</th>"
                           . "<th>Acciones</th>"
                           . "<th>Código</th>"
                           . "<th>Matricula</th>"
                           . "<th>Condicion</th>";
        
        if ( !$data ){ 
            $this->dataList = "<td colspan = \"4\"> No se encontraron resultados </td>";
        }else{
            $html = '';
            $indice = 1;
            foreach ($data as $item){
                $html .= '<tr>';
                    $html .= "<td>".$indice++."</td>";
                    $html .= "<td>".$this->listButtons($item->persona)."</td>";
                    $html .= "<td>{$item->persona}</td>";
                    $html .= "<td>{$item->nombreCompleto}</td>";
                    $html .= "<td>{$item->condicion}</td>";
                $html .= '</tr>';
            }
            $this->dataList = $html;
        }
        $this->legend = $this->drawLegend();
        
        $this->file = '../template/lista.html';
        $this->javaScriptFile = 'lista';
        $this->drawHTML();
        
    }
    
    private  function listButtons($persona){
        $persona = base64_encode($persona);
        $html = '';
        $html .= "<a class=\"btnLista\" href=\"#\" onclick = \"view('$persona');\">"
                    . '<i class="fa fa-eye" title = "Ver"></i>'
                . '</a>'
                ;
        
        if ($this->canEdit){
            $html .= "<a class=\"btnLista\" href=\"#\" onclick = \"edit('$persona');\">"
                    . "<i class=\"fa fa-pencil-square-o\" title=\"Editar\"></i>"
                    . "</a>";
        }
        if ($this->canDelete){
            $html .= "<a class=\"btnLista\" href=\"#\" onclick = \"drop('$persona');\">"
                    . "<i class=\"fa fa-trash\" title=\"Eliminar\" style=\"color:red\"></i>"
                    . "</a>";
        }
        $html .= "<a class=\"btnLista\" href=\"#\" onclick = \"enroll('$persona');\">"
                    . "<i class=\"fa fa-trash\" title=\"Matricular\" style=\"color:red\"></i>"
                    . "</a>";
        return $html;
    }
    
    public function drawEnroll($persona){
        
        $html = '';
        
        $hd = new inputHidden('hdController','../controller/matricula.controller.php');
        $html .= $hd->draw();
        
        $hd = new inputHidden('hdPersona',$persona);
        $html .= $hd->draw();
        
        $clSemestre = new vistaSemestre();
        $html .= $clSemestre->drawSelect();
        $clSede = new vistaSede();
        $html .= $clSede->drawSelect();
        $clCarrera = new vistaCarrera();
        $html .= $clCarrera->drawSelect();
        
        $semestre = '1';
        $sede = '1';
        $carrera = '1';
        $curricula = '1';
                
        $html .= $this->drawCursoProgramado($semestre, $sede, $carrera,$curricula);
        
        $cl = new inputSubmit();
        $html .= $cl->draw();
        $this->data = $html; 
        
        $this->action = 'registrarMatricula()';
        $this->file = '../template/data.html';
        $this->javaScriptFile = 'lista';
        $this->drawHTML();
    }
    
    public function drawCursoProgramado($semestre,$sede,$carrera,$curricula){
        $cl = new matricula();
        $cl->semestre = $semestre;
        $cl->sede = $sede;
        $cl->carrera = $carrera;
        $data = $cl->getCursoProgramado();
        
        $html = '<table>';
        foreach ($data as $value) {
            $html .= '<tr>';
            $html .= "<td>{$value->materia}</td>";
            $html .= "<td>{$value->nombreMateria}</td>";
            $html .= "<td>{$value->paralelo}</td>";
            $html .= "<td><input type = \"checkbox\"  id = \"chMateria[]\"value = \"{$value->materia}\"></td>";
            $html .= '</tr>';
        }
        $html .= "</table>";
        
        return $html;
        
    }
    
    function drawLegend(){
        $html = '';
        $html .= '<i class="fa fa-eye" title = \"Editar\"></i>';
        $html .= "Ver ";
        if ($this->canEdit){
            $html .= "<i class=\"fa fa-pencil-square-o\" title=\"Editar\"></i>";
            $html .= "Editar ";
        }
        if ($this->canDelete){
            $html .= "<i class=\"fa fa-trash\" title=\"Eliminar\" style=\"color:red\"></i>";
            $html .= "Eliminar ";
        }
        
        return $html;
    }
    
    
    function formButtons($action){
        $html = '';

        $hd = new inputHidden('hdAction',$action);
            $html .= $hd->draw();
        
        $btnAceptar = new inputSubmit();
            $html .= $btnAceptar->draw();
            
        $btnCancelar = new inputCancel();
            $btnCancelar->onclick = 'search()';
            $html .= $btnCancelar->draw();
        
            return $html;
    }
    
    

}
