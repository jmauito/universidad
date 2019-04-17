<?php
/**
 * Description of vistaSede
 *
 * @author mauito
 */
require_once '../class/sede.class.php';
require_once '../class/sysControls.class.php';
require_once '../class/sysVista.class.php';

class vistaSede extends vista {
    public $modulo;
    public $interfaz;
    public $canInsert = false;
    public $canEdit = false;
    public $canDelete = false;
    
    private $controller = '../controller/sede.controller.php';
    
    function getPermisosUsuario($usuario){
        if ( $data = parent::getPermisosModuloInterfazUsuario($this->interfaz, $usuario) ){
            $this->canInsert = $data->canInsert;
            $this->canEdit = $data->canEdit;
            $this->canDelete = $data->canDelete;
        }
    }
    
    public function drawView($cl){
        $content = '';
        
        if ( !$cl ){
            $content .= "No se encuentra la sede";
        }
        $hd = new inputHidden('hdController', $this->controller);
        $content .= $hd->draw();
        
        $content .= $this->head('Datos de la sede:');
        $content .= $this->label('Código') . $this->data($cl->sede) .'<br>';
        $content .= $this->label('Nombre') . $this->data($cl->nombre) .'<br>';
        $content .= $this->label('Alias') . $this->data($cl->alias) .'<br>';
        
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
            
        $content .= $this->label('Código') .'{sede} <br>';
        $content .= $this->label('Nombre') ;
        $content .= "<input type = \"text\" name=\"txtNombre\" id=\"txtNombre\""
                . "  value = \"{nombre}\"> <br>";
        $content .= $this->label('Alias') ;
        $content .= "<input type = \"text\" name=\"txtAlias\" id=\"txtAlias\" "
                . " value = \"{alias}\"> <br>";
        
        return $content;
    }
    
    function drawInsert($cl){
        $content = '';
        
        $hd = new inputHidden('hdController', $this->controller);
        $content .= $hd->draw();
        
        $content .= $this->head('Insertar nueva sede');
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
            $content .= "No se encuentra la sede";
        }
        else{
            $content .= $this->head('Editar sede:');
                        
            $form = $this->drawForm('update');
            
            foreach ($cl as $key=>$value){
                $form = str_replace('{'.$key.'}', $value, $form);
            }
            $form = str_replace('{codigo}', base64_encode($cl->sede), $form);
            
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
        
        $content .=  "¿Est&aacute; seguro de eliminar la sede: $codigo?";
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
        $cls->placeholder = 'Búsqueda por c&oacute;digo, nombre o alias de la sede';
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
                           . "<th>Nombre</th>"
                           . "<th>Alias</th>";
        
        if ( !$data ){ 
            $this->dataList = "<td colspan = \"4\"> No se encontraron resultados </td>";
        }else{
            $html = '';
            $indice = 1;
            foreach ($data as $item){
                $html .= '<tr>';
                    $html .= "<td>".$indice++."</td>";
                    $html .= "<td>".$this->listButtons($item->sede)."</td>";
                    $html .= "<td>{$item->sede}</td>";
                    $html .= "<td>{$item->nombre}</td>";
                    $html .= "<td>{$item->alias}</td>";
                $html .= '</tr>';
            }
            $this->dataList = $html;
        }
        $this->legend = $this->drawLegend();
        
        $this->file = '../template/lista.html';
        $this->javaScriptFile = 'lista';
        $this->drawHTML();
        
    }
    
        private  function listButtons($sede){
        $sede = base64_encode($sede);
        
        $html = "<a class=\"btnLista\" href=\"#\" onclick = \"view('$sede');\">"
                    . '<i class="fa fa-eye" title = "Ver"></i>'
                . '</a>'
                ;
        
        if ($this->canEdit){
            $html .= "<a class=\"btnLista\" href=\"#\" onclick = \"edit('$sede');\">"
                    . "<i class=\"fa fa-pencil-square-o\" title=\"Editar\"></i>"
                    . "</a>";
        }
        if ($this->canDelete){
            $html .= "<a class=\"btnLista\" href=\"#\" onclick = \"drop('$sede');\">"
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
    
    public function drawSelect(){
        $clSede = new sede();
        $data = $clSede->getList();
        
        $options = array();
        
        foreach ($data as $item){
            $options[] = array( 'value' => $item['sede'],
                                'selected'=> '0',
                                'label' => $item['nombre'],
                            );
        }
        
        if ( isset($options) ){
            
            $clControl = new inputSelect('lsSede');
            $html = $clControl->draw($options);
        }
    return $html;
    }
}

