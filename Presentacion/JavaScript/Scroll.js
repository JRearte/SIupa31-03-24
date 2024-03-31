//Deshabilita el scroll vertical del raton
function disableVerticalScroll() 
{
    document.addEventListener('DOMMouseScroll', preventScroll, false);          //Firefox
    document.addEventListener('wheel', preventScroll, { passive: false });      //Navegador moderno
    document.addEventListener('touchmove', preventScroll, { passive: false });  //Navegador de celular
}

//Evita el desplazamiento predeterminado
function preventScroll(event) 
{
    event.preventDefault();
}

//Deshabilita el scroll vertical cuando cargar la página
disableVerticalScroll();


/* EJEMPLOS
//Habilita scroll vertical
function enableVerticalScroll() 
{
    document.removeEventListener('DOMMouseScroll', preventScroll, false);
    document.removeEventListener('wheel', preventScroll, { passive: false });
    document.removeEventListener('touchmove', preventScroll, { passive: false });
}

//Habilita el scroll vertical después de 5 segundos (solo como ejemplo)
setTimeout(enableVerticalScroll, 5000);*/