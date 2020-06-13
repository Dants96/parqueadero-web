<?php
function getColor($nCol)
{
    switch ($nCol) {
        case "0":
            return "Blanco";
        case 1:
            return "Negro";
        case 3:
            return "Gris";
        case 4:
            return "Plata";
        case 5:
            return "Rojo";
        case 6:
            return "Azul";
        case 7:
            return "Café";
        case 8:
            return "Beige";
        case 9:
            return "Verde";
        case 10:
            return "Anaranjado";
        case 11:
            return "Amarillo";
        default:
            return $nCol;
    }
}

if ($file = fopen("../database/Registro_Ajax.txt", "r")) {
    $out_array = [];
    while ($line = fgets($file)) {
        $aux = "";
        $cont = 0;
        for ($i = 0; $i < strlen($line); $i++) {
            if ($line[$i] != ",") {
                $aux = $aux . "" . $line[$i];
            } else {
                if ($cont == 3) {
                    if ($aux == 12) {
                        $aux = "";
                    } else {
                        $aux = getColor($aux);
                        $out_array[$cont] = $aux;
                        $cont++;
                        $aux = "";
                    }
                } else {
                    $out_array[$cont] = $aux;
                    $cont++;
                    $aux = "";
                }
            }
        }
        echo ("<div class=\"row caja-item\">
                        <div class=\"col-md-auto\">
                        <img class=\"lista-img\" src=\"../Fotos_subidas_ajax/{$out_array[5]}\"></div>
                        <div class=\"col\">
                        <span class=\"card-subtitle mb-2 text-muted sb-pd blanka\">Propietario</span>");
        $aux = $out_array[0] . " " . $out_array[1];
        echo ("<p>Nombre: {$aux}</p>
                        <span class=\"card-subtitle mb-2 text-muted sb-pd blanka\">Vehiculo</span>
                        <p>Placa: {$out_array[2]}</p>
                        <p>Color: {$out_array[3]}</p>
                        <p>Fecha de ingreso: {$out_array[4]}</p></div></div>");
    }
    fclose($file);
} else {
    echo ("<div class=\"alert alert-danger\" role=\"alert\">
                        <h4 class=\"alert-heading\">Algo salio mal!</h4>
                        <p>No se puede mostrar los vehiculos registrados</p></div>");
}
 
?>