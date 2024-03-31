<?php 
/**
 *  -> RF 40 Dar alta sala
 *  -> RF 41 Dar baja sala
 *  -> RF 42 Modificar Sala
 */
require_once("../Dato/Mysql.php");

class CRUD_Sala
{
    private Mysql $mysql;

    function __construct()
    {
        $this->mysql = new Mysql();
    }

    /**
     * Obtiene un listado de salas de la base de datos Mysql
     * @return array Un arreglo de salas.
     */
    public function listarSalas():array
    {
        $salas = [];
        $this->mysql->stmt = $this->mysql->conexion->prepare("CALL listarSalas");
        $this->mysql->stmt->execute();
        $this->mysql->resultado = $this->mysql->stmt->get_result();
        while($row = $this->mysql->resultado->fetch_assoc())
        {
            $salas[] = $row;
        }
        $this->mysql->stmt->close();
        $this->mysql->conexion->close();
        return $salas;
    }

    /**
     * Agrega una nueva sala a la base de datos.
     * @param Sala $sala -> Objeto de tipo sala
     * @return void
     */
    public function darAltaSala(Sala $sala):void
    {
        try
        {
            $nombre     = $sala->getNombre();
            $edad       = $sala->getEdad();
            $capacidad  = $sala->getCapacidad();
            $this->mysql->stmt = $this->mysql->conexion->prepare("CALL agregarSala(?,?,?)");
            $this->mysql->stmt->bind_param("sii",$nombre,$edad,$capacidad);
            $this->mysql->stmt->execute();
            $this->mysql->stmt->close();
            $this->mysql->conexion->close();
        }
        catch(mysqli_sql_exception $ex)
        {
            echo 'Error en la base de datos: '. $ex->getMessage();
        }
    }


    /**
     * Elimina una sala de la base de datos a travez de su ID
     * @param int $id -> El id representa a la sala que se eliminara.
     * @return void
     */
    public function darBajaSala(int $id):void
    {
        try
        {
            $this->mysql->stmt = $this->mysql->conexion->prepare("CALL eliminarSala(?)");
            $this->mysql->stmt->bind_param("i",$id);
            $this->mysql->stmt->execute();
            $this->mysql->stmt->close();
            $this->mysql->conexion->close();
        }
        catch(mysqli_sql_exception $ex)
        {
            echo 'Error en la base de datos: '. $ex->getMessage();
        }
    }


    /**
     * Modifica los datos de una sala de la base de datos.
     * @param Sala $sala -> Objeto de tipo sala
     * @return void
     */
    public function modificarSala(Sala $sala):void
    {
        try
        {
            $id         = $sala->getID();
            $nombre     = $sala->getNombre();
            $edad       = $sala->getEdad();
            $capacidad  = $sala->getCapacidad();
            $this->mysql->stmt = $this->mysql->conexion->prepare("CALL modificarSala(?,?,?,?)");
            $this->mysql->stmt->bind_param("isii",$id,$nombre,$edad,$capacidad);
            $this->mysql->stmt->execute();
            $this->mysql->stmt->close();
            $this->mysql->conexion->close();
        }
        catch(mysqli_sql_exception $ex)
        {
            echo 'Error en la base de datos: '. $ex->getMessage();
        }
    }
}
?>