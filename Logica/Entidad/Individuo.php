<?php

require_once "Persona.php";

abstract class Individuo extends Persona
{
    private int $numero_documento;
    private string $tipo_documento;
    private DateTime $fecha_nacimiento; 
    private string $genero; //vinculo

    function __construct(int $id, string $nombre, string $apellido, int $numero_documento, string $tipo_documento, DateTime $fecha_nacimiento, string $genero, bool $habilitado)
    {
        parent::__construct($id,$nombre,$apellido,$habilitado);
        $this->setNumeroDocumento($numero_documento);
        $this->setTipoDocumento($tipo_documento);
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->setGenero($genero);
    }

    public function getNumeroDocumento():int
    {
        return $this->numero_documento;
    }

    public function setNumeroDocumento(int $numero_documento):void
    {
        if(strlen((string) $numero_documento) === 8)
        {
            $this->numero_documento = $numero_documento;
        }
        else
        {
            throw new InvalidArgumentException("El número de documento debe tener 8 digitos");
        }
    }

    public function getTipoDocumento():string
    {
        return $this->tipo_documento;
    }

    public function setTipoDocumento(string $tipo_documento):void
    {
        if(strlen($tipo_documento) <= 15)
        {
            $this->tipo_documento = $tipo_documento;
        }
        else
        {
            throw new InvalidArgumentException("El tipo de documento debe tener máximo 15 caracteres");
        }
    }

    public function getFechaNacimiento():DateTime
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(DateTime $fecha_nacimiento):void
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    /**
     * Reutilizació de variable género pero en referencia de vinculo familiar
     * */
    public function getGenero():string
    {
        return $this->genero;
    }

    public function setGenero(string $genero):void
    {
        if(strlen($genero) <= 9)
        {
            $this->genero = $genero;
        }
        else
        {
            throw new InvalidArgumentException("El género debe tener máximo 9 caracteres");
        }
    }

    public function __toString():string
    {
        return "ID = " .$this->getId().
            " Nombre = " .$this->getNombre().
            " Apellido = " .$this->getApellido().
            " Número de documento = " .$this->getNumeroDocumento().
            " Tipo de documento = " .$this->getTipoDocumento().
            " Fecha de nacimiento = " .$this->getFechaNacimiento()->format('d-m-Y').
            " Vinculo = " .$this->getGenero().
            " Habilitado = ".$this->getHabilitado();
    }
}
?>