<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link type="text/css" href="../html/style/navbar.css" rel="stylesheet"/>
    <link type="text/css" href="../html/style/estilo.css" rel="stylesheet"/>
  	<title>Biblioteca</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="topnav mb-3" id="nav"> <!-- NAVBAR NUEVO OPERADOR -->

    <?php if($controlador == "Buscador") {?>
        <a class="active" href="../GestionBiblioteca/Buscador">Buscar libros</a>
        <a href="../GestionBiblioteca/ConfirmarPrestamo">Quitar libros solicitados o confirmar prestamo</a>
        <a href="../GestionBiblioteca/Devoluciones">Devoluciones</a>
        <a href="../GestionBiblioteca/CerrarSesion" style="float: right;">Cerrar Sesion</a>
    <?php } ?>

    <?php if($controlador == "MostrarTitulos") {?>
        <a class="active" href="../GestionBiblioteca/Buscador">Buscar libros</a>
        <a href="../GestionBiblioteca/ConfirmarPrestamo">Quitar libros solicitados o confirmar prestamo</a>
        <a href="../GestionBiblioteca/Devoluciones">Devoluciones</a>
        <a href="../GestionBiblioteca/CerrarSesion" style="float: right;">Cerrar Sesion</a>
    <?php } ?>

    <?php if($controlador == "ConfirmarPrestamo") {?>
        <a href="../GestionBiblioteca/Buscador">Buscar libros</a>
        <a class="active" href="../GestionBiblioteca/ConfirmarPrestamo">Quitar libros solicitados o confirmar prestamo</a>
        <a href="../GestionBiblioteca/Devoluciones">Devoluciones</a>
        <a href="../GestionBiblioteca/CerrarSesion" style="float: right;">Cerrar Sesion</a>
    <?php } ?>

    <?php if($controlador == "PrestamoConfirmado") {?>
        <a href="../GestionBiblioteca/Buscador">Buscar libros</a>
        <a class="active" href="../GestionBiblioteca/ConfirmarPrestamo">Quitar libros solicitados o confirmar prestamo</a>
        <a href="../GestionBiblioteca/Devoluciones">Devoluciones</a>
        <a href="../GestionBiblioteca/CerrarSesion" style="float: right;">Cerrar Sesion</a>
    <?php } ?>

    <?php if($controlador == "Devoluciones") {?>
        <a href="../GestionBiblioteca/Buscador">Buscar libros</a>
        <a href="../GestionBiblioteca/ConfirmarPrestamo">Quitar libros solicitados o confirmar prestamo</a>
        <a class="active" href="../GestionBiblioteca/Devoluciones">Devoluciones</a>
        <a href="../GestionBiblioteca/CerrarSesion" style="float: right;">Cerrar Sesion</a>
    <?php } ?>