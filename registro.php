<html>

<head>
    <title>Parqueadero - Registro</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

    <script>
        function activeOColor(element) {
            if (element.value == 12) {
                document.getElementById("color-otro").disabled = false;
                document.getElementById("color-otro").required = true;

            } else {
                document.getElementById("color-otro").disabled = true;
                document.getElementById("color-otro").value = "";
                document.getElementById("color-otro").placeholder = "Otro Color";
            }

        }
    </script>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center nav-shadow">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link navbar-brand" href="registro.php">Registrar</a>
            </li>
            <li class="nav-item active logo">
                <a class="nav-link navbar-brand" href="index.html">Parqueadero</a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-brand" href="listado.php">Registrados</a>
            </li>
        </ul>
    </nav>
    <br>
    <br>
    <div class="container justify-content-center">
        <div class="card card-formulario ">
            <div class="card-header text-center text-white text-blanka">
                <strong id="titulo">
                    <h3>Registro de nuevo vehiculo</h3>
                </strong>
            </div>
            <br>
            <form id="formulario" action="registro.php" method="POST" class="needs-validation in-pd" novalidate
                enctype="multipart/form-data">
                <div class="container">
                    <span class="card-subtitle mb-2 text-muted sb-pd blanka">Propietario</span>
                    <div class="row">
                        <div class="col-6 form-group">
                            <input type="text" name="nombres" class="form-control" placeholder="Nombres" required>
                            <div class="invalid-feedback">Este campo es necesario.</div>
                        </div>

                        <div class="col-6 form-group">
                            <input type="text" name="apellidos" class="form-control" placeholder="Apellidos" required>
                            <div class="invalid-feedback">Este campo es necesario.</div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <span class="card-subtitle mb-2 text-muted sb-pd blanka">Vehiculo</span>
                    <div class="row">
                        <div class="col-6 form-group">
                            <select name="color" class="custom-select" id="color_selector"
                                onclick="activeOColor(this);">
                                <option selected>Color...</option>
                                <option value="0">Blanco</option>
                                <option value="1">Negro</option>
                                <option value="3">Gris</option>
                                <option value="4">Plata</option>
                                <option value="5">Rojo</option>
                                <option value="6">Azul</option>
                                <option value="7">Café</option>
                                <option value="8">Beige</option>
                                <option value="9">Verde</option>
                                <option value="10">Anaranjado</option>
                                <option value="11">Amarillo</option>
                                <option value="12">Otro</option>
                            </select>
                        </div>
                        <div class="col-6 form-group">
                            <input id="color-otro" type="text" name="color-otro" placeholder="Otro Color"
                                class="form-control" disabled>
                            <div class="invalid-feedback">Este campo es necesario.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <input type="text" name="placa" placeholder="Placa" class="form-control" required>
                            <div class="invalid-feedback">Este campo es necesario.</div>
                        </div>
                    </div>
                    <span class="card-subtitle mb-2 text-muted sb-pd blanka">Fecha de Ingreso</span>
                    <div class="row">
                        <div class="col-6 form-group input-group">
                            <input id="relog" type="text" style="text-align:center;" name="fecha-ingreso"
                                value="<?php echo date("M / d / Y  h:i A"); ?>" class="form-control" disabled>
                            <div class="invalid-feedback">Este campo es necesario.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 form-group">
                            <div class="custom-file">
                                <input type="file" name="foto" class="custom-file-input" id="foto"
                                    aria-describedby="inputGroupFileAddon01" required>
                                <label class="custom-file-label" for="inputGroupFile01">Foto</label>
                            </div>
                            <div class="invalid-feedback">Este campo es necesario.</div>
                        </div>
                    </div>
                    <!--place holder car
                        <div class="row justify-content-center">
                            <img class="foto-cr" src="img/car_placeholder.png">
                        </div>
                        -->
                    <input name="submit" class="btn-primary btn" style="border-color: black;" type="submit"
                        value="Registrar">
                </div>
            </form>
            <?php
            if (isset($_POST["submit"]) && isset($_POST["nombres"]) && isset($_POST["apellidos"]) && isset($_POST["placa"]) && isset($_POST["color"]) && isset($_FILES["foto"])) { ?>
            <?php

                function isOtherCol()
                {
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

                function alerta($msm)
                {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">";
                    echo "<h4 class=\"alert-heading\">Algo salio mal!</h4>";
                    echo "<p>{$msm}, Intente de nuevo</p></div>";
                    exit();
                }

                function valImg()
                {
                    $tipo = $_FILES["foto"]["type"];
                    if (!(strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png"))) {
                        alerta("Formato de la imagen incorrecto, {$tipo} no permitido");
                    } elseif ($_FILES["foto"]["size"] > 6000000) {
                        alerta("Tamano mayor a 600kb no permitido");
                    }
                }

                function valPlaca()
                {
                    $placa_val = strtoupper($_POST["placa"]);
                    if (!(preg_match("/[A-Z][A-Z][A-Z]\-[0-9][0-9][A-Z]$/", $placa_val) == 1)) {
                        alerta("Formato de placa incorrecto");
                    }
                }

                function validarRq()
                {
                    valImg();
                    valPlaca();
                }

                function endReg()
                {
                    echo ("<script> document.getElementById(\"formulario\").innerHTML = \"\";</script>");
                    echo ("<div class=\"alert alert-success\" role=\"alert\">
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
                    if ($file_img_new = fopen("Fotos_subidas/" . $foto, "w+")) {
                        while ($line = fgets($file_img)) {
                            fwrite($file_img_new, $line);
                        }
                        fclose($file_img_new);
                        fclose($file_img);

                        if ($file = fopen("database/Registro.txt", "a+")) {
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
                ?>
            <?php } else {
                // echo "mal";
            }
            ?>
        </div>
    </div>

    <script>
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        //desabilitar mensaje de required
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // obtener por clase
                var forms = document.getElementsByClassName('needs-validation');
                // prevenir submints
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>