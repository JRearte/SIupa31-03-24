<?php
require_once("../Dato/Mysql.php");

class CRUD_Tutor
{
    private Mysql $mysql;

    public function __construct()
    {
        $this->mysql = new Mysql();
    }

    /**----------------------------------- Metodos del Tutor -----------------------------------**/

    /**
     * Agrega un nuevo tutor junto a su domicilio y la carrera principal a la base de datos.
     * @param Tutor     $tutor      → Objeto de tipo tutor.
     * @param Domicilio $domicilio  → Objeto de tipo domicilio.
     * @param Carrera   $carrera    → Objeto de tipo carrera.
     * @return void No devuelve nada.
     */
    public function darAltaTutorAlumno(Tutor $tutor, Domicilio $domicilio, Carrera $carrera):void
    {
        try
        {
            $legajo             = $tutor->getLegajo();
            $nombre             = $tutor->getNombre();
            $apellido           = $tutor->getApellido();
            $genero             = $tutor->getGenero();
            $fecha_nacimiento   = $tutor->getFechaNacimiento()->format('Y-m-d');
            $numero_documento   = $tutor->getNumeroDocumento();
            $tipo_documento     = $tutor->getTipoDocumento();
            $tipo_tutor         = $tutor->getTipoTutor();
            $habilitado         = $tutor->getHabilitado();
            $provincia          = $domicilio->getProvincia();
            $localidad          = $domicilio->getLocalidad();
            $codigo             = $domicilio->getCodigoPostal();
            $barrio             = $domicilio->getBarrio();
            $calle              = $domicilio->getCalle();
            $numero             = $domicilio->getNumero();
            $codigo_carrera     = $carrera->getCodigo();
            $nombre_carrera     = $carrera->getNombre();

            $this->mysql->stmt = $this->mysql->conexion->prepare("CALL agregarTutorAlumno(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $this->mysql->stmt->bind_param("sssssissississsis", $legajo, $nombre, $apellido, $genero, $fecha_nacimiento, $numero_documento, $tipo_documento, $tipo_tutor, $habilitado, $provincia, $localidad, $codigo, $barrio, $calle, $numero, $codigo_carrera, $nombre_carrera);
            $this->mysql->stmt->execute();
            $this->mysql->stmt->close();
            //$this->mysql->conexion->close();
        }
        catch (mysqli_sql_exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }

    /**
     * Obtiene un listado de tutores de la base de datos Mysql 
     * @return array Un arreglo de tutores
     */
    public function listarTutores():array
    {
        try
        {
            $this->mysql->stmt = $this->mysql->conexion->prepare("CALL listarTutores");
            $this->mysql->stmt->execute();
            $this->mysql->resultado = $this->mysql->stmt->get_result();

            while($row = $this->mysql->resultado->fetch_assoc()) 
            {    
                $tutores[] = $row;    
            }
            
            $this->mysql->stmt->close();
            //$this->mysql->conexion->close();
            return $tutores;
        }
        catch(mysqli_sql_exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }

    /**--------------------------------- Metodos de la Carrera ---------------------------------**/

    public function listarCarreras():array
    {
        try
        {
            $this->mysql->stmt = $this->mysql->conexion->prepare("CALL listarCarreras");
            $this->mysql->stmt->execute();
            $this->mysql->resultado = $this->mysql->stmt->get_result();

            while($row = $this->mysql->resultado->fetch_assoc()) 
            {    
                $carreras[] = $row;    
            }
            
            $this->mysql->stmt->close();
            //$this->mysql->conexion->close();
            return $carreras;
        }
        catch(mysqli_sql_exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }



    /**-------------------------------- Metodos de la Asignatura --------------------------------*/



    public function cargarAsignaturas(Asignatura $asignatura, int $id_tutor, int $codigo_carrera):void
    {
        try
        {
            $codigo_asignatura  = $asignatura->getCodigo();
            $nombre             = $asignatura->getNombre();
            $fecha              = $asignatura->getFecha()->format('Y-m-d');
            $condicion          = $asignatura->getCondicion();
            $calificacion       = $asignatura->getCalificacion();
            $this->mysql->stmt = $this->mysql->conexion->prepare("CALL agregarAsignatura(?,?,?,?,?,?,?)");
            $this->mysql->stmt->bind_param("isssiii", $codigo_asignatura, $nombre, $fecha, $condicion, $calificacion, $id_tutor, $codigo_carrera);
            $this->mysql->stmt->execute();
            $this->mysql->stmt->close();
            //$this->mysql->conexion->close();
        }
        catch(mysqli_sql_exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }

}
?>