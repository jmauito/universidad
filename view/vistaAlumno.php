<?php
require_once '../class/sysVista.class.php';
require_once '../class/sysControls.class.php';
require_once '../class/persona.class.php';
require_once '../class/alumno.class.php';

class vistaAlumno extends vista{

    public $modulo;
    public $interfaz;
    public $canInsert = false;
    public $canEdit = false;
    public $canDelete = false;
    
    
    function getPermisosUsuario($usuario){
        if ( $data = parent::getPermisosModuloInterfazUsuario($this->modulo, $this->interfaz, $usuario) ){
            $this->canInsert = $data->canInsert;
            $this->canEdit = $data->canEdit;
            $this->canDelete = $data->canDelete;
        }
    }
    
    function drawView($persona){
                
        $persona = base64_decode($persona);
        $content = '';
        $cl = new alumno();
        if ( !$cl->getData($persona) ){
            $content .= "No se encuentra el alumno";
        }

        $content .= $this->head('Datos del alumno:');
        $content .= $this->label('Código') . $this->data($cl->persona) .'<br>';
        $content .= $this->label('Apellidos y nombres') . $this->data($cl->nombreCompleto) .'<br>';
        $content .= $this->label('Correo institucional') . $this->data($cl->correoInstitucional) .'<br>';
        $content .= $this->label('Correo personal') . $this->data($cl->correoPersonal) .'<br>';
        $content .= $this->label('Cédula de identidad') . $this->data($cl->cedulaIdentidad) .'<br>';
        $content .= $this->label('RUC') . $this->data($cl->ruc) .'<br>';
        $content .= $this->label('Condicion') . $this->data($cl->condicion).'<br>';
        $this->data = $content;
        $this->file = 'data.html';
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
        $this->file = 'data.html';
        $this->action = "aceptar()";
        $this->drawHTML();
    }
    
    function drawEdit($codigo){
        
        $persona = base64_decode($codigo);
        
        $content = '';
        $cl = new alumno();
        if ( !$cl->getData($persona) ){
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
        
        $this->file = 'data.html';
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
             
        $this->file = 'data.html';
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
        
        return $content;
    }
       
    
    function drawList($valor){
        $cl = new alumno();
        $data = $cl->dataList($valor);
                
        $this->dataTitle = "<th>Nro.</th>"
                           . "<th>Acciones</th>"
                           . "<th>Código</th>"
                           . "<th>Alumno</th>"
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
        
        $this->file = 'lista.html';
        $this->javaScriptFile = 'lista';
        $this->drawHTML();
        
    }
    
    private  function listButtons($persona){
        $persona = base64_encode($persona);
        
        $html = "<a class=\"btnLista\" href=\"#\" onclick = \"view('$persona');\">"
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

