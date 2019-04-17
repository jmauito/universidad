<?php
/**
 * Description of vistaCarrera
 *
 * @author mauito
 */
require_once '../class/carrera.class.php';
require_once '../class/sysControls.class.php';
require_once '../class/sysVista.class.php';

class vistaCarrera extends vista {
    //put your code here
    public function drawSelect(){
        $clCarrera = new carrera();
        $data = $clCarrera->getList();
        
        $options = array();
        
        foreach ($data as $item){
            $options[] = array( 'value' => $item['carrera'],
                                'selected'=> '0',
                                'label' => $item['nombre'],
                            );
        }
        
        if ( isset($options) ){
            
            $clControl = new inputSelect('lsCarrera');
            $html = $clControl->draw($options);
        }
    return $html;
    }
}

