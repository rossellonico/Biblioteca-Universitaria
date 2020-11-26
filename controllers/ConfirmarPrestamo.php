<?php

//controllers/ConfirmarPrestamo.php

require '../fw/fw.php';
require '../views/ConfirmarPrestamo.php';
require '../views/PrestamoConfirmado.php';
require '../models/Libros.php';

session_start ();
if (!isset ($_SESSION['logueado'])){
	header ("location: ../GestionBiblioteca/InicioSesion");
    exit;
}

if(count($_POST)>0){


    
    /* INICIO QUITAR LIBROS DE PRESTAMOS */
    if (isset ($_POST['Quitar'])){
        
        /* 1) Sacar libros */
        $pedido='Pedido';
        foreach ($_SESSION as $numero_pedido => $numero_ejemplar){
            foreach ($_POST as $key => $numero_ejemplar_quitado){
                if ( (substr ($numero_pedido, 0,6) == $pedido) and $numero_ejemplar == $numero_ejemplar_quitado)
                    unset ($_SESSION[$numero_pedido]);
            }
        }
        /* Mostrar pantalla */
        $l= new Libros;
        $pedido='Pedido';
        $prestamos= array();
        $contador = 0;
        foreach ($_SESSION as $campo => $valor){
            if (substr ($campo, 0,6) == $pedido){
                $contador= $contador + 1;
                $prestamos [$contador] = $l->buscarPornumero_libro ($valor);
            }
        }
        $v = new ConfirmarPrestamo();
        $v->Prestamo = $prestamos; 
        $v ->render ();		
    } /*FIN QUITAR LIBROS PRESTAMOS

    /* CONFIRMAR PRESTAMO SI ES POSIBLE */
    else{
        $l= new Libros;
        /* 1) Busqueda de ejemplares para libros solicitados*/
        $pedido='Pedido';
        $ejemplares= array();
        $librosEjemplaresPrestados=array();
        $contador = 0;
        $contadorEjemplaresPrestados=0;
        $avisoPrestados= FALSE;
        foreach ($_SESSION as $campo => $valor){
            if (substr ($campo, 0,6) == $pedido){
                $contador = $contador + 1;
                $ejemplares [$contador] = $l-> buscarEjemplaresLibros($valor);
                if (is_null($ejemplares[$contador])){
                    $avisoPrestados= TRUE;
                    $contadorEjemplaresPrestados= $contadorEjemplaresPrestados + 1;
                    $librosEjemplaresPrestados[$contadorEjemplaresPrestados] = $valor;
                }
            }
        }
       // var_dump ($ejemplares);
       // echo '<br/>';
       // var_dump ($librosEjemplaresPrestados);
        $datosLibroEjemplaresPrestados = array();
        $contador = 0;
        
        /* 1.a) Si hay ejemplares pedidos que estan prestados no hago prestamo y muestro cuales son */
        if ($avisoPrestados){
            foreach ($librosEjemplaresPrestados as $campo => $valor){
               // $contador = $contador + 1;
                $datosLibroEjemplaresPrestados[$campo] = $l->buscarPornumero_libro ($valor);
            }

            $prestamos= array();
            $contador = 0;
            foreach ($_SESSION as $campo => $valor){
                if (substr ($campo, 0,6) == $pedido){
                    $contador= $contador + 1;
                    $prestamos [$contador] = $l->buscarPornumero_libro ($valor);
                }
            }

            $v = new ConfirmarPrestamo();
            $v->DatosLibrosEjemplaresPrestados = $datosLibroEjemplaresPrestados;
            $v->Prestamo = $prestamos; 
            $v ->render ();	

        }/* Fin 1.a)*/

        /* 2) Si estoy aca es porque ninguno de los ejemplares esta prestado 
            Controlar si usuario no excede limites de ejemplares a prestar */
        else{    
            //$tipo_usuario = $_SESSION['tipo_usuario'];
            //$numero_socio = $_SESSION['numero_usuario'];
            
            /* 2.a) Cantidad de ejemplares prestados */
            $cantidadEjemplaresPrestados = $l-> cantidadEjemplaresPrestados ($_SESSION['numero_usuario']); 
            //echo '<br/>Cantidad de ejemplares prestados = '.$cantidadEjemplaresPrestados;
            
            /* 2.b) Cantidad de ejemplares permitidos */
            $cantidadEjemplaresPermitidos = $l-> cantidadEjemplaresPermitidos ($_SESSION['tipo_usuario']);
            
            //echo '<br/>Cantidad de ejemplares permitidos = '.$cantidadEjemplaresPermitidos['cantidad_libros'];

            /* 2.c) Calcular cantidad de ejemplares disponibles para prestamo */
            $cantidadEjemplaresParaPrestamo = $cantidadEjemplaresPermitidos['cantidad_libros'] -  $cantidadEjemplaresPrestados;
            //echo '<br/>Cantidad de ejemplares permitidos = '.$cantidadEjemplaresParaPrestamo;

            /* 2.d) Controlo que la cantidad de libros pedida sea <= a la cantidad de ejemplares disponibles para prestamo para ese usuario*/
            $contador = 0;
            foreach ($ejemplares as $campo => $numero_ejemplar){
                if ($numero_ejemplar != NULL ){
                    $contador = $contador + 1;
                }
            }
            /* ACA ESTA TODO BIEN. CARGO EL PRESTAMO Y LOS EJEMPLARES */
            if ($contador <= $cantidadEjemplaresParaPrestamo){
                $numero_prestamo = $l->cargarPrestamo ($_SESSION['numero_usuario']);
                
                foreach ($ejemplares as $campo => $valor){
                    $l->cargarPrestamoEjemplar ($numero_prestamo['numero_prestamo'], $ejemplares[$campo]['numero_ejemplar'] );
                }
                $pedido='Pedido';
                foreach ($_SESSION as $clave => $valor){
                    if (substr ($clave, 0,6) == $pedido){
                        unset ($_SESSION[$clave]);
                    }
                }
                $datosEjemplares=array ();
                foreach ($ejemplares as $campo => $valor){
                    $datosEjemplares [$campo]= $l-> datosejemplar ($ejemplares[$campo]['numero_ejemplar']);
                }

                $v = new PrestamoConfirmado();
                $v->Datos_Ejemplares = $datosEjemplares;
                $v->Numero_Prestamo = $numero_prestamo; 
                $v->Ejemplares = $ejemplares; 
                $v ->render ();
                
            }
            else{
                echo 'Prestamo No habilidado. La cantidad de ejemplares solicitados en mayor a la que le corresponde. Retire algunos de los ejemplares';
                $l= new Libros;
                $pedido='Pedido';
                $prestamos= array();
                $contador = 0;
                foreach ($_SESSION as $campo => $valor){
                    if (substr ($campo, 0,6) == $pedido){
                        $contador= $contador + 1;
                        $prestamos [$contador] = $l->buscarPornumero_libro ($valor);
                    }
                }
                $avisoPrestados= FALSE;
                $v = new ConfirmarPrestamo();
                $v->AvisoPrestado = $avisoPrestados;
                $v->Prestamo = $prestamos; 
                $v ->render ();	
            }



        }

            
    }
}            
else{
    /* PRIMERA CARGA DE LA PAGINA SIN POSTS*/
    $l= new Libros;
    $pedido='Pedido';
    $prestamos= array();
    $contador = 0;
    $noHayPedidos=FALSE;
    foreach ($_SESSION as $campo => $valor){
        if (substr ($campo, 0,6) == $pedido){
            $contador= $contador + 1;
            $prestamos [$contador] = $l->buscarPornumero_libro ($valor);
            
        }
    }
    if (empty ($prestamos))
        $noHayPedidos=TRUE;
    $avisoPrestados= FALSE;
    $v = new ConfirmarPrestamo();
    $v->AvisoPrestado = $avisoPrestados;
    $v->Prestamo = $prestamos; 

    $v ->render ();		

}

                