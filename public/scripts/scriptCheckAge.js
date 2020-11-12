
function checkAge(){
    let password = document.registroForm.password.value;
    let repeatPassword = document.registroForm.repeat_password.value;

    if(!areSamePassword(password, repeatPassword)) {
        window.alert("Las contraseñas son diferentes");
        document.getElementById()
        return 0;
    }

    //Fecha actual
    var hoy = new Date();
    var fecha = document.registroForm.date_birth.value;
    var fechaNac = new Date(fecha);

    var edad = hoy.getFullYear() - fechaNac.getFullYear();
    var difMeses = hoy.getMonth() - fechaNac.getMonth();

    console.log('Edad', edad)

    if (difMeses < 0 || (difMeses === 0 && hoy.getDate() < fechaNac.getDate())) {
        edad--;
    }

    if (edad < 16) {
        window.alert("Su edad debe ser igual o mayor a 16 años");
        console.log('es menor', edad)
        return 0;
    }

    document.registroForm.submit();
}

function areSamePassword(password, repeatPassword) {
    return password == repeatPassword;
}
