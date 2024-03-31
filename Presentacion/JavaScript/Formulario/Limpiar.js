/**-----------------USUARIO -------------**/
function limpiarCamposUsuario(legajo,nombre,apellido,contrasenia) 
{
    document.getElementById(legajo).value = ' ';//sobrecarga para evitar los required input
    document.getElementById(nombre).value = ' ';
    document.getElementById(apellido).value = ' ';
    document.getElementById(contrasenia).value = ' ';
}

/**--------------- SALA -----------**/
function limpiarCamposSala(nombre,edad,capacidad)
{
    document.getElementById(nombre).value = ' ';
    document.getElementById(edad).value = ' ';
    document.getElementById(capacidad).value = ' ';
}

