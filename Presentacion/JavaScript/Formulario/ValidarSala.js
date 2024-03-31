
var regexLetrasNumeros = /^[a-zA-Z0-9]+$/; //Letras y Numeros

/**
 * Verifica que los caracteres ingresados por teclado sean validos.
 * @param {Event} evento - evento que produce la validación.
 * @param {RegExp} regex - expresión regular que define el patron de caracteres permitidos.
 */
function validar(evento, regex)
{
    var tecla = evento.key;
    if (!(regex.test(tecla) || tecla === 'Backspace' || tecla.startsWith('Arrow') || tecla === ' ')) 
    {
        evento.preventDefault();
    }
}

/**
 * Verifica que los caracteres ingresados por teclado en un campo de texto sean validos.
 * Tambien convierte la primera letra de cada palabra en mayúscula y el resto en minúscula.
 * @param {Event} evento - evento que produce la validación.
 * @param {RegExp} regex - expresión regular que define el patron de caracteres permitidos.
 */
function validarCampoTexto(evento, regex)
{
    var entrada = evento.target;
    var valor = entrada.value;
    var corrector = '';

    valor = valor.toLowerCase();                                               //Convierte todo el texto a minúsculas
    corrector = valor.replace(/\b\w/g, function(texto)                         //Reemplaza la primera letra de cada palabra con su versión en mayúscula
    {                       
        return texto.charAt(0).toUpperCase() + texto.substr(1);
    });

    entrada.value = corrector;                                                 //Actualiza el valor del campo de entrada con el texto corregido
    validar(evento, regex);                                                    //Llama a la función 'validar' para verificar la entrada con la expresión regular proporcionada
}


/**
 * Validación del campo NOMBRE, donde solo se podra usar letras y numeros
 * Permitiendo que cada nombre inicie con una mayúscula y el resto minúsculas.
 */
document.getElementById('idNombre').addEventListener('keydown', function(evento) 
{
    validarCampoTexto(evento,regexLetrasNumeros);
});

/**
 * Validación del campo EDAD, donde solo se podra usar numeros
 * Permitiendo que solo se pueda ingresar 1 digito
 */
document.getElementById('idEdad').addEventListener('keydown', function(evento) 
{
    var input = evento.target;

    if (input.value.length >= 0) 
    {
        input.value = input.value.slice(0, 0);
    }
});


/**
 * Validación del campo CAPACIDAD, donde solo se podra usar numeros
 * Permitiendo que solo se pueda ingresar 2 digito
 */
document.getElementById('idCapacidad').addEventListener('keydown', function(evento) 
{
    var input = evento.target;

    if (input.value.length >= 1) 
    {
        input.value = input.value.slice(0, 1);
    }
});

/************************************** MODIFICAR ****************************************/

/**
 * Validación del campo NOMBRE, donde solo se podra usar letras y numeros
 * Permitiendo que cada nombre inicie con una mayúscula y el resto minúsculas.
 */
document.getElementById('idNombre2').addEventListener('keydown', function(evento) 
{
    validarCampoTexto(evento,regexLetrasNumeros);
});

/**
 * Validación del campo EDAD, donde solo se podra usar numeros
 * Permitiendo que solo se pueda ingresar 1 digito
 */
document.getElementById('idEdad2').addEventListener('keydown', function(evento) 
{
    var input = evento.target;

    if (input.value.length >= 0) 
    {
        input.value = input.value.slice(0, 0);
    }
});


/**
 * Validación del campo CAPACIDAD, donde solo se podra usar numeros
 * Permitiendo que solo se pueda ingresar 2 digito
 */
document.getElementById('idCapacidad2').addEventListener('keydown', function(evento) 
{
    var input = evento.target;

    if (input.value.length >= 1) 
    {
        input.value = input.value.slice(0, 1);
    }
});