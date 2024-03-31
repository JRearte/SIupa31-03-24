<?php

require '../Logica/Entidad/Usuario.php';
require_once __DIR__ . '/../../Dato/CRUD_Usuario.php';

class GestorUsuario
{
    
    private Usuario $usuario;
    private CRUD_Usuario $crud;

    public function __construct()
    {
        $this->crud = new CRUD_Usuario();
    }

    
    /**
     * Obtiene una lista de usuarios a partir de los datos obtenidos de la capa de datos CRUD_Usuario.
     * @return array Un array de objetos Usuario que representa la lista de usuarios.
     */
    public function listarUsuarios():array
    {
        try
        {
            $datosUsuario = $this->crud->listarUsuarios();
            foreach ($datosUsuario as $datoUsuario) 
            {
                $this->usuario = new Usuario(
                    $datoUsuario['id_usuario'],
                    $datoUsuario['Legajo'],
                    $datoUsuario['Nombre'],
                    $datoUsuario['Apellido'],
                    $datoUsuario['Categoria'],
                    $datoUsuario['Clave'],
                    $datoUsuario['Habilitado']
                );
                $usuarios[] = $this->usuario;
            }
            return $usuarios;
        }
        catch(Exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }
    

    /**
     * Reutiliza el metodo listarUsuarios de la capa lógica para:
     * → obtener un usuario específico a partir de su ID.
     * → optimizar la reducción de código en el Gestor_Usuario.
     * @param int $id   → El identificado principal del usuario dentro del código.
     * @return Usuario  → El objeto que representa al Usuario junto a todos sus datos.
     */
    public function obtenerUsuario(int $id): Usuario
    {
        try
        {
            $datoUsuarios = $this->listarUsuarios();
            foreach ($datoUsuarios as $datoUsuario) 
            {
                if ($datoUsuario->getID() === $id) 
                {
                    return $datoUsuario;
                }
            }
        }
        catch(Exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }


    /**
     * Reutiliza el metodo listarUsuarios de la capa lóogica para:
     * → obtener un usuario especifico a partir de su legajo y contraseña,
     *   con esto realiza la validación de usuario junto a su categoria.
     * @param string $legajo    → Es el dato con el que se identifica el usuario en su dominio.
     * @param string $clave     → Es la medida de seguridad para el usuario.
     * @return string valores en caracteres
     */
    public function validarUsuario(string $legajo, string $clave): string
    {
        try
        {
            $datoUsuarios = $this->listarUsuarios();
            foreach ($datoUsuarios as $datoUsuario) 
            {
                if ($datoUsuario->getLegajo() === $legajo && $datoUsuario->getClave() === $clave)
                {
                    if ($datoUsuario->getCategoria() === 'Coordinador')
                    {
                        return 'Coordinador';
                    }
                    else
                    {
                        return 'Maestro';
                    }
                }
            }
            return 'Invalido';
        }
        catch(Exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }


    /**
     * Permite la negociación de los datos para dar el alta de un nuevo usuario
     * @param string $legajo     → El dato con el que se identifica el usuario en su dominio.
     * @param string $nombre     → El nombre principal de la identidad del usuario.
     * @param string $apellido   → El identificador familiar del usuario.
     * @param string $categoria  → El dato principal que designara los permisos que se le dara al usuario.
     * @param string $clave      → La medida de seguridad para el usuario.
     * @param bool   $habilitado → La medida de seguridad para habilitar o deshabilitar un usuario.
     * @return void No devuelve nada despues de su ejecución.
     */
    public function darAltaUsuario(string $legajo, string $nombre, string $apellido, string $categoria, string $clave, bool $habilitado = true):void
    {
        $this->usuario = new Usuario(0, $legajo, $nombre, $apellido, $categoria, $clave, $habilitado);
        $this->crud->darAltaUsuario($this->usuario);
    }


    /**
     * Permite la negociación de los datos para la modificación de un usuario
     * @param int    $id         → El identificado principal del usuario dentro del código.
     * @param string $legajo     → El dato con el que se identifica el usuario en su dominio.
     * @param string $nombre     → El nombre principal de la identidad del usuario.
     * @param string $apellido   → El identificador familiar del usuario.
     * @param string $categoria  → El dato principal que designara los permisos que se le dara al usuario.
     * @param string $clave      → La medida de seguridad para el usuario.
     * @param bool   $habilitado → La medida de seguridad para habilitar o deshabilitar un usuario.
     * @return void                No devuelve nada despues de su ejecución.
     */
    public function modificarUsuario(int $id,string $legajo, string $nombre, string $apellido, string $categoria, string $clave, bool $habilitado):void
    {
        $this->usuario = new Usuario($id, $legajo, $nombre, $apellido, $categoria, $clave, $habilitado);
        $this->crud->modificarUsuario($this->usuario);
    }

    
    /**
     * Permite la negociación de los datos para dar la baja de un usuario
     * @param int $id → El identificado principal del usuario dentro del código.
     * @return void No devuelve nada despues de su ejecución.
     */
    public function darBajaUsuario(int $id):void
    {
        $crud = new CRUD_Usuario();//obligatorio
        $crud->darBajaUsuario($id);
    }
}
?>