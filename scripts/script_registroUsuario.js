function alerta(msg) {
    $('#outRes').html(
        "<div class=\"alert alert-danger\" role=\"alert\"><h4 class=\"alert-heading\">Algo salio mal!</h4><p>" +
        msg + "</p></div>");
}

function succesReg(msg){
    $('#card_reg').html('<div class="alert alert-success" role="alert">< h4 class= "alert-heading" >Registro completo!</h4 ><p>'+ msg +'</p><hr><p class="mb-0">ya puedes acceder a las funciones de la pagina.</p></div>');
}

function requiredPop(element, fed, msg) {
    $(element).css('border-color', '#dc3545');
    $(element).css('background-image', "none");
    $(fed).html(msg);
    $(fed).css('display', 'flex');
}

function requiredPsh(element, fed){
    $(element).css('border-color', '#28a745');
    $(fed).css('display', 'none');
}

function valPwd(){
    if ($('#pwd').val() != $('#pwdR').val()) {
        requiredPop('#pwdR', '#fedPwdR', 'La contraseña debe coincidir');
        requiredPop('#pwd', '#fedPwd', 'La contraseña debe coincidir');
        return false;
    }else{
        requiredPsh('#pwdR', '#fedPwdR');
        requiredPsh('#pwd', '#fedPwd');
        return true;
    }
}


function valNick(){
    nickIN = 'nickIN=' + $('#user_nick').val();

    $.ajax({
        url: 'phpServ/getNickServ.php',
        type: 'POST',
        data: nickIN,
        processData: false
    })
    .done(function (res) {
        var respuesta = JSON.parse(res);
        if(!respuesta.get){
            requiredPsh('#user_nick', '#fedUsNk');
        }else{
            requiredPop('#user_nick', '#fedUsNk', 'ya existe un usuario con ese nombre');
        }
    })
    .fail(function () {
        console.log("error ajax comprobando nick");
    })
    .always(function () {
        console.log("complete ajax comprobando nick");
    })
}

function validarIn() {
    let vals = [valPwd()];
    let valOut = true;
    vals.forEach(element => {
        valOut = (element && valOut);
    });

    valNick();

    return valOut; //no activar ajax de momento

}

$(document).on('submit', '#formulario', function (event) {
    event.preventDefault();
    alert($(this).serialize());
    if(validarIn()){
        //enviar formulario al servidor
        $.ajax({
            url: 'phpServ/registrarUsuarioServ.php',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function () {
                $('#enviar').val('Validando...');
            },
            processData: false
        })
        .done(function (res) {
            alert(res);
            var respuesta = JSON.parse(res);
            if (!respuesta.error) {
                succesReg(respuesta.msg);
                alert("registro completo");
                location.href = "/parqueadero-web/index.html"
            } else {
                alert('respuesta' + respuesta.msg);
                alerta(respuesta.msg);
            }
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete submit");
            $('#enviar').val('Ingresar');
        })

    }    

});

$(document).ready(function () {
    // verificar que el usuario no esta autenticado
    $.ajax({
        url: 'phpServ/authServ.php',
        type: 'GET',
    })
        .done(function (autenticado) {
            console.log(autenticado);
            if (autenticado) {
                alert("ya has iniciado sesion");
                location.href = "/parqueadero-web/index.html";
            }
        })
        .fail(function () {
            console.log("error");
        })
        .always(function () {
            console.log("complete");
        })
    
});

