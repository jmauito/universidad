<?php
require_once 'class/sysVista.class.php';
require_once 'class/usuario.class.php';



function drawLogin(){
    $clVista = new vista();
    $clVista->title = 'Ingreso al sistema';
    $clVista->file = 'login.html';
    $clVista->pageFooter = 'Sistema de Prueba';
    $clVista->pageTitle = 'SISTEMA DE PRUEBAS';
    
    $content = '';
    $content .= $clVista->head('Ingreso al sistema');
    $content .= "<form id=\"frmlogin\" name=\"frmlogin\" method=\"post\">";
    $content .= $clVista->label('Usuario');
    $content .= "<input type=\"text\" id=\"txtUsuario\" name=\"txtUsuario\" placeholder=\"Ingrese el usuario\" required><br>";
    $content .= $clVista->label('Contraseña');
    $content .= "<input type=\"password\" id=\"txtPassword\" name=\"txtPassword\" placeholder=\"Contraseña\" required><br>"
        . "<input type=\"submit\" id=\"btnAceptar\" name=\"btnAceptar\" value=\"Aceptar\">";
    $content .= "</form>";
    
    $clVista->content = $content;
    $clVista->drawHTML();
}

session_start();
if ( empty($_POST) ){
    print drawLogin();
}else{
    $usuario = filter_input(INPUT_POST, 'txtUsuario',FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'txtPassword', FILTER_SANITIZE_SPECIAL_CHARS);
    $cl = new usuario();
    if ( !$cl->verificarUsuarioPassword($usuario,$password) ){
        print "<script>alert('Usuario o Contraseña no válidos')</script>";
        session_destroy();
        print drawLogin();
    }else{
        if ( $cl->getData($usuario) ){
            
            $_SESSION['usuario'] = $cl->usuario;
            $_SESSION['nombreCompleto'] = $cl->nombreCompleto;
            
        }
        header('Location: index.php');    
    }
    
}




