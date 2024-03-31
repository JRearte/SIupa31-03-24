<?php
/**
 * MENSAJE DE RECORDATORIO
 * → RF 2 Dar alta usuario docente.
 * → RF 3 Modificar usuario docente.
 * → RF 4 Dar Baja usuario docente.
 * EXTRAS PARA EL RE-USO DEL PROPIO SISTEMA
 * → Listar Docentes.
 */

require_once("../Dato/Mysql.php");

class CRUD_Usuario
{
    private Mysql $mysql;

    /**
     * Constructor de la clase CRUD_Usuario
     * Perteneciente a la Capa Dato
     * Realiza la instanciación de la conexión Mysql
     */
    public function __construct()
    {
        $this->mysql = new Mysql(); //Objeto tipo conexión Mysql
    }

    /**
     * Obtiene un listado de usuarios de la base de datos Mysql 
     * @return array Un arreglo de usuarios
     */
    public function listarUsuarios():array
    {
        try
        {
            $this->mysql->stmt = $this->mysql->conexion->prepare("CALL listarUsuarios");
            $this->mysql->stmt->execute();
            $this->mysql->resultado = $this->mysql->stmt->get_result();

            while($row = $this->mysql->resultado->fetch_assoc()) 
            {    
                $usuarios[] = $row;    
            }
            
            $this->mysql->stmt->close();
            $this->mysql->conexion->close();
            return $usuarios;
        }
        catch(mysqli_sql_exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }
    
    /**
     * Agrega un nuevo usuario a la base de datos.
     * @param Usuario $usuario → Objeto de tipo usuario.
     * @return void 
     */
    public function darAltaUsuario(Usuario $usuario):void
    {
        try
        {
            $legajo     = $usuario->getLegajo();                                                   //Obligado a pasar los valores del objeto a variables.
            $nombre     = $usuario->getNombre();                                                   //ERROR: Notice: Only variables should be passed by reference.
            $apellido   = $usuario->getApellido();                                                 //De la forma habitual funciona, pero igual tirara el error aunque no produzca efectos negativos.
            $categoria  = $usuario->getCategoria();
            $clave      = $usuario->getClave();
            $habilitado = $usuario->getHabilitado();
            $this->mysql->stmt = $this->mysql->conexion->prepare("CALL agregarUsuario(?,?,?,?,?,?)");
            $this->mysql->stmt->bind_param("sssssi", $legajo, $nombre, $apellido, $categoria, $clave, $habilitado);
            $this->mysql->stmt->execute();
            $this->mysql->stmt->close();
            $this->mysql->conexion->close();
        }
        catch (mysqli_sql_exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }

    /**
     * Elimina un usuario de la base de datos a travez de su ID
     * @param int $id → El id representa al usuario que se eliminara.
     * @return void
     */
    public function darBajaUsuario(int $id):void
    {
        try
        {
            $this->mysql->stmt = $this->mysql->conexion->prepare("CALL eliminarUsuario(?)");
            $this->mysql->stmt->bind_param("i", $id);
            $this->mysql->stmt->execute();
            $this->mysql->stmt->close();
            $this->mysql->conexion->close();
        }
        catch(mysqli_sql_exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }
    

    /**
     * Modifica los datos de un usuario de la base de datos.
     * @param Usuario $usuario → Objeto de tipo usuario
     * @return void
     */
    public function modificarUsuario(Usuario $usuario):void
    {
        try
        {
            $id         = $usuario->getId();
            $legajo     = $usuario->getLegajo();
            $nombre     = $usuario->getNombre();                                                           
            $apellido   = $usuario->getApellido();
            $categoria  = $usuario->getCategoria();
            $clave      = $usuario->getClave();
            $habilitado = $usuario->getHabilitado();
            $this->mysql->stmt = $this->mysql->conexion->prepare("CALL modificarUsuario(?, ?, ?, ?, ?, ?, ?)");
            $this->mysql->stmt->bind_param("isssssi",$id,$legajo,$nombre,$apellido,$categoria,$clave,$habilitado); 
            $this->mysql->stmt->execute();
            $this->mysql->stmt->close();
            $this->mysql->conexion->close();
        }
        catch (mysqli_sql_exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }
}
?>