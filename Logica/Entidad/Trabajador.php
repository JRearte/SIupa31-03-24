<?php
require_once "Tutor.php";

class Trabajador extends Tutor
{
    private int $horas_trabajo;
    private string $cargo_trabajo;
    private string $tipo_trabajador;

    public function __construct(int $id, string $legajo, string $nombre, string $apellido, int $numero_documento, string $tipo_documento, DateTime $fecha_nacimiento, string $genero, int $horas_trabajo, string $cargo_trabajo, string $tipo_trabajador, bool $habilitado, string $tipo_tutor)
    {
        parent::__construct($id,$legajo,$nombre,$apellido,$numero_documento,$tipo_documento,$fecha_nacimiento,$genero,$habilitado,$tipo_tutor);
        $this->horas_trabajo = $horas_trabajo;
        $this->setCargoTrabajo($cargo_trabajo);
        $this->setTipoTrabajador($tipo_trabajador);
    }

    public function getHorasTrabajo():int
    {
        return $this->horas_trabajo;
    }

    public function setHorasTrabajo(int $horas_trabajo):void
    {
        $this->horas_trabajo = $horas_trabajo;
    }

    public function getCargoTrabajo():string
    {
        return $this->cargo_trabajo;
    }

    public function setCargoTrabajo(string $cargo_trabajo):void
    {
        if(strlen($cargo_trabajo) <= 35)
        {
            $this->cargo_trabajo = $cargo_trabajo;
        }
        else
        {
            throw new InvalidArgumentException("El cargo de trabajo debe tener máximo 35 caracteres.");
        }
    }

    public function getTipoTrabajador():string
    {
        return $this->tipo_trabajador;
    }

    public function setTipoTrabajador(string $tipo_trabajador):void
    {
        if(strlen($tipo_trabajador) <= 10)
        {
            $this->tipo_trabajador = $tipo_trabajador;
        }
        else
        {
            throw new InvalidArgumentException("El tipo de trabajor debe tener máximo 10 caracteres.");
        }
    }

    public function __toString():string
    {
        return "ID = " .$this->getId().
            " Legajo = ".$this->getLegajo().
            " Nombre = " .$this->getNombre().
            " Apellido = " .$this->getApellido().
            " Número de documento = " .$this->getNumeroDocumento().
            " Tipo de documento = " .$this->getTipoDocumento().
            " Fecha de nacimiento = " .$this->getFechaNacimiento()->format('d-m-Y').
            " Género = " .$this->getGenero().
            " Cargo de trabajo = ".$this->getCargoTrabajo().
            " Tipo de Trabajador = ".$this->getTipoTrabajador().
            " Habilitado = ".$this->getHabilitado().
            " Tipo de tutor = ".$this->getTipoTutor();
    }
}
?>