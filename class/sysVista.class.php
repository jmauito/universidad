<?php
require_once 'sysConnection.class.php';

class vista extends connection{
    public $pageTitle = '';
    public $pageFooter = '';
    public $title = '';
    public $file = '';
    public $content = '';
    public $dataTitle = '';
    public $dataList = '';
    public $dataFoot = '';
    public $legend = '';
    public $inputSearch = '';
    public $data = '';
    public $list = '';
    public $buttons = '';
    public $javaScriptList = '';
    public $javaScriptFile = '';
    
    public $action = "";
    
    
    public function getPermisosModuloInterfazUsuario($interfaz,$usuario){
        $query = "SELECT interfaz,canInsert,canEdit,canDelete,nivelUsuario "
                . " FROM sys_usuarioInterfaz "
                . " WHERE usuario = '$usuario' "
                . " AND interfaz = '$interfaz'";
        if ( !$result = $this->getDataObject($query) ){
            return false;
        } 
        return $result[0];
        
        
    }
    
    
    function drawHTML(){
        
        $result = array(
            'javaScriptList' => $this->javaScriptList,
            'javaScriptFile' => $this->javaScriptFile,
            'pageTitle' => $this->pageTitle,
            'pageFooter' => $this->pageFooter,
            'title' => $this->title,
            'content' => $this->content,
            'dataTitle' => $this->dataTitle,
            'dataList' => $this->dataList,
            'dataFoot' => $this->dataFoot,
            'inputSearch' => $this->inputSearch,
            'data' => $this->data,
            'list' => $this->list,
            'buttons' => $this->buttons,
            'action' => $this->action,
            'legend' => $this->legend,
        );
        
        
        $file = file_get_contents($this->file);
        foreach ($result as $key=>$value){
            $file = str_replace('{'.$key.'}', $value, $file);
        }

        print $file;
    }
    
    function head($titulo){
        $html ='';
        $html .='<div id="head">';
        $html .= '<center><h1 class="pageTitle">'.$titulo.'<h1></center>';
        $html .= '</div>';
        return $html;
    }
    function label($label){
        $html = '';
        $html .= '<span class="label">';
        $html .= $label . '  :  ';
        $html .= '</span>';
        return $html;
    }
    function data($data){
        $html = '';
        $html .= '<span class="data">';
        $html .= $data;
        $html .= '</span>';
        return $html;
    }
    
    #Elementos Input HTML
    
    
    function buttonHome(){
        $html = '';
        $html .= '<input class = "button" type="button" onclick="../index.php" >';
        return $html;
    }
    
    function alert($message){
        return "<script>alert('$message')</script>";
    }
}
