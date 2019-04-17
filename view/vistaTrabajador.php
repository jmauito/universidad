<?php
require_once '../class/sysVista.class.php';
require_once '../class/sysControls.class.php';

class vistaTrabajador extends vista{

    public $modulo;
    public $interfaz;
    public $canInsert = false;
    public $canEdit = false;
    public $canDelete = false;
    
    private $controller = '../controller/trabajador.controller.php';
    
    
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
            $content .= "No se encuentra el trabajador";
        }
        $hd = new inputHidden('hdController', $this->controller);
        $content .= $hd->draw();
        
        $content .= $this->head('Datos del trabajador:');
        $content .= $this->label('Código') . $this->data($cl->persona) .'<br>';
        $content .= $this->label('Apellidos y nombres') . $this->data($cl->nombreCompleto) .'<br>';
        $content .= $this->label('Correo institucional') . $this->data($cl->correoInstitucional) .'<br>';
        $content .= $this->label('Correo personal') . $this->data($cl->correoPersonal) .'<br>';
        $content .= $this->label('Cédula de identidad') . $this->data($cl->cedulaIdentidad) .'<br>';
        $content .= $this->label('RUC') . $this->data($cl->ruc) .'<br>';
        $content .= $this->label('Cargo') . $this->data($cl->cargo).'<br>';
        $this->data = $content;
        $this->file = '../template/data.html';
        $this->drawHTML();
        
    }
    
    function drawForm($action){
        
        $content = '';
        
        $hd = new inputHidden('hdController', $this->controller);
        $content .= $hd->draw();
        
        $hd = new inputHidden('hdAction', $action);
            $content .= $hd->draw();
        
        $hdCodigo = new inputHidden('hdCodigo', '{codigo}');
            $content .= $hdCodigo->draw();
            
        $content .= $this->label('Código') .'{persona} <br>';
        $content .= $this->label('Primer nombre') ;
        $input = new inputText("txtPrimerNombre","{primerNombre}");
        $content .= $input->draw() . "<br>";
        $content .= $this->label('Segundo nombre') ;
        $input = new inputText("txtSegundoNombre","{segundoNombre}");
        $content .= $input->draw() . "<br>";
        $content .= $this->label('Apellido Paterno') ;
        $input = new inputText("txtApellidoPaterno","{apellidoPaterno}");
        $content .= $input->draw() . "<br>";
        $content .= $this->label('Apellido Materno') ;
        $input = new inputText("txtApellidoMaterno","{apellidoMaterno}");
        $content .= $input->draw() . "<br>";
        
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
        $content .= $this->label('Cargo');
        $content .= "<input type = \"text\" name=\"txtCargo\" id=\"txtCargo\""
                . " value = \"{cargo}\"> <br>";
        return $content;
    }
    
    function drawInsert($cl){
        $content = '';
        
        $hd = new inputHidden('hdController', $this->controller);
        $content .= $hd->draw();
        
        $content .= $this->head('Insertar nuevo trabajador');
        $form = $this->drawForm('insert');
               
        foreach ($cl as $key=>$value){
            $form = str_replace('{'.$key.'}' , $value, $form);
        }
        $content .= $form;
        $content .= $this->formButtons('insert');
        
        $this->data = $content;
        $this->file = '../template/data.html';
        $this->action = "aceptar()";
        $this->drawHTML();
    }
    
    function drawEdit($cl){
        
        $content = '';
        
        $hd = new inputHidden('hdController', $this->controller);
        $content .= $hd->draw();
        
        if ( !$cl ){
            $content .= "No se encuentra el trabajador";
        }
        else{
            $content .= $this->head('Editar trabajador:');
                        
            $form = $this->drawForm('update');
            
            foreach ($cl as $key=>$value){
                $form = str_replace('{'.$key.'}', $value, $form);
            }
            $form = str_replace('{codigo}', base64_encode($cl->persona), $form);
            
            $content .= $form;
        }           
        $content .= $this->formButtons('edit');
        $this->data = $content;
        
        $this->file = '../template/data.html';
        $this->action = "aceptar()";
        $this->drawHTML();
    }
    
    function drawDelete($codigo){
        
        $content = '';
        
        $hd = new inputHidden('hdController', $this->controller);
        $content .= $hd->draw();
        
        $content .= $this->head("Confirme eliminación");
        
        $content .=  "¿Est&aacute; seguro de eliminar trabajador: $codigo?";
        $content .= "<br>";
        
        $hd = new inputHidden('hdCodigo', base64_encode($codigo));
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
        $cls->placeholder = 'Búsqueda por c&oacute;digo o nombre del trabajador';
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
                           . "<th>Trabajador</th>"
                           . "<th>Cargo</th>";
        
        if ( !$data ){ 
            $this->dataList = "<td colspan = \"5\"> No se encontraron resultados </td>";
        }else{
            $html = '';
            $indice = 1;
            foreach ($data as $item){
                $html .= '<tr>';
                    $html .= "<td>".$indice++."</td>";
                    $html .= "<td>".$this->listButtons($item->persona)."</td>";
                    $html .= "<td>{$item->persona}</td>";
                    $html .= "<td>{$item->nombreCompleto}</td>";
                    $html .= "<td>{$item->cargo}</td>";
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

        $hd = new inputHidden('hdController', $this->controller);
        $html .= $hd->draw();
        
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

