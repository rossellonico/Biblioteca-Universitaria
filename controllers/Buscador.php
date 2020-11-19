<?php
//controllers/Buscador.php

require '../fw/fw.php';
require '../views/Buscador.php';
require '../views/MostrarTitulos.php';
require '../models/Libros.php';

session_start ();
if (!isset ($_SESSION['logueado'])){
	header ("location:../GestionBiblioteca/InicioSesion");
	exit;
}
if(count($_POST)>0){

	if (!isset ($_POST['titulo1'])) die ("error 5");
	if (!isset ($_POST['autor1'])) die ("error 6");

	$_SESSION['titulo1'] = $_POST['titulo1'];
	$_SESSION['autor1'] = $_POST['autor1'];

	header ("location: ../GestionBiblioteca/MostrarTitulos");
	exit;

}
else{
	
	$v = new Buscador ();
	$v -> render ();
}