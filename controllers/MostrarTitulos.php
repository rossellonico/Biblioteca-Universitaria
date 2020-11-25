<?php

require '../fw/fw.php';
require '../views/MostrarTitulos.php';
require '../models/Libros.php';

session_start ();
if (!isset ($_SESSION['logueado'])){
	header ("location: ../GestionBiblioteca/InicioSesion");
	exit;
}

if(count($_POST)>0){

    /* SI APRETA AGREGAR LIBRO*/
    if (isset ($_POST ['Solicita'])){

        $l= new Libros;
        $pedido='Pedido';
        
        
        /* Cuento cuantos pedidos se hicieron en este post*/ 
        $contadorPost= count($_POST) - 1; //Empiezo en 1 porque ya esta el Post del submit
        
        /*Pongo en $contadorSession la cantidad de libros que ya fueron pedidos*/
        $contadorSession=0;
        foreach($_SESSION as $campo => $valor){
            if (substr ($campo, 0,6) == $pedido){
                $contadorSession = $contadorSession +1;
            }
        }
        
        /* 2.a) Cantidad de ejemplares prestados al usuario */
        $cantidadEjemplaresPrestados = $l-> cantidadEjemplaresPrestados ($_SESSION['numero_usuario']); 
        
        /* 2.b) Cantidad de ejemplares permitidos al usuario */
        $cantidadEjemplaresPermitidos = $l-> cantidadEjemplaresPermitidos ($_SESSION['tipo_usuario']);
        
        /* 2.c) Calcular cantidad de ejemplares disponibles para prestamo al usuario*/
        $cantidadEjemplaresParaPrestamo = $cantidadEjemplaresPermitidos['cantidad_libros'] -  $cantidadEjemplaresPrestados;
        
        /* 2.d) Controlo que no haya libros repetidos*/
        $repetidos=FALSE;
        foreach ($_POST as $campop => $valorp){
            foreach ($_SESSION as $campos => $valors){ 
                if (substr ($campos, 0,6) == $pedido and $valorp == $valors  ){
                    $repetidos= TRUE;
                }
            }
        }
        
        /* 2.e) Controlo que la cantidad de libros pedida sea <= a la cantidad de ejemplares disponibles para prestamo para ese usuario y que no haya repetidos*/
        if (  ($contadorPost + $contadorSession <= $cantidadEjemplaresParaPrestamo)  and ($repetidos==FALSE) ){
            $confirmarPrestamo = TRUE;    
            foreach($_POST as $campo => $valor){
                $contadorSession = $contadorSession +1;
                if (substr ($campo, 0,6) == $pedido){
                    $_SESSION['Pedido'.$contadorSession] = $valor;
                }
            }
                
        }
        else{
            $confirmarPrestamo = FALSE;

        }
        
        
        $datolibro = $l->buscarPorTituloAutor ($_SESSION['titulo1'], $_SESSION['autor1'] );
        $sinTituloAutor=FALSE;
        $noHayCoincidencia = FALSE;
        $v = new MostrarTitulos();
        $v->SinTituloAutor = $sinTituloAutor;
        $v->NoHayCoincidencia = $noHayCoincidencia;
        $v->Repetidos= $repetidos;
        $v->Confirmar = $confirmarPrestamo;
        $v->Libro = $datolibro;
        //$sumador=0;
        $v ->render ();
    }
    /* SI APRETA EL BOTON DE BUSCAR */
    if (isset ($_POST['Buscar'])){
       
        $_SESSION['titulo1'] = $_POST['titulo1'];
        $_SESSION['autor1'] = $_POST['autor1'];
        
        $l= new Libros;

        $sinTituloAutor=FALSE;
        $noHayCoincidencia = FALSE;
        $v = new MostrarTitulos();
        
        if (empty ($_SESSION['titulo1']) and empty ($_SESSION['autor1'])){
            $sinTituloAutor=TRUE;        
            $v->SinTituloAutor = $sinTituloAutor;
        }
        else{
            $datolibro = $l->buscarPorTituloAutor ($_SESSION['titulo1'], $_SESSION['autor1'] );  
            if (empty($datolibro))
                $noHayCoincidencia = TRUE;
            $v->Libro = $datolibro;
        }
        
        $v->NoHayCoincidencia = $noHayCoincidencia;
        $v->Confirmar = TRUE;
        //$sumador=0;
        $v ->render ();				
    }
}
else{
    /*Primera aparicion sin posts*/
    $l= new Libros;
    $sinTituloAutor=FALSE;
    $noHayCoincidencia = FALSE;
    $v = new MostrarTitulos();
    if (empty ($_SESSION['titulo1']) and empty ($_SESSION['autor1'])){
        $sinTituloAutor=TRUE;        
        $v->SinTituloAutor = $sinTituloAutor;
    }
    else{
        $datolibro = $l->buscarPorTituloAutor ($_SESSION['titulo1'], $_SESSION['autor1'] );    
        if (empty($datolibro))
            $noHayCoincidencia = TRUE;
        $v->Libro = $datolibro;
    }
    
    $v->NoHayCoincidencia = $noHayCoincidencia;
    $v->Confirmar = TRUE;
    $v ->render ();				
}