<?php
if (isset($_POST["nombres"]) && isset($_POST["apellidos"]) && isset($_POST["placa"]) && isset($_POST["color"]) && isset($_FILES["foto"])) { 

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

    function alerta($msm) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
        echo "<h4 class=\"alert-heading\">Algo salio mal!</h4>";
        echo "<p>{$msm}, Intente de nuevo</p></div>";
        exit();
    }

    function valImg() {
        $tipo = $_FILES["foto"]["type"];
        if (!(strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png"))) {
            alerta("Formato de la imagen incorrecto, {$tipo} no permitido");
        } elseif ($_FILES["foto"]["size"] > 6000000) {
            alerta("Tamano mayor a 600kb no permitido");
        }
    }

    function valPlaca() {
        $placa_val = strtoupper($_POST["placa"]);
        if (!(preg_match("/[A-Z][A-Z][A-Z]\-[0-9][0-9][A-Z]$/", $placa_val) == 1)) {
            alerta("Formato de placa incorrecto");
        }
    }

    function validarRq() {
        valImg();
        valPlaca();
    }

    function endReg() {
        //echo ("<script> document.getElementById(\"formulario\").innerHTML = \"\";</script>");
        echo ("<br><div class=\"alert alert-success\" role=\"alert\">
                    <h4 class=\"alert-heading\">Registro Completo!</h4></div>");
    }

    validarRq();
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $placa = strtoupper($_POST["placa"]);
    if (!isOtherCol()) {
        $color = $_POST["color"];
    } else {
        $color = $_POST["color"] . "," . $_POST["color-otro"];
    }
    $fecha_ingreso = date("M / d / Y  h:i A");
    $foto = "foto" . $placa . "_" . date("M-d-Y-h:i A");

    if ($file_img = fopen($_FILES["foto"]["tmp_name"], "r")) {
        if ($file_img_new = fopen("../Fotos_subidas_ajax/" . $foto, "w")) { //aqui se define el directorio de guardado de foto
            while ($line = fgets($file_img)) {
                fwrite($file_img_new, $line);
            }
            fclose($file_img_new);
            fclose($file_img);

            if ($file = fopen("../database/Registro_Ajax.txt", "a+")) {
                fwrite($file, "{$nombres}," . "{$apellidos}," . "{$placa}," . "{$color}," . "{$fecha_ingreso}," . "{$foto},");
            } else {
                alerta("No se logro subir informacion");
            }
            fclose($file);
        } else {
            alerta("No se pudo subir la imagen");
        }
    } else {
        alerta("No se pudo habrir el arcvhivo seleccionado");
    }
    endReg();
    
    } else {
        echo "no llegaron los datos";
        echo print_r($_POST)."\n";
        echo "archivo :".print_r($_FILES);
    }
?>