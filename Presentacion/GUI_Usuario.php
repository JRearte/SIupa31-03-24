<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-------------------------- CSS ------------------------------------->
    <link rel = "stylesheet" href = "css/Tabla.css?9">
    <link rel = "stylesheet" href = "css/Cuerpo.css?2">
    <link rel = "stylesheet" href = "css/Confirmacion.css?1">
    <link rel = "stylesheet" href = "css/Formulario.css?2">

    <!-------------------------JAVASCRIPT---------------------------------> 
    <script src = "JavaScript/Formulario/Visibilidad.js?2"></script>           <!--DEFER -> PRODUCE FALLOS PARA LLAMADAS MULTPLES DE LA MISMA FUNCION-->
    <script src = "JavaScript/Formulario/ValidarUsuario.js?3"defer></script>   <!--DEFER = cargar script en segundo plano "sin el defer no funciona"-->
    <script src = "Javascript/Formulario/Limpiar.js?2"></script>
     
    <!------------------- LLAMADAS PHP Y LIBRERIAS ----------------------->
    <?php require_once ("../Logica/Servicio/GestorUsuario.php");?>

    <title>Usuario</title>
</head>

<body>
    <!-------------------------------- CABECERA Y MENU DEL DOCUMENTO HTML GUI -------------------->
    <header>
        <nav class = "menú_barra" id = 'menú'>
            <img src="./css/imagen/menú.png" class = "menú">
            <ul>
                <li><a href="#agregar" onclick = "visibilidad('agregar','tabla')">Dar alta</a></li>
                <li><a href="./GUI_Menu.php">Menú</a></li>
                <li><a href="./GUI_Login.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    
    <!------------------------------------ CAMPO DE SALIDA DE DATOS ------------------------------>
    <div class ="tabla-usuario" id = "tabla" style = "display: block; ">
        <div class = "tabla">
        <?php
            $usuario = new GestorUsuario();
            $usuarios = $usuario->listarUsuarios();    
        ?>


        <!----------------- SECUENCIA DE COMUNICACIóN DE DATOS ENTRE PHP Y JAVASCRIPT ------------>
        <script>
            function obtenerArregloUsuarios() 
            {
                return objetos = <?php echo json_encode($usuarios); ?>;
            }
        </script>
        <!---------------------------------------------------------------------------------------->
        

        <?php /** Versión PHP **  -> la versión HTML requiere muchas averturas de archivos php **/
            if (!empty($usuarios)) 
            {
                echo '<table>
                        <thead>
                            <tr>
                                <th>Legajo</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Categoría</th>
                                <th>Contraseña</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>';
                foreach ($usuarios as $usuario) 
                {
                    echo '<tr class = "fila">
                            <td>'.$usuario->getLegajo().'</td>
                            <td>'.$usuario->getNombre().'</td>
                            <td>'.$usuario->getApellido().'</td>
                            <td>'.$usuario->getCategoria().'</td>
                            <td><input class = "clave" type="password" value="'.$usuario->getClave().'"readonly></td>
                            <td> 
                            <a class = "eliminar" href="?id_Eliminar='.$usuario->getID().'">  
                                <img src="./css/imagen/eliminar.png">
                            </a>
                            <a class = "modificar" href="?id_Modificar='.$usuario->getID().'">
                                <img src="./css/imagen/modificar.png">  
                            </a>
                            </td>
                        </tr>
                        </tbody>';
                }
                echo '</table>';
            } 
            else 
            {
                echo 'No existen usuarios.';
            }
        ?>
        </div>
    </div>    
    <!-------------------------------------------------------------------------------------------->


    <!--------------------------- ENTRADA DEL ELIMINAR USUARIO DOCENTE --------------------------->
    <div id = "confirmacion" style = "display: none;" class = "confirm">
        <form method = "POST">
            <?php
                if(isset($_GET['id_Eliminar']))
                {
                    $id = $_GET['id_Eliminar'];
                    $usuario = new GestorUsuario();
                    $objeto = $usuario->obtenerUsuario($id);
                    ?>
                    <script>visibilidad('confirmacion','tabla');</script> 
                    <img class = "c_eliminar" src = "css/imagen/c_eliminar.png">
                    <p class = "c_pregunta">¿Esta seguro de dar la baja del usuario:</p>
                    <p class = "c_nombre">Nombre: <?php echo $objeto->getNombre()." ".$objeto->getApellido()?></p>
                    <p class = "c_legajo">Legajo: <?php echo $objeto->getLegajo()?></p>
                    <p class = "c_categoria">Categoria: <?php echo $objeto->getCategoria() ?></p>
                    <?php
                }
            ?>
            <input type = "submit" name = "btnConfirmar" value = "Confirmar" class = "btnConfirmar">
            <input type = "submit" name = "btnCancelar" value = "Cancelar" class = "btnCancelar" >
        </form>
        <?php
        if(isset($_POST['btnConfirmar']))
        {
            if(isset($_GET['id_Eliminar'])) 
            {
                $id = $_GET['id_Eliminar'];
                $usuario->darBajaUsuario($id);
                echo '<script>window.location = "./GUI_Usuario.php"</script>';
            }
        }
        if(isset($_POST['btnCancelar']))
        {
            ?> <script>visibilidad('tabla','confirmacion');</script> <?php
            //echo '<script>window.location = "./GUI_Usuario.php"</script>';
        }
        ?>
    </div>
    <!-------------------------------------------------------------------------------------------->


    <!--------------------------- ENTRADA DEL AGREGAR USUARIO DOCENTE ---------------------------->
    <!--ENTRADA DE AGREGAR DOCENTE-->
    <div id = "agregar" style = "display: none;">

        <p class = "mensaje" id = "mensaje" style = "display: none"></p>

        <form method = "POST">
            <!--Legajo del Docente-->
            <div class = "form-group">
            <label for = "Legajo">Legajo: </label>
            <input type = "text" maxlength = 13 placeholder = "Ingrese Legajo" name = "txtLegajo" autocomplete = "off" id = "idLegajo" required onkeyup = "obtenerEntradaLegajo('idLegajo','mensaje','guardar')">
            </div>
            
            <!--Nombre del Docente-->
            <div class = "form-group">
            <label for = "Nombre">Nombre: </label>
            <input type = "text" maxlength = 20 placeholder = "Ingrese Nombre" name = "txtNombre" autocomplete = "off" id = "idNombre" required>
            </div>

            <!--Apellido del Docente-->
            <div class = "form-group">
            <label for = "Apellido">Apellido: </label>
            <input type = "text" maxlength = 20 placeholder = "Ingrese Apellido" name = "txtApellido" autocomplete = "off" id = "idApellido" required>
            </div>

            <!--Contraseña de Docente-->
            <div class = "form-group">
            <label for = "Contrasenia">Contraseña: </label>
            <input type = "text" maxlength = 20 placeholder = "Ingrese Contraseña"  name = "txtContrasenia" autocomplete = "off" id = "idContrasenia" required>
            </div>

            <!--Categoria de Docente-->
            <div class = "form-group">
            <label for = "Categoria">Categoria: </label>
            <select name= "txtCategoria" class = "box">
                <option value="Maestro" class = "opción">Maestro</option>
                <option value="Coordinador" class = "opción">Coordinador</option>
            </select>                
            </div>

            <input type = "submit" name = "btnGuardar" value = "Guardar" class = "btn-Guardar" id = "guardar"> 
            <input type = "submit" name = "btnCancelar" value = "Cancelar" class = "btn-Cancelar" onclick = "limpiarCamposUsuario('idLegajo','idNombre','idApellido','idContrasenia');">

            </form>
            <?php
            if(isset($_POST['btnGuardar']))
            {   
                
                $legajo      = $_POST['txtLegajo'];
                $nombre      = $_POST['txtNombre'];
                $apellido    = $_POST['txtApellido'];
                $categoria   = $_POST['txtCategoria'];
                $clave       = $_POST['txtContrasenia'];
                $habilitado = true;
                $usuario = new GestorUsuario();
                $usuario->darAltaUsuario($legajo,$nombre,$apellido,$categoria,$clave,$habilitado);
                echo '<script>window.location = "./GUI_Usuario.php"</script>';
            }
            if(isset($_POST['btnCancelar']))
            {
                ?> <script>visibilidad('tabla','agregar');</script> <?php
                //echo '<script>window.location = "./GUI_Usuario.php"</script>';
            }
            ?>
    </div>
    <!-------------------------------------------------------------------------------------------->

    
    <!--------------------------- ENTRADA DEL MODIFICAR USUARIO DOCENTE -------------------------->
    <div id = "modificar" style="display: none;">

        <p class = "mensaje" id = "mensaje2" style = "display: none"></p>
            
        <form method = "POST" >
        <?php
            $id = $_GET['id_Modificar']; 
            $usuario = new GestorUsuario();
            $objeto = $usuario->obtenerUsuario($id);
        ?>
        <script>visibilidad('modificar','tabla');</script> 
        <?php
        ?> 
        <!--Legajo del Docente-->
        <div class = "form-group">
        <label for = "Legajo">Legajo: </label>
        <input type = "text" maxlength = 13 placeholder = "Ingrese Legajo" name = "txtLegajo" value = "<?php echo $objeto->getLegajo() ?>" id = "idLegajo2" onkeyup = "obtenerEntradaLegajo('idLegajo2','mensaje2','actualizar')" required>
        </div>
    
        <!--Nombre del Docente-->
        <div class = "form-group">
        <label for = "Nombre">Nombre: </label>
        <input type = "text" maxlength = 20 placeholder = "Ingrese Nombre" name = "txtNombre" value = "<?php echo $objeto->getNombre() ?>" id = "idNombre2" required>
        </div>

        <!--Apellido del Docente-->
        <div class = "form-group">
        <label for = "Apellido">Apellido: </label>
        <input type = "text" maxlength = 20 placeholder = "Ingrese Apellido" name = "txtApellido" value = "<?php echo $objeto->getApellido() ?>" id = "idApellido2" required>
        </div>

        <!--Contraseña de Docente-->
        <div class = "form-group">
        <label for = "Contrasenia">Contraseña: </label>
        <input type = "text" maxlength = 20 placeholder = "Ingrese Contraseña" name = "txtContrasenia" value = "<?php echo $objeto->getClave() ?>" id = "idContrasenia2" required>
        </div>

        <!--Categoria de Docente-->
        <div class = "form-group">
        <label for = "Categoria">Categoria: </label>
        <select name= "txtCategoria" class = "box">
            <option value="Coordinador" <?php if ($objeto->getCategoria() === 'Coordinador') echo 'selected'; ?> class = "opción">Coordinador</option>
            <option value="Maestro" <?php if ($objeto->getCategoria() === 'Maestro') echo 'selected'; ?> class = "opción">Maestro</option>
        </select>
        </div>

        <input type = "submit" name = "btnActualizar" value = "Actualizar" class = "btn-Actualizar" id="actualizar"> 
        <input type = "submit" name = "btnCancelar" value = "Cancelar" class = "btn-Cancelar" onclick = "limpiarCamposUsuario('idLegajo2','idNombre2','idApellido2','idContrasenia2');">
        <?php
            if(isset($_POST['btnActualizar']))
            {   
                $id          = $_GET['id_Modificar'];
                $legajo      = $_POST['txtLegajo'];
                $nombre      = $_POST['txtNombre'];
                $apellido    = $_POST['txtApellido'];
                $categoria   = $_POST['txtCategoria'];
                $clave       = $_POST['txtContrasenia'];
                $habilitado = false;   // es solo de prueba
                $usuario = new GestorUsuario();
                $usuario->modificarUsuario($id,$legajo,$nombre,$apellido,$categoria,$clave,$habilitado);
                echo '<script>window.location = "./GUI_Usuario.php"</script>';
            }
            if(isset($_POST['btnCancelar']))
            {
                ?> <script>visibilidad('tabla','modificar');</script> <?php
                //echo '<script>window.location = "./GUI_Usuario.php"</script>';
            }
        ?> 
        </form>
    </div>
    <!-------------------------------------------------------------------------------------------->

</body>
</html>