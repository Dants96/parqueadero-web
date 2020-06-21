$(document).ready(function () {
    $.ajax({
            url: 'phpServ/authServ.php',
            type: 'GET',
        })
        .done(function (autenticado) {
            if (autenticado) {
                $('#salir').html('<a id="salir_a" class="nav-link navbar-brand" href="#">Salir</a>');
                $('#salir_a').on('click', function () {
                    $.ajax({
                            url: 'phpServ/cerrarSesServ.php',
                            type: 'GET',
                        })
                        .done(function (res) {
                            alert("sesion cerrada");
                            location.reload();
                        })
                        .fail(function () {
                            console.log("error a salir");
                        })
                        .always(function () {
                            console.log("complete");
                        })
                });
            } else {
                $('#vr_regu').html('<a class="nav-link navbar-brand" href="registroUsuario.html">Registrarse</a>');
                $('#vr_logu').html('<a class="nav-link navbar-brand" href="login.html">Entrar</a>');
            }
        })
        .fail(function () {
            console.log("error nav auth");
            //local.reload();
        })
        .always(function () {
            console.log("nav auth complete");
        })
});