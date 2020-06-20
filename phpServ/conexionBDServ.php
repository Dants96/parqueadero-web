<?php
    include 'funServ.php';

    $conexion = new mysqli('localhost', 'root', 'root', 'parqueaderoBD');
    if ($conexion->connect_errno) {
        alerta("No se pudo conectar con el servidor: " . $conexion->connect_error);
    }

?>