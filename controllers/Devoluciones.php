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
    //var_dump ($librosDevueltos);

    foreach ($librosDevueltos as $campo => $valor){
        if ($librosDevueltos[$campo]['dias_vencido'] <= 0)
            $librosDevueltos[$campo]['multa']=0;
        else
            $librosDevueltos[$campo]['multa']= $librosDevueltos[$campo]['dias_vencido']* 10;
        $l->devolverEjemplares ($librosDevueltos[$campo]['numero_prestamo'], $librosDevueltos[$campo]['numero_ejemplar'], $librosDevueltos[$campo]['multa']);
    }
    $v = new DevolucionRealizada();
    $v->LibrosDevueltos = $librosDevueltos;
    $v ->render ();				

}
else{
    $l= new Libros;
    $librosPrestados= array();
    $librosPrestados = $l->buscarlibrosprestado ($_SESSION['numero_usuario']);
    $v = new DevolucionPedida();
    $v->LibrosPrestados = $librosPrestados;
    $v ->render ();				
}