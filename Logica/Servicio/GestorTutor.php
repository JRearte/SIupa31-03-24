<?php
require '../Logica/Entidad/Tutor.php';
require '../Logica/Entidad/Trabajador.php';
require '../Logica/Entidad/Domicilio.php';
require '../Logica/Entidad/Carrera.php';
require '../Logica/Entidad/Asignatura.php';
require_once __DIR__ . '/../../Dato/CRUD_Tutor.php';

//LIBRERIA PARA MANEJAR EXCEL
require '../Libreria/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

class GestorTutor
{
    private Tutor $tutor;
    private Domicilio $domicilio;
    private Trabajador $trabajador;
    private Carrera $carrera;
    private Asignatura $asignatura;
    private CRUD_Tutor $crud;

    public function __construct()
    {
        $this->crud = new CRUD_Tutor();
    }


    /**----------------------------------- Metodos del Tutor -----------------------------------**/

    /**
     * Obtiene una lista de tutores a partir de los datos obtenidos de la capa de datos CRUD_Tutor.
     * @return array Un array de objetos Tutor que representa la lista de tutores.
     */
    public function listarTutores():array
    {
        try
        {
            $tutores = [];
            $datosTutores = $this->crud->listarTutores();
         
            foreach ($datosTutores as $datoTutor) 
            {
                $tutor = new Tutor(
                    $datoTutor['id_tutor'],
                    $datoTutor['Legajo'],
                    $datoTutor['Nombre'],
                    $datoTutor['Apellido'],
                    $datoTutor['Numero_documento'],
                    $datoTutor['Tipo_documento'],
                    new DateTime($datoTutor['Fecha_de_nacimiento']),
                    $datoTutor['Genero'],
                    $datoTutor['Habilitado'],
                    $datoTutor['Tipo_tutor']
                );
                $tutores[] = $tutor;
            }
            return $tutores;
        }
        catch(Exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }



    /**
     * Reutiliza el metodo listarTutor de la capa lógica para:
     * → obtener un tutor específico a partir de su ID.
     * → optimizar la reducción de código en el Gestor_Tutor.
     * @param string $legajo → El identificado principal del tutor dentro del código.
     * @return Tutor → El objeto que representa al Tutor junto a todos sus datos.
     */
    public function obtenerTutor(string $legajo):Tutor
    {
        $tutores = $this->listarTutores();
        foreach($tutores as $tutor)
        {
            if ($tutor->getLegajo() === $legajo) 
            {
                return $tutor;
            }
        }
    }


    /**
     * Permite la negociación de los datos para dar el alta de un nuevo tutor alumno universitario.
     * @param string    $legajo             → El dato con el que se identifica el tutor en su dominio.
     * @param string    $nombre             → El nombre principal de la identidad del tutor.
     * @param string    $apellido           → El identificador familiar del tutor.
     * @param string    $genero             → El dato que identifica si es de género Masculino o Femenino.
     * @param DateTime  $fecha_nacimiento   → La fecha de nacimiento del tutor.
     * @param int       $numero_documento   → El número de la identidad nacional del tutor.
     * @param string    $tipo_documento     → El tipo de documento que representa la nacionalidad del tutor.
     * @param bool      $habilitado         → La medida de seguridad para habilitar o deshabilitar un tutor.
     * @param string    $tipo_tutor         → El dato que permite identificar si es Alumno o Trabajador.
     * @param string    $provincia          → La provincia donde reside el tutor.
     * @param string    $localidad          → La localidad donde reside el tutor.
     * @param int       $codigo             → El código postal perteneciente a la localidad del tutor.
     * @param string    $barrio             → El barrio donde reside el tutor.
     * @param string    $calle              → La calle donde reside el tutor.
     * @param string    $numero             → El numero de casa del domicilio del tutor, a veces se describe como lote.
     * @param int       $codigo_carrera     → El código de la carrera principal que transcurre el tutor Alumno.
     * @return void No devuelve nada despues de su ejecución.
     */
    public function darAltaTutorAlumno(string $legajo, string $nombre, string $apellido, string $genero, DateTime $fecha_nacimiento, int $numero_documento, string $tipo_documento, bool $habilitado, string $tipo_tutor, string $provincia, string $localidad, int $codigo, string $barrio, string $calle, string $numero, int $codigo_carrera):void
    {
        $this->tutor = new Tutor(0, $legajo, $nombre, $apellido, $numero_documento, $tipo_documento, $fecha_nacimiento, $genero, $habilitado, $tipo_tutor);
        $this->domicilio = new Domicilio($provincia, $localidad, $codigo, $barrio, $calle, $numero);

        $nombre_carrera = $this->obtenerNombreCarrera($codigo_carrera);
        $this->carrera = new Carrera(0,$codigo_carrera, $nombre_carrera);
        $this->crud->darAltaTutorAlumno($this->tutor, $this->domicilio, $this->carrera);
    }



    /**--------------------------------- Metodos de la Carrera ---------------------------------**/

    /**
     * Esta función permite obtener todas las carreras de forma dinamica, brindando el nombre de la carrera
     * para complementarse con el alta de un tutor alumno, utilizando Excel para futuras modificaciones sin
     * comprometer el código para mayor seguridad.
     * @param Int $codigo_carrera → brinda el código de carrera para devolver el nombre de la misma.
     * @return String $nombre → el nombre de la carrera.
     */
    public function obtenerNombreCarrera(int $codigo_carrera):string
    {
        $archivoExcel = '../Logica/CARRERAS-EXCEL/Carreras_universitarias.xlsx';
        try 
        {
            $hoja_calculo = IOFactory::load($archivoExcel);
            $hoja_trabajo = $hoja_calculo->getActiveSheet();
            $ultima_fila = $hoja_trabajo->getHighestRow();
    
            for ($fila = 1; $fila <= $ultima_fila; $fila++) 
            {
                $codigo = $hoja_trabajo->getCell('A' . $fila)->getValue();
                $nombre = $hoja_trabajo->getCell('B' . $fila)->getValue();
    
                if ($codigo == $codigo_carrera) 
                {
                    return $nombre;
                }
            }
            return "No existe la carrera con el código: $codigo";
        } 
        catch (Exception $e) 
        {
            return "Error al cargar el archivo Excel: " . $e->getMessage();
        }
    }
    
    /**
     * Obtiene una lista de carreras a partir de los datos obtenidos de la capa de datos CRUD_Tutor.
     * @return array Un array de objetos Carrera que representa la lista de carreras.
     */
    public function listarCarreras(): array
    {
        $carreras = [];
        try 
        {
            $datosCarrera = $this->crud->listarCarreras();
            foreach ($datosCarrera as $datoCarrera) 
            {
                $this->carrera = new Carrera(
                    $datoCarrera['id_carrera'],
                    $datoCarrera['Codigo_carrera'],
                    $datoCarrera['Nombre']
                );
                $carreras[] = $this->carrera;
            }
            return $carreras;
        } 
        catch (Exception $ex) 
        {
            echo 'En la linea ' . $ex->getLine() . ' se produjo el error ' . $ex->getMessage() .
            ', del archivo ubicado en: ' . $ex->getFile();
            die();
        }
    }

    /**
     * Reutiliza el metodo listarCarrera de la capa lógica para:
     * → obtener una carrera específica a partir de su Código.
     * → optimizar la reducción de código en el Gestor_Tutor.
     * @param int $codigo → El código de la carrera.
     * @return Carrera → El objeto que representa a la Carrera junto a todos sus datos.
     */
    public function obtenerCarrera(int $codigo):Carrera
    {
        $carreras = $this->listarCarreras();
        foreach($carreras as $carrera)
        {
            if($carrera->getCodigo() === $codigo)
            {
                return $carrera;
            }
        }
    }

    /**-------------------------------- Metodos de la Asignatura --------------------------------*/

    /**
     * Esta función permite obtener todas las asignaturas de forma dinamica, brindando el código y nombre
     * para complementarse con el alta de un tutor alumno, utilizando Excel para futuras modificaciones sin
     * comprometer el código para mayor seguridad.
     * @param Int $codigo_carrera → brinda el código de carrera para devolver las asignaturas correspondientes.
     * @return array Asignaturas → el arreglo de Asignaturas.
     */
    public function obtenerAsignaturas(int $codigo_carrera):array
    {
        $archivoExcel = '../Logica/CARRERAS-EXCEL/'.$codigo_carrera.'.xlsx';
        $materias = [];

        try 
        {
            $hoja_calculo = IOFactory::load($archivoExcel);
            $hoja_trabajo = $hoja_calculo->getActiveSheet();
            $ultima_fila = $hoja_trabajo->getHighestRow();

            for ($fila = 2; $fila <= $ultima_fila; $fila++) 
            {
                // Obtiene los datos de cada fila
                $codigo = $hoja_trabajo->getCell('A' . $fila)->getValue();
                $nombre = $hoja_trabajo->getCell('B' . $fila)->getValue();

                $this->asignatura = new Asignatura(
                    0,
                    $codigo,
                    $nombre,
                    $fecha = new datetime,
                    ' ',
                    0
                );
                $materias[] = $this->asignatura;
            }
            return $materias;
        } 
        catch (Exception $e) 
        {
            echo 'Error al leer el archivo de Excel: ',  $e->getMessage();
            return null;
        }
    }



    /**
     * El método carga un arreglo de asignaturas a su carrera y tutor alumno correspondiente
     * a travez de un legajo y el código de la carrera que identifica el vínculo con la asignaturas.
     * Se contempla una complejidad para su ejecución
     *      → llama obtenerCarrera con el código de la misma
     *      → llama obtenerTutor con su legajo.
     *      → llama obtenerAsignaturas para obtener un arreglo de asignaturas con el código de carrera.
     * @param string $legajo            → El identificador de 13 digítos del tutor.
     * @param int    $codigo_carrera    → El código identificador de la carrera.
     * @return void  No devuelve nada durante su ejecución.
     */
    public function cargarAsignaturas(string $legajo, int $codigo_carrera):void
    {
        try
        {
            $carrera = $this->obtenerCarrera($codigo_carrera);
            $tutor = $this->obtenerTutor($legajo);
            $asignaturas = $this->obtenerAsignaturas($codigo_carrera);

            if ($tutor->getTipoTutor() === 'Alumno') 
            {
                foreach ($asignaturas as $asignatura) 
                {
                    $this->crud->cargarAsignaturas($asignatura, $tutor->getId(), $carrera->getID());
                }
            }
        }
        catch(Exception $ex)
        {
            echo 'En la linea ' . $ex->getLine() . ' se produjo el error ' . $ex->getMessage() .
            ', del archivo ubicado en: ' . $ex->getFile();
            die();
        }
    }
    

}

















// Ejemplo de uso
/*
$carreras = $gestorCarrera->cargarAsignaturas(16);

// Hacer algo con $carreras, como mostrarlas en pantalla
if ($carreras !== null) {
    foreach ($carreras as $carrera) {
        echo 'Código: ' . $carrera['codigo'] . ', Nombre: ' . $carrera['nombre'] . '<br>';
    }
}*/
/*
$codigoCarrera = "912"; // Código de la carrera a buscar
$nombreCarrera = $gestorCarrera->obtenerNombreCarrera($codigoCarrera);
echo "El nombre de la carrera con código $codigoCarrera es: $nombreCarrera";*/
/*


$gestorCarrera = new GestorTutor();*/
//$carreras = $gestorCarrera->cargarAsignaturas(9,914);

// Iterar sobre el arreglo de carreras y mostrarlas
//echo $carreras->__toString();
/*echo "<pre>";
print_r($carreras);
echo "</pre>";

$gestorCarrera->cargarAsignaturas('1-17151415/45',74);
?>*/
