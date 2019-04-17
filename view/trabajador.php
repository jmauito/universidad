<?php
require_once 'vistaTrabajador.php';

session_start();
if ( empty($_SESSION) ){
    header('Location:login.php');
}

$int = new vistaTrabajador();
    $int->modulo = '1';
    $int->interfaz = '2';
    $int->getPermisosUsuario($_SESSION['usuario']);
    $int->javaScriptList = 'lista';
    $int->javaScriptFile = 'trabajador';
    $int->pageTitle = 'Trabajador';
    $int->pageFooter = 'Sistema de Pruebas';
    $int->title = 'Buscar trabajador';
    $int->file = '../template/template.html';

    $int->inputSearch = $int->drawSearch();
    
$int->drawHTML();
