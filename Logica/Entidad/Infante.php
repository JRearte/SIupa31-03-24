<?php

require_once "Individuo.php";

class Infante extends Individuo
{
    private string $categoria;
    private DateTime $fecha_asignacion;

    function __construct(int $id, string $nombre, string $apellido, int $numero_documento, string $tipo_documento, DateTime $fecha_nacimiento, string $genero ,string $categoria, DateTime $fecha_asignacion, bool $habilitado)
    {
        parent::__construct($id,$nombre,$apellido,$numero_documento,$tipo_documento,$fecha_nacimiento,$genero,$habilitado);
        $this->categoria = $categoria;
        $this->fecha_asignacion = $fecha_asignacion;
    }

    public function getCategoria():string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria):void
    {
        $this->categoria = $categoria;
    }

    public function getFechaAsignacion():DateTime
    {
        return $this->fecha_asignacion;
    }

    public function setFechaAsignacion(DateTime $fecha_asignacion):void
    {
        $this->fecha_asignacion = $fecha_asignacion;
    }

    public function __toString():string
    {
        return "ID = " .$this->getId().
            " Nombre = " .$this->getNombre().
            " Apellido = " .$this->getApellido().
            " Número de documento = " .$this->getNumeroDocumento().
            " Tipo de documento = " .$this->getTipoDocumento().
            " Fecha de nacimiento = " .$this->getFechaAsignacion()->format('d-m-Y').
            " Género = " .$this->getGenero().
            " Categoria = " .$this->getCategoria().
            " Fecha de asignación = " .$this->getFechaAsignacion()->format('d-m-Y').
            " Habilitado = ".$this->getHabilitado();
    }
}

?>