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