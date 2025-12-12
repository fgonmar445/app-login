
        document.getElementById("form").addEventListener("submit", function (event) {

            event.preventDefault();

            const user = document.getElementById("user").value.trim();
            const pass = document.getElementById("pass").value;

            let correcto = true;

            // Limpiar errores antes de validar
            limpiarError('user');
            limpiarError('pass');

            // Validar usuario
            if (user.length < 8 || user.length > 15) {
                marcarError('user', 'El usuario debe tener entre 8 y 15 caracteres.');
                correcto = false;
            }

            // Validar contraseña
            if (pass.length < 8 || pass.length > 15) {
                marcarError('pass', 'Debe tener entre 8 y 15 caracteres.');
                correcto = false;
            }

            const forbidden = /['"\\\/<>=()]/;
            if (forbidden.test(pass)) {
                marcarError('pass', 'Contiene caracteres NO permitidos.');
                correcto = false;
            }

            if (!/[A-Z]/.test(pass)) {
                marcarError('pass', 'Debe incluir al menos una letra mayúscula.');
                correcto = false;
            }

            if (!/[a-z]/.test(pass)) {
                marcarError('pass', 'Debe incluir al menos una letra minúscula.');
                correcto = false;
            }

            if (!/[0-9]/.test(pass)) {
                marcarError('pass', 'Debe incluir al menos un número.');
                correcto = false;
            }

            if (!/[!@#$%^&*_\-+.,?:;]/.test(pass)) {
                marcarError('pass', 'Debe incluir un carácter especial permitido <br>(!@#$%^&*_-+.,?:;).');
                correcto = false;
            }

            // Si todo está bien, enviar formulario
            if (correcto) document.getElementById('form').submit();
        });

        // Ocultar error
        function limpiarError(id) {
            document.getElementById(id).style.borderColor = "#dee2e6";
            const help = document.getElementById(id + 'Help');
            help.style.visibility = "hidden";
            help.innerHTML = "";
        }

        // Mostrar varios errores a la vez
        function marcarError(id, mensaje) {
            const help = document.getElementById(id + 'Help');
            help.style.visibility = "visible";
            help.innerHTML += mensaje + "<br>";
            document.getElementById(id).style.borderColor = "red";
        }