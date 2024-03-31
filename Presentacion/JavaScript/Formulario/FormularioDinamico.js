function mostrarDiv()
{
    var tipoTutor = document.getElementById("tipo_tutor").value;
    var alumno = document.getElementById("alumno");
    var trabajador = document.getElementById("trabajador");

    if (tipoTutor === "Alumno")
    {
        alumno.style.display = "block";
        trabajador.style.display = "none";
    } 
    else 
    {
        alumno.style.display = "none";
        trabajador.style.display = "block";
    }
}