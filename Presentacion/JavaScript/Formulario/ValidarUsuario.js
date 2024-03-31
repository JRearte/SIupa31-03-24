var regexNumerosSimbolos = /^[0-9\s\W]+$/;  //Expresión regular que permite números y símbolos
var regexLetras =  /^[a-zA-Z]*$/;           //Expresión regular que permite solo letras


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
 * Verifica que los caracteres ingresados por teclado en un campo de texto sean validos.
 * Tambien aseguira que entre los 13 caracteres:
 * → al llegar al segundo se agrega una - automaticamente.
 * → al llegar al decimo se agrega una / automaticamente.
 * @param {Event} evento - evento que produce la validación.
 * @param {RegExp} regex - expresión regular que define el patron de caracteres permitidos.
 */
function validarCampoLegajo(evento, regex)
{
    var entrada = evento.target;
    var valor = entrada.value.replace(/[^\d\/-]/g, '');                        //Eliminar caracteres no numéricos

    if (valor.length > 1) 
    {
        valor = valor.slice(0,1) + '-' + valor.slice(1).replace(/\D/g, '');    //Asegurarse de que solo haya dígitos
    }
    if (valor.length > 10) 
    {
        valor = valor.slice(0,10) + '/' + valor.slice(10);                     //Limitar la longitud total y agregar el '/'
    }
    entrada.value = valor;
    validar(evento,regex);                                                     //Llama a la función 'validar' para verificar la entrada con la expresión regular proporcionada
}




/****************** Validación de expresiones regulares ******************/

/**
 * Validación del campo LEGAJO, donde solo se podra usar números y simbolos.
 */
document.getElementById('idLegajo').addEventListener('keydown', function(evento)
{
    validarCampoLegajo(evento, regexNumerosSimbolos);
});



/**
 * Validación del campo NOMBRE, donde solo se podra usar letras
 * Permitiendo que cada nombre inicie con una mayúscula y el resto minúsculas.
 */
document.getElementById('idNombre').addEventListener('keydown', function(evento) 
{
    validarCampoTexto(evento,regexLetras);
});



/**
 * Validación del campo APELLIDO, donde solo se podra usar letras
 * Permitiendo que cada apellido inicie con una mayúscula y el resto minúsculas.
 */
document.getElementById('idApellido').addEventListener('keydown', function(evento) 
{
    validarCampoTexto(evento,regexLetras);
});



/**------------------------ MODIFICAR USUARIO ---------------------------**/
/**
 * Validación del campo LEGAJO, donde solo se podra usar números y simbolos.
 */
document.getElementById('idLegajo2').addEventListener('keydown', function(evento)
{
    validarCampoLegajo(evento, regexNumerosSimbolos);
});



/**
 * Validación del campo NOMBRE, donde solo se podra usar letras
 * Permitiendo que cada nombre inicie con una mayúscula y el resto minúsculas.
 */
document.getElementById('idNombre2').addEventListener('keydown', function(evento) 
{
    validarCampoTexto(evento,regexLetras);
});



/**
 * Validación del campo APELLIDO, donde solo se podra usar letras
 * Permitiendo que cada apellido inicie con una mayúscula y el resto minúsculas.
 */
document.getElementById('idApellido2').addEventListener('keydown', function(evento) 
{
    validarCampoTexto(evento,regexLetras);
});



/*************************************************************************************************/

/**
 * Permite validar la entrada de Legajo, evitando que el usuario ingrese uno existente o
 * uno que sea menor a los 13 caracteres, anulando el boton de guardar o actualizar y tirando mensajes.
 * @param {string} legajo - toma el identificador del legajo
 * @param {string} mensaje - toma el identificador del mensaje
 * @param {string} boton - toma el identificador del boton
 * @returns 
 */
function obtenerEntradaLegajo(legajo, mensaje, boton) 
{
    var arreglo = obtenerArregloUsuarios();
    var valor = document.getElementById(legajo).value;
    var mensaje = document.getElementById(mensaje);
    var guardar = document.getElementById(boton);
    
    for (var i = 0; i < arreglo.length; i++)
    {
        if (arreglo[i].legajo === valor) 
        {
            mensaje.textContent = 'El legajo ya existe';
            mensaje.style.color = 'Red';
            mensaje.style.display = "block";
            guardar.disabled = true;
            return
        }
    }
    if(valor.length === 13)
    {
        mensaje.textContent = 'Legajo aceptable';
        mensaje.style.color = '#90EE90';
        mensaje.style.display = "block";
        guardar.disabled = false;
        return
    }
    else
    {
        mensaje.textContent = 'Legajo debe tener 13 caracteres';
        mensaje.style.color = 'yellow';
        mensaje.style.display = "block";
        guardar.disabled = true;
        return
    }
}

