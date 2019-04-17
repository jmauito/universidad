<?php
require_once 'vistaSede.php';

session_start();
if ( empty($_SESSION) ){
    header('Location:login.php');
}

$int = new vistaSede();
    $int->modulo = '1';
    $int->interfaz = '3';
    $int->getPermisosUsuario($_SESSION['usuario']);
    $int->javaScriptList = 'lista';
    $int->javaScriptFile = 'sede';
    $int->pageTitle = 'Sede';
    $int->pageFooter = 'Sistema de Pruebas';
    $int->title = 'Buscar sede';
    $int->file = '../template/template.html';

    $int->inputSearch = $int->drawSearch();
    
$int->drawHTML();


