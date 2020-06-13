<?php
include'funServ.php';

function compOUT($nom, $ape, $col, $pla, $fec, $fot){
    $col = getColor($col);
    $Echoout = ("<div class=\"row caja-item\">
                        <div class=\"col-md-auto\">
                        <img class=\"lista-img\" src=\"{$fot}\" alt=\"foto perdida\"></div>
                        <div class=\"col\">
                        <span class=\"card-subtitle mb-2 text-muted sb-pd blanka\">Propietario</span>
                        <p>Nombre: {$nom} {$ape}</p>
                        <span class=\"card-subtitle mb-2 text-muted sb-pd blanka\">Vehiculo</span>
                        <p>Placa: {$pla}</p>
                        <p>Color: {$col}</p>
                        <p>Fecha de ingreso: {$fec}</p></div></div>");
    return $Echoout;
}

$conexion = new mysqli('localhost', 'root', 'root', 'parqueaderoBD');
if ($conexion->connect_errno) {
    alerta("No se pudo conectar con el servidor: " . $conexion->connect_error);
}
$sql = "SELECT propietario_nom, propietario_ape, vehiculo_color, vehiculo_color_otro, vehiculo_placa, fecha_ingreso, vehiculo_foto FROM tikets ";

if($result = $conexion->query($sql)){
    while($row = $result->fetch_row()){
        if($row[2] == 12){
            echo(compOUT($row[0], $row[1], $row[3], $row[4], $row[5], $row[6]));
        }else{
            echo (compOUT($row[0], $row[1], $row[2], $row[4], $row[5], $row[6]));
        }
    }
    $result->close();
}
$conexion->close();

?>
