let registro = document.getElementById("btn_registro");

registro.addEventListener("click", registrar);

function registrar() {
    let nombre = document.getElementById("nombre");
    let apellido = document.getElementById("apellido");
    let usuario = document.getElementById("usuario");
    let usuario2 = document.getElementById("usuario2");
    let password = document.getElementById("clave");
    let password2 = document.getElementById("clave2");
    let tyc = document.getElementById("tyc");
    let form = document.getElementById("form_registro");
    let warnings = "";

    let alfabeto = [
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "ñ", "o", "p", "q", "r", "s", "t", "u", "v", "x", "y", "z", "w", " "
    ];
    let numeros = [
        "1", "2", "3", "4", "5", "6", "7", "8", "9", "0"
    ];

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        let emailValidator = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        let entrar = false;
        for (let i in nombre.value) {
            if (alfabeto.includes(nombre.value[i].toLowerCase()) == false) {
                warnings +=
                    "Nombre no válido. Solo se permiten caracteres alfabéticos\n";
                entrar = true;
                break;
            }
        }

        for (let i in apellido.value) {
            if (alfabeto.includes(apellido.value[i].toLowerCase()) == false) {
                warnings +=
                    "Apellido no válido. Solo se permiten caracteres alfabéticos\n";
                entrar = true;
                break;
            }
        }
        if (!emailValidator.test(usuario.value)) {
            warnings += "Email no válido\n";
            entrar = true;
        } else {
            if (usuario.value != usuario2.value) {
                warnings += "Los emails no coinciden\n";
                entrar = true;
            }
        }
        if (password.value != password2.value) {
            warnings += "Las contraseñas no coinciden\n";
            entrar = true;
        }
        if (password.value.length < 8) {
            warnings += "Contraseña debe tener mínimo 8 caracteres\n";
            entrar = true;
        }
        let contNumber = 0
        let contEspeciales = 0
        for (let i in password.value) {
            if (numeros.includes(password.value[i])) {
                contNumber += 1
            } else if (!alfabeto.includes(password.value[i].toLowerCase())) {
                contEspeciales += 1
            }
        }
        if (contNumber == 0) {
            warnings += "La cotraseña debe tener mínimo un número\n";
            entrar = true;
        }
        if (contEspeciales == 0) {
            warnings += "La cotraseña debe tener mínimo un caracter especial\n";
            entrar = true;
        }
        if (!tyc.checked) {
            warnings += "Debe aceptar los términos y condiciones\n";
            entrar = true;
        }
        if (entrar) {
            alert(warnings);
        } else {
            form.submit();
        }
    });
}
