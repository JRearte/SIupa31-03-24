<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-------------------------- CSS ------------------------------------>
    <link rel = "stylesheet" href = "css/Tabla.css?9">
    <link rel = "stylesheet" href = "css/Formulario.css?1">
    <link rel = "stylesheet" href = "css/Cuerpo.css?10">
    <link rel = "stylesheet" href = "css/Confirmacion.css?1">

    <!-------------------------JAVASCRIPT--------------------------------> 
    <script src = "JavaScript/Formulario/Visibilidad.js"></script>
    <script src = "JavaScript/Formulario/ValidarSala.js?1"defer></script>
    <script src = "Javascript/Formulario/Limpiar.js?2"></script>

    <!------------------- LLAMADAS PHP Y LIBRERIAS ---------------------->
    <?php require ("../Logica/Servicio/Reporte.php");?>
    <?php require_once ("../Logica/Servicio/GestorSala.php");?>
    <title>Sala</title>
</head>


<body>
    <header>
        <nav class = "menú_barra" id = 'menú'>
            <img src="./css/imagen/menú.png" class = "menú">
            <ul>
                <li><a href="#agregar" onclick = "visibilidad('agregar','tabla')">Agregar</a></li>
                <li><a href="?action=generarReporte">Generar reporte</a></li>
                <li><a href="./GUI_Menu.php">Menú</a></li>
                <li><a href="./GUI_Login.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <?php
        $reporte = new Reporte();
        if (isset($_GET['action'])) 
        {
            $action = $_GET['action'];
            if ($action === 'generarReporte') 
            {
                $reporte->generarReporteSala();
            }
        }
    ?>

    <div class ="tabla-sala" id = "tabla" style = "display: block; ">
        <div class = "tabla">
        <?php
        $sala = new GestorSala();
        $salas = $sala->listarSalas();
        ?>
        <script>
        function obtenerArregloSalas() 
        {
            return objetos = <?php echo json_encode($salas); ?>;
        }
        </script>
        
        <?php
            if (!empty($salas)) 
            {
                echo '<table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Capacidad</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>';
                foreach ($salas as $sala) 
                {
                    echo '<tr class = "fila">
                            <td>'.$sala->getNombre().'</td>
                            <td>'.$sala->getEdad().'</td>
                            <td>'.$sala->getCapacidad().'</td>
                            <td> 
                            <a href="?id_Eliminar='.$sala->getID().'">  
                                <img src="./css/imagen/eliminar.png">
                            </a>
                            <a href="?id_Modificar='.$sala->getID().'">
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
                echo 'No existe ninguna sala.';
            }
        ?>
        </div>
    </div>

    <!--------------------------- ENTRADA DEL ELIMINAR SALA --------------------------->
                                <!-- REVISAR LAS DEPENDENCIAS ENTRE IDENTIFICADORES DE LA BASE DE DATOS ---->
    <div id = "confirmacion" style = "display: none;" class = "confirm">
        <form method = "POST">
            <?php
                if(isset($_GET['id_Eliminar']))
                {
                    $id = $_GET['id_Eliminar'];
                    $sala = new GestorSala();
                    $objeto = $sala->obtenerSala($id);
                    ?>
                    <script>visibilidad('confirmacion','tabla');</script> 
                    <img class = "c_eliminar" src = "css/imagen/c_eliminar.png">
                    <p class = "c_pregunta">¿Esta seguro de dar la sala:</p>
                    <p class = "c_nombre">Nombre: <?php echo $objeto->getNombre()?></p>
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
                $sala->darBajaSala($id);
                echo '<script>window.location = "./GUI_Sala.php"</script>';
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

    <div id = "agregar" style = "display: none;">

        <form method = "POST">

            <!--Nombre de la Sala-->
            <div class = "form-group">
            <label for = "Nombre">Nombre: </label>
            <input type = "text" maxlength = 30 placeholder = "Ingrese Nombre" name = "txtNombre" autocomplete = "off" id = "idNombre" required>
            </div>

            <!--Edad de la Sala-->
            <div class = "form-group">
            <label for = "Edad">Edad: </label>
            <input type = "number" id = "idEdad" name = "txtEdad" min = "0" max = "6">
            </div>

            <!--Capacidad de la Sala-->
            <div class = "form-group">
            <label for = "Capacidad">Capacidad: </label>
            <input type = "number" placeholder = "Ingrese la Capacidad" name = "txtCapacidad" min = "0" max = "99" id = "idCapacidad">
            </div>

            <input type = "submit" name = "btnGuardar" value = "Guardar" class = "btn-Guardar" id = "guardar">
            <input type = "submit" name = "btnCancelar" value = "Cancelar" class = "btn-Cancelar" onclick = "limpiarCamposSala('idNombre','idEdad','idCapacidad');">

            </form>
            <?php
            if(isset($_POST['btnGuardar']))
            {   
                $nombre = $_POST['txtNombre'];
                $edad = $_POST['txtEdad'];
                $capacidad = $_POST['txtCapacidad'];
                $sala = new GestorSala();
                $sala->darAltaSala($nombre,$edad,$capacidad);
                echo '<script>window.location = "./GUI_Sala.php"</script>';
            }
            if(isset($_POST['btnCancelar']))
            {
                echo '<script>window.location = "./GUI_Sala.php"</script>';
            }
            ?>
    </div>


    <!--------------------------------ENTRADA DEL MODIFICAR SALA------------------------------------------------------->
    <div id = "modificar" style="display: none;">
        <form method = "POST" >
        <?php
            $id = $_GET['id_Modificar']; 
            $sala = new GestorSala();
            $objeto = $sala->obtenerSala($id);
        ?>
        <script>visibilidad('modificar','tabla');</script> 
        <?php
        ?> 
        
        <!--Nombre de la Sala-->
        <div class = "form-group">
        <label for = "Nombre">Nombre: </label>
        <input type = "text" maxlength = 30 placeholder = "Ingrese Nombre" name = "txtNombre" id = "idNombre2" value = "<?php echo $objeto->getNombre();?>" required>
        </div>

        <!--Edad de la Sala-->
        <div class = "form-group">
        <label for = "Edad">Edad: </label>
        <input type = "number"  maxlength = 1 name = "txtEdad" id = "idEdad2" min = "0" max = "6" value = "<?php echo $objeto->getEdad();?>">
        </div>

        <!--Capacidad de la Sala-->
        <div class = "form-group">
        <label for = "Capacidad">Capacidad: </label>
        <input type = "text" maxlength = 3 placeholder = "Ingrese la Capacidad" name = "txtCapacidad" id = "idCapacidad2" value = "<?php echo $objeto->getCapacidad();?>"required>
        </div>

        <input type = "submit" name = "btnActualizar" value = "Actualizar" class = "btn-Actualizar" > 
        <input type = "submit" name = "btnCancelar" value = "Cancelar" class = "btn-Cancelar" onclick = "limpiarCamposSala('idNombre2','idEdad2','idCapacidad2');">
        <?php
            if(isset($_POST['btnActualizar']))
            {   
                $id = $_GET['id_Modificar'];
                $nombre = $_POST['txtNombre'];
                $edad = $_POST['txtEdad'];
                $capacidad = $_POST['txtCapacidad'];  
                $sala = new GestorSala();
                $sala->modificarSala($id,$nombre,$edad,$capacidad);
                echo '<script>window.location = "./GUI_Sala.php"</script>';
            }
            if(isset($_POST['btnCancelar']))
            {
                echo '<script>window.location = "./GUI_Sala.php"</script>';
            }
        ?> 
        </form>
    </div>
    <!----------------------------------------------------------------------------------------------------------------->
</body>
</html>