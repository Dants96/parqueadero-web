// bloquear otro color
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

// cambiar los required 
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