<?php
if (isset($_POST["nombres"]) && isset($_POST["apellidos"]) && isset($_POST["placa"]) && isset($_POST["color"]) && isset($_FILES["foto"])) {

    include 'funServ.php';

    function isOtherCol(){
        if ($_POST["color"] == 12) {
            if ($_POST["color-otro"]) {
                if ($_POST["color-otro"] == "") {
                    alerta("Espesificar otro color");
                }
            } else {
                alerta("Espesificar otro color");
            }
            return true;
        } else if ($_POST["color"] == "Color...") {
            alerta("Seleccione un color");
        } else {
            return false;
        }
    }

    function valImg(){
        $tipo = $_FILES["foto"]["type"];
        if (!(strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png"))) {
            alerta("Formato de la imagen incorrecto, {$tipo} no permitido");
        } elseif ($_FILES["foto"]["size"] > 6000000) {
            alerta("Tamano mayor a 600kb no permitido");
        }
    }

    function valPlaca(){
        $placa_val = strtoupper($_POST["placa"]);
        if (!(preg_match("/[A-Z]{3}\-[0-9]{2}([0-9]|[A-Z])$/", $placa_val) == 1)) {
            alerta("Formato de placa incorrecto");
        }
    }

    function validarRq(){
        valImg();
        valPlaca();
    }

    function endReg($nom, $ape, $col, $pla, $fec, $fot){
        //echo ("<script> document.getElementById(\"formulario\").innerHTML = \"\";</script>");
        $col = getColor($col);
        echo ("<br><div class=\"alert alert-success\" role=\"alert\">
                <h4 class=\"alert-heading\">Registro Completo!</h4></div>");
        echo ("<div class=\"row caja-item\">
                <div class=\"col-md-auto\">
                <img class=\"lista-img\" src=\"{$fot}\" alt=\"foto perdida\"></div>
                <div class=\"col\">
                <span class=\"card-subtitle mb-2 text-muted sb-pd blanka\">Propietario</span>
                <p>Nombre: {$nom} {$ape}</p>
                <span class=\"card-subtitle mb-2 text-muted sb-pd blanka\">Vehiculo</span>
                <p>Placa: {$pla}</p>
                <p>Color: {$col}</p>
                <p>Fecha de ingreso: {$fec}</p></div></div>");
    }


    validarRq();

    $conexion = new mysqli('localhost', 'root', 'root', 'parqueaderoBD');
    if ($conexion->connect_errno) {
        alerta("No se pudo conectar con el servidor: " . $conexion->connect_error);
    }

    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $placa = strtoupper($_POST["placa"]);
    $fecha_ingreso = date("M / d / Y  h:i A");
    $des_img = "fotosBD/foto{$placa}_" . date("M-d-Y-h:iA");
    $tmp_img = $_FILES["foto"]["tmp_name"];
    if (!copy($tmp_img, "../{$des_img}")){alerta("No se pudo subir la imagen");}
    if (!isOtherCol()) {
        $color = $_POST["color"];
        $sql = "INSERT INTO tikets(propietario_nom, propietario_ape, vehiculo_color, vehiculo_placa, fecha_ingreso, vehiculo_foto)
        VALUES(?, ?, ?, ?, ?, ?)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("ssisss", $nombres, $apellidos, $color, $placa, $fecha_ingreso, $des_img);
    } else {
        $color = $_POST["color"];
        $otro_color = $_POST["color-otro"];
        $sql = "INSERT INTO tikets(propietario_nom, propietario_ape, vehiculo_color, vehiculo_color_otro, vehiculo_placa, fecha_ingreso, vehiculo_foto)
                VALUES(?, ?, ?, ?, ?, ?, ?)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bind_param("ssissss", $nombres, $apellidos, $color, $otro_color, $placa, $fecha_ingreso, $des_img);
    }

    if(!$sentencia->execute()){
        alerta("no se pudo guardar los datos " . $conexion->error);
    }
    $conexion->close();
    if (!isOtherCol()){
        endReg($nombres, $apellidos, $color, $placa, $fecha_ingreso, $des_img);
    }else{
        endReg($nombres, $apellidos, $otro_color, $placa, $fecha_ingreso, $des_img);
    }
    
} else {

    echo "no llegaron los datos";
    echo print_r($_POST) . "\n";
    echo "archivo :" . print_r($_FILES);
}
?>