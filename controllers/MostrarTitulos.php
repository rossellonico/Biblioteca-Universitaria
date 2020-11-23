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

        /*
        foreach ($_POST as $campo => $valor){
            echo '<br/>Estamos en el $_POST. Este es el campo: '.$campo.' Este el valor: '.$valor;
        }
        */
        $l= new Libros;
        $pedido='Pedido';
        //Aca tengo un contador de $_SESSION['Pedidon]
        foreach ($_SESSION as $campo => $valor){
            $contador=0;
            if (substr ($campo, 0,6) == $pedido){
                $contador = (int) substr ($campo,6,2);
             // echo "imprimite algo".$contador."<br/>";
            }
        }
        /* Carga de libros en variables de Session */
        /*Primero controlamos que no cargue mas de lo que le corresponde */
        /*$contadorPost=0; //Empiezo en 1 porque ya esta el Post del submit
        foreach($_POST as $campo => $valor){
            $contador = $contador +1;
        }*/
        $contadorPost= count($_POST) - 1; //Empiezo en 1 porque ya esta el Post del submit
        //echo '<br/>Cantidad de ejemplares pedidos Post = '.$contadorPost;

        $contadorSession=0;
        foreach($_SESSION as $campo => $valor){
            if (substr ($campo, 0,6) == $pedido){
                $contadorSession = $contadorSession +1;
            }
        }
        //echo '<br/>Cantidad de ejemplares en Session = '.$contadorSession;

        //$tipo_usuario = $_SESSION['tipo_usuario'];
        //$numero_socio = $_SESSION['numero_usuario'];
        
        /* 2.a) Cantidad de ejemplares prestados */
        $cantidadEjemplaresPrestados = $l-> cantidadEjemplaresPrestados ($_SESSION['numero_usuario']); 
        //echo '<br/>Cantidad de ejemplares prestados = '.$cantidadEjemplaresPrestados;
        
        /* 2.b) Cantidad de ejemplares permitidos */
        $cantidadEjemplaresPermitidos = $l-> cantidadEjemplaresPermitidos ($_SESSION['tipo_usuario']);
        //echo '<br/>Cantidad de ejemplares permitidos por tipo usuario = '.$cantidadEjemplaresPermitidos['cantidad_libros'];

        /* 2.c) Calcular cantidad de ejemplares disponibles para prestamo */
        $cantidadEjemplaresParaPrestamo = $cantidadEjemplaresPermitidos['cantidad_libros'] -  $cantidadEjemplaresPrestados;
        //echo '<br/>Cantidad de ejemplares segun tipo de usuario y prestamos existentes = '.$cantidadEjemplaresParaPrestamo;

        /* 2.d) Controlo que no haya libros repetidos*/
        $repetidos=FALSE;
        foreach ($_POST as $campop => $valorp){
            foreach ($_SESSION as $campos => $valors){ 
                if (substr ($campos, 0,6) == $pedido and $valorp == $valors  ){
                    $repetidos= TRUE;
                    //echo '<br/>Repetido. El valorp es: '.$valorp.' El valors es: '.$valors;
                    
                }
            }
        }
        
        /* 2.e) Controlo que la cantidad de libros pedida sea <= a la cantidad de ejemplares disponibles para prestamo para ese usuario y que no haya repetidos*/
        if (  ($contadorPost + $contadorSession <= $cantidadEjemplaresParaPrestamo)  and ($repetidos==FALSE) ){
            //echo '<br/>Prestamo habilidado<br/>';
            
            $confirmarPrestamo = TRUE;    
            foreach($_POST as $campo => $valor){
                $contador = $contador +1;
                if (substr ($campo, 0,6) == $pedido){
                    $_SESSION['Pedido'.$contador] = $valor;
                    //echo "<br/>Esta linea imprime el campo del Post y su Valor: ". $campo ." = ". $valor."<br/>";
                }
            }
                
        }
        else{
            //echo '<br/>Su gestion no fue realizada. Usted solicito una cantidad de libros mayor a la que tiene permitida<br/>';
            $confirmarPrestamo = FALSE;

        }
        
        foreach($_SESSION as $campo => $valor){
            //echo "<br/>Esta linea imprime el campo de SESSION y su valor: ". $campo ." = ". $valor."<br/>";
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