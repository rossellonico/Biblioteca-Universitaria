<?php

// biblioteca/CerrarSesion.php

require '../fw/fw.php';
require '../views/InicioSesion.php';

session_start();

foreach ($_SESSION as $campo => $valor){
    unset($_SESSION[$campo]);
}
header("Location: ../GestionBiblioteca/InicioSesion");
exit;