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

function alerta($msm)
{
    echo "<div class=\"alert alert-danger\" role=\"alert\">";
    echo "<h4 class=\"alert-heading\">Algo salio mal!</h4>";
    echo "<p>{$msm}, Recargue la pagina</p></div>";
    exit();
}

?>