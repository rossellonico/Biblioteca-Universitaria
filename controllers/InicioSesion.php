<?php

// biblioteca/InicioSesion.php

require '../fw/fw.php';
require '../views/InicioSesion.php';
require '../models/Socios.php';

session_start();

if(count($_POST)>= 1 ){

    if (!isset ($_POST['email'])) die ("error 1");
    if (!isset ($_POST['clave'])) die ("error 2");
    

    $s = new Socios();
    $numero_socio = $s->ValidarSocio($_POST['email'],$_POST['clave']);
    
    if($numero_socio){
        $_SESSION['logueado']=true;
        $_SESSION['numero_usuario']= $numero_socio;
        $_SESSION['tipo_usuario']= $s->TipoUsuario($numero_socio);
        header ("location: ../GestionBiblioteca/Buscador");
        exit;
    }
    else
    {
        $noLogueado=TRUE;
        $v = new InicioSesion();
        $v->NoLogueado = $noLogueado; 
        $v->render(); 
    }   
}
if(count($_SESSION)==0 and count ($_POST) < 1){

    $v = new InicioSesion();
    $v->render(); 
}

if(count($_SESSION)>0){
    header ("location: ../GestionBiblioteca/Buscador");
    exit;
}