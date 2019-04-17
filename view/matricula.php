<?php
require_once 'vistaMatricula.php';

session_start();
if ( empty($_SESSION) ){
    header('Location:../login.php');
}

$int = new vistaMatricula();
    $int->modulo = '2';
    $int->interfaz = '2';
    $int->getPermisosUsuario($_SESSION['usuario']);
    $int->javaScriptList = 'lista';
    $int->javaScriptFile = 'matricula';
    $int->pageTitle = 'Matr&iacute;cula';
    $int->pageFooter = 'Sistema de Pruebas';
    $int->title = 'Buscar alumno';
    $int->file = '../template/template.html';

    $int->inputSearch = $int->drawSearch();
    
$int->drawHTML();
