<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---------------------------- CSS ----------------------------------->
    <link rel = "stylesheet" href = "./css/Login.css?2">

    <!------------------------ JAVASCRIPT --------------------------------> 
    <script src = "JavaScript/Formulario/Validar.js?12" defer></script>
    <script src = "JavaScript/Formulario//Password.js" defer></script>
    <script src = "JavaScript/Scroll.js" defer></script>

    <!------------------------ LLAMADAS PHP ------------------------------>
    <?php require_once ("../Logica/Servicio/GestorUsuario.php");?>
    <title>Login</title>
</head>

<body>
    <div class = "login">
        <form method = "post" class = "box">
            <a href = "https://www.facebook.com/UnidadAcademicaRioTurbio">
            <img src = "./css/imagen/jardin2.png" class = "logo2"></a>
            <img src = "./css/imagen/jardin.png" class = "logo">

            <!--Legajo de usuario-->
            <input type = "text" placeholder = "Ingrese legajo" maxlength = 13 name = "txtUsuario" class = "txtUsuario" autocomplete = "off" id = 'idLegajo' required>
            <img src = "./css/imagen/usuario.png" class = "usuario">

            <!--Contraseña-->
            <input type = "password" placeholder = "Ingrese Contraseña" maxlength = 20 name = "txtPassword" class = "txtContrasenia" id = "idContrasenia" required>  
            <img src = "./css/imagen/ocultar.png" id = "ojo" class = "visual">
            <img src = "./css/imagen/contraseña.png" class = "contrasenia">

            <input type = "submit" value = "Ingresar" name = "btnIngresar" class = "btnIngresar">
            
            <?php
            if(isset($_POST["btnIngresar"]))
            {
                $usuario = new GestorUsuario();
                $legajo = $_POST['txtUsuario'];
                $contrasenia = $_POST['txtPassword'];
                $tipo_usuario = $usuario->validarUsuario($legajo,$contrasenia);

                if($tipo_usuario === 'Coordinador')
                {
                    echo '<script>window.location = "../Presentacion/GUI_Menu.php"</script>';
                    exit();
                }
                elseif($tipo_usuario === 'Maestro')
                {
                    echo 'PROXIMAMENTE INTERFAZ MAESTRO';
                }
                else
                {
                    echo '<p class = mensaje >El usuario es invalido </p>';
                }
            }
            ?>
    </div>
</body>
</html>