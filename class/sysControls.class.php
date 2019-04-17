<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sysControls
 *
 * @author mauito
 */
abstract class input{
    public $id = '';
    public $name = '';
    public $value = '';
    public $placeholder = '';
    public $required = false;
    public $pattern = '';
    public $class = '';
    
    
}

class inputSearch extends input{
    function draw(){
    $html = "<input type=\"search\""
            . " id=\"{$this->id}\""
            . " name=\"{$this->name}\" "
            . " placeholder = \"{$this->placeholder}\" "
                . ($this->required?' required=""':'')
                . ($this->pattern!=''?" pattern = {$this->pattern}":'')
            . ">";
    return $html;
    }
}

class inputSubmit extends input{
    
    public function __construct($value = 'Aceptar') {
        $this->id = 'btnAceptar';
        $this->name = 'btnAceptar';
        $this->value = $value;
    }
    
    function draw(){
        $html = "<input type=\"submit\""
                . " id = \"{$this->id}\""
                . " name =\"{$this->name}\""
                . " value = \"{$this->value}\""
                . ">";
        return $html;
    }

}

class inputCancel extends input{
    public $onclick = '';
    
    public function __construct($value = 'Cancelar') {
        $this->id = 'btnCancelar';
        $this->name = 'btnCancelar';
        $this->value = $value;
    }
    
    function draw(){
         $html = "<input type=\"button\""
                . " id = \"{$this->id}\""
                . " name =\"{$this->name}\""
                . " value = \"{$this->value}\""
                . " onclick = \"{$this->onclick}\""
                . ">";
        return $html;
    }
}

class inputHidden{
    public $id;
    public $name;
    public $value;
    
    public function __construct($id,$value){
        $this->id = $id;
        $this->name = $id;
        $this->value = $value;
        
    }
    public function draw(){
        $html = "<input type=\"hidden\""
                . " id = \"{$this->id}\""
                . " name =\"{$this->name}\""
                . " value = \"{$this->value}\""
                . ">";
        return $html;
    }
}

class inputText extends input{
    public function __construct($id,$value) {
        $this->id = $id;
        $this->name = $id;
        $this->value = $value;
    }
    
    public function draw(){
        
        $html = "<input type=\"text\""
                . " id = \"{$this->id}\""
                . " name =\"{$this->name}\""
                . " value = \"{$this->value}\""
                . ">";
        return $html;
    }
}

class inputSelect extends input{
        
    public function __construct($id) {
        $this->id = $id;
        $this->name = $id;
    }
    
    public function draw($options){
        
        $html = "<select id = \"{$this->id}\" name = \"{$this->name}\" >";
        foreach ($options as $item){
            $html .= "<option ";
            if ($item['selected'] == '1'){
                $html .= " selected ";
            }
            $html .= " value = \"{$item['value']}\" ";
            $html .= ">";
            $html .= $item['label'];
            $html .= "</option>";
        }
        $html .= "</select>";
        return $html;
    }
}