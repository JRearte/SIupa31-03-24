var visión = document.getElementById('idContrasenia');
var ojo = document.getElementById('ojo');
ojo.addEventListener("click", function() {
if(visión.type != "password")
{
    visión.type = "password"
    ojo.style.opacity = 0.2
}
else
{
    visión.type = "text"
    ojo.style.opacity = 0.8
}
})
