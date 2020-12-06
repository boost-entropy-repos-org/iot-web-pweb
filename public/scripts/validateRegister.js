
function checkAge(){
    let username = document.forms["registroForm"]["username"].value;
    let date_birth = document.forms["registroForm"]["date_birth"].value;
    let email = document.forms["registroForm"]["email"].value;
    let password = document.forms["registroForm"]["password"].value;
    let repeatPassword = document.forms["registroForm"]["repeat_password"].value;

    //Se comprueba que la contraseña es igual
    if(!areSamePassword(password, repeatPassword)) {
        window.alert("Las contraseñas son diferentes");
        return false;
    }

    //Se comprueba que se han rellenado los campos
    if(username === "" || date_birth === "" || email === "" || password === "" || repeatPassword === "") {
        return false;
    }

    //Se comprueba si es mayor de 16
    if(isMayorDeEdad(date_birth)) {
        return true;
    } else {
        window.alert("Su edad debe ser igual o mayor a 16 años");
        console.log('es menor', edad)
        return false;
    }
}

function isMayorDeEdad(fecha) {
    var hoy = new Date();
    var fechaNac = new Date(fecha);

    var edad = hoy.getFullYear() - fechaNac.getFullYear();
    var difMeses = hoy.getMonth() - fechaNac.getMonth();

    console.log('Edad', edad)

    if (difMeses < 0 || (difMeses === 0 && hoy.getDate() < fechaNac.getDate())) {
        edad--;
    }

    return (edad > 16);
}

function areSamePassword(password, repeatPassword) {
    return password == repeatPassword;
}
