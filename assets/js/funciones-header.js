function noCopy(e) {
    if (e.shiftKey || e.ctrlKey || e.altKey) {
        e.preventDefault();
    }
}

function noWhitesSpace(e) {
    if (e.ctrlKey || e.altKey) {
        e.preventDefault();
    } else {
        var key = e.keyCode;
        if (key == 32) {
            e.preventDefault();
        }
    }
}

function preventWhiteSpace(e) {
    var key = e.keyCode;
    if (key == 32) {
        e.preventDefault();
    }
}

function solo_texto(e) {
    especiales = [32, 209, 241, 225, 233, 237, 243, 250, 193, 201, 205, 211, 218];
    caracteres = ["%"];
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    tecla_especial = false;
    if (caracteres.indexOf(tecla) == -1) {
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true; break;
            } else if (key > 96 && key < 123) {
                //LETRAS MINUSCULAS
                tecla_especial = true; break;
            } else if (key > 64 && key < 91) {
                //LETRAS MAYUSCULAS
                tecla_especial = true; break;
            }
        }
    }
    if (!tecla_especial)
        return false;
}

function numeros_enteros(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8, 9, 37, 39, 46];
    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) { tecla_especial = true; break; }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}


function validar_institucion(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    caracteres = ["%"];
    especiales = [32, 8, 9, 37, 39];
    tecla_especial = false;
    if (caracteres.indexOf(tecla) == -1) {
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true; break;
            } else if (key > 96 && key < 123) {
                //LETRAS MINUSCULAS
                tecla_especial = true; break;
            } else if (key > 64 && key < 91) {
                //LETRAS MAYUSCULAS
                tecla_especial = true; break;
            }
        }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}