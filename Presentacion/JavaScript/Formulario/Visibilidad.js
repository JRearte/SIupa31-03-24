function visibilidad(tomar, dejar) 
{
    document.getElementById(tomar).style.display = 'block';
    document.getElementById(dejar).style.display = 'none';

    if (tomar === 'tabla') 
    {
        document.getElementById('menú').style.display = 'block';
    } 
    else 
    {
        document.getElementById('menú').style.display = 'none';
    }
}