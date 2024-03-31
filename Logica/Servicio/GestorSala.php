<?php
require_once '../Logica/Entidad/Sala.php';
require_once __DIR__ . '/../../Dato/CRUD_Sala.php';

class GestorSala
{
    private Sala $sala;

    public function __construct()
    {
    }

    /**
     * Obtiene una lista de salas a partir de los datos obtenidos de la capa de datos CRUD_Sala.
     * @return array Un array de objetos Salas que representa la lista de salas.
     */
    public function listarSalas():array
    {
        try
        {
            $crudSala = new CRUD_Sala();
            $datosSala = $crudSala->listarSalas();
            foreach($datosSala as $datoSala)
            {
                $this->sala = new Sala(
                    $datoSala['id_sala'],
                    $datoSala['Nombre_de_sala'],
                    $datoSala['Rango_de_edad'],
                    $datoSala['Capacidad']
                );
                $salas[] = $this->sala;
            }
            return $salas;
        }
        catch(Exception $ex)
        {
            echo 'En la linea '.$ex->getLine().' se produjo el error '.$ex->getMessage().
            ', del archivo ubicado en: '.$ex->getFile();
            die();
        }
    }

    /**
     * Reutiliza el metodo listarSala de la capa lógica para:
     * -> obtener una sala especifica a partir de su ID.
     * -> optimizar la reducción de código en el CRUD_Sala.
     * @param int $id -> El identificador principal de la sala dentro del código.
     * @return Sala -> El objeto que representa a la Sala junto a todos sus datos.
     */
    public function obtenerSala(int $id): Sala
    {
        $datosSala = $this->listarSalas();
        foreach($datosSala as $datoSala)
        {
            if($datoSala->getID() === $id)
            {
                return $datoSala;
            }
        }

    }

    /**
     * Permite la negociación de los datos para dar el alta de una nueva sala.
     * @param string $nombre -> El nombre que identifica a la sala.
     * @param int $edad -> La edad limite que admite la sala.
     * @param int $capacidad -> El valor que determinara cuantos niños pueden estar dentro de la sala.
     * @return void No devuelve nada despues de su ejecución.
     */
    public function darAltaSala(string $nombre,int $edad,int $capacidad):void
    {
        $this->sala = new Sala(0,$nombre,$edad,$capacidad);
        $crud = new CRUD_Sala();
        $crud->darAltaSala($this->sala);
    }


    /**
     * Permite la negociación de los datos para la modificación de una sala.
     * @param int $id -> El identificado principal de la sala dentro del código.
     * @param string $nombre -> El nombre que identifica a la sala.
     * @param int $edad -> La edad limite que admite la sala.
     * @param int $capacidad -> El valor que determinara cuantos niños pueden estar dentro de la sala.
     * @return void No devuelve nada despues de su ejecución.
     */
    public function modificarSala(int $id, string $nombre, int $edad,int $capacidad):void
    {
        $this->sala = new Sala($id,$nombre,$edad,$capacidad);
        $crud = new CRUD_Sala();
        $crud->modificarSala($this->sala);
    }

    /**
     * Permite la negociación de los datos para dar la baja de una sala.
     * @param int $id -> El identificador principal de la sala dentro del código.
     * @return void No devuelve nada despues de su ejecución.
     */
    public function darBajaSala(int $id):void
    {
        $crud = new CRUD_Sala();
        $crud->darBajaSala($id);
    }
}

?>