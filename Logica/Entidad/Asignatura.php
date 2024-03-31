<?php
require_once "Carrera.php";

class Asignatura extends Carrera
{
    private DateTime $fecha;
    private string $condicion;
    private int $calificacion;

    public function __construct(int $id,int $codigo,string $nombre,DateTime $fecha,string $condicion,int $calificacion)
    {
        parent::__construct($id,$codigo,$nombre);
        $this->fecha = $fecha;
        $this->setCondicion($condicion);
        $this->setCalificacion($calificacion);
    }

    public function getFecha():DateTime
    {
        return $this->fecha;
    }

    public function setFecha(DateTime $fecha):void
    {
        $this->fecha = $fecha;
    }

    public function getCondicion():string
    {
        return $this->condicion;
    }

    public function setCondicion(string $condicion): void
    {
        if(strlen($condicion) <= 8)
        {
            $this->condicion = $condicion;
        }
        else
        {
            throw new InvalidArgumentException("La condición debe tener máximo 8 caracteres");
        }
    }

    public function getCalificacion():int
    {
        return $this->calificacion;
    }

    public function setCalificacion(int $calificacion):void
    {
        if(strlen((string)$calificacion) <= 2)
        {
            $this->calificacion = $calificacion;
        }
        else
        {
            throw new InvalidArgumentException("La calificación debe tener máximo 2 digitos");
        }
    }

    public function __toString():string
    {
        return "Código de asignatura = ".$this->getCodigo().
            " Nombre de asignatura = ".$this->getNombre().
            " Fecha = ".$this->getFecha()->format('d-m-Y').
            " Condición = ".$this->getCondicion().
            " Calificación = ".$this->getCalificacion();
    }
}
?>