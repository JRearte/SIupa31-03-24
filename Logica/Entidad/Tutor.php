<?php
require_once "Individuo.php";

class Tutor extends Individuo
{
    private string $legajo;
    private string $tipo_tutor;

    public function __construct(int $id, string $legajo, string $nombre, string $apellido, int $numero_documento, string $tipo_documento, DateTime $fecha_nacimiento, string $genero, bool $habilitado, string $tipo_tutor)
    {
        parent::__construct($id,$nombre,$apellido,$numero_documento,$tipo_documento,$fecha_nacimiento,$genero,$habilitado);
        $this->legajo = $legajo;
        $this->tipo_tutor = $tipo_tutor;
    }

    public function getLegajo():string
    {
        return $this->legajo;
    }

    public function setLegajo(string $legajo):void
    {
        $this->legajo = $legajo;
    }

    public function getTipoTutor():string
    {
        return $this->tipo_tutor;
    }

    public function setTipoTutor(string $tipo_tutor):void
    {
        $this->tipo_tutor = $tipo_tutor;
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
            " Tipo de Tutor = ".$this->getTipoTutor().
            " Habilitado = " .$this->getHabilitado();
    }
}

?>