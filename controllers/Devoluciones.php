<?php

require '../fw/fw.php';
require '../views/DevolucionRealizada.php';
require '../views/DevolucionPedida.php';
require '../models/Libros.php';

session_start ();
if (!isset ($_SESSION['logueado'])){
	header ("location:../GestionBiblioteca/InicioSesion");
	exit;
}

if(count($_POST)>0){

    /* Si pulso: "Devolver libros marcados"*/
    $l= new Libros;
    $librosPrestados= array();
    $librosPrestados = $l->buscarlibrosprestado ($_SESSION['numero_usuario']);

    $contador=0;
    $librosDevueltos = array();
    foreach ($_POST as $campop => $valorp){
        foreach ($librosPrestados as $campov => $valorv)
            if ($librosPrestados [$campov]['numero_ejemplar'] == $valorp ){
                $contador= $contador + 1;
                $librosDevueltos [$contador] = $librosPrestados [$campov];
            }
    }

    foreach ($librosDevueltos as $campo => $valor){
        if ($librosDevueltos[$campo]['dias_vencido'] <= 0)
            $librosDevueltos[$campo]['multa']=0;
        else
            $librosDevueltos[$campo]['multa']= $librosDevueltos[$campo]['dias_vencido']* 10;
        $l->devolverEjemplares ($librosDevueltos[$campo]['numero_prestamo'], $librosDevueltos[$campo]['numero_ejemplar'], $librosDevueltos[$campo]['multa']);
    }
    /* Si pulsó:"Devolver libros marcados", pero no marco ninguno"*/
    if (empty ($librosDevueltos)){
        $v = new DevolucionPedida();
        $seleccionaEjemplaresDevolucion = FALSE;
        $v->SeleccionaEjemplaresDevolucion = $seleccionaEjemplaresDevolucion;
        $v->LibrosPrestados = $librosPrestados;
        $v ->render ();				
    }
    /* Si efectivamente devolvio libros*/
    else{
    $v = new DevolucionRealizada();
    $v->LibrosDevueltos = $librosDevueltos;
    $v ->render ();				
    }
}
else{ //Primer ingreso a al página
    $l= new Libros;
    $seleccionaEjemplaresDevolucion = TRUE;
    $librosPrestados= array();
    $librosPrestados = $l->buscarlibrosprestado ($_SESSION['numero_usuario']);
    $v = new DevolucionPedida();
    $v->SeleccionaEjemplaresDevolucion = $seleccionaEjemplaresDevolucion;
    $v->LibrosPrestados = $librosPrestados;
    $v ->render ();				
}