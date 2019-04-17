<?php
/**
 * Description of vistaSemestre
 *
 * @author mauito
 */
require_once '../class/semestre.class.php';
require_once '../class/sysControls.class.php';
require_once '../class/sysVista.class.php';

class vistaSemestre extends vista {
    //put your code here
    public function drawSelect(){
        $clSemestre = new semestre();
        $data = $clSemestre->getList();
        
        $options = array();
        
        foreach ($data as $item){
            $options[] = array( 'value' => $item['semestre'],
                                'selected'=> $item['vigente'],
                                'label' => $item['nombre'],
                            );
        }
        
        if ( isset($options) ){
            
            $clControl = new inputSelect('lsSemestre');
            $html = $clControl->draw($options);
        }
    return $html;
    }
}
