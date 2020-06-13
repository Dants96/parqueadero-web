<html>

<head>
    <title>Parqueadero - Registro</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
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
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center nav-shadow">
        <ul class="navbar-nav">
            <li class="nav-item active logo">
                <a class="nav-link-logo navbar-brand" href="../index.html">Parqueadero</a>
            </li>
        </ul>
    </nav>
    <br>
    <br>
    <div class="container">
        <div class="card bg-light card-listado">
            <div class="card-header text-center text-white text-blanka">
                <strong id="titulo">
                    <h3>Listado de vehiculos</h3>
                </strong>
            </div>
            <div class="container in-pd" style="background: #343a40!important;">
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

                if ($file = fopen("../database/Registro.txt", "r")) {
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
                        <img class=\"lista-img\" src=\"../Fotos_subidas_php/{$out_array[5]}\"></div>
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
            </div>
        </div>

    </div>

</body>

</html>