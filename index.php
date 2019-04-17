<?php
require_once 'class/usuario.class.php';
require_once 'class/sysInterfaz.class.php';


session_start();


if (empty($_SESSION)){
    header('Location: login.php');
}

$usuario = new usuario();
$usuario->getData($_SESSION['usuario']);

print "El usuario: {$usuario->nombreCompleto} tiene acceso a los siguientes módulos:".PHP_EOL;
$data = $usuario->getListModulos();
$interfaces = array();

foreach ($data as $item){
    $interfaces[] = new sysInterfaz($item->modulo, $item->interfaz);
    
}

$html = '';
$html .= '<list>';
foreach ($interfaces as $item){
    $html .= "<ul>{$item->nombreModulo}<a href=\"view/{$item->file}\"> {$item->nombreInterfaz} </ul>";
    
}
$html .= '</list>';
print $html;
