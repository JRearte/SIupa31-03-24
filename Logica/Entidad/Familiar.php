<?php 
require_once "Individuo.php";

class Familiar extends Individuo
{
    private string $lugar_trabajo;
    private float $ingreso;

    function __construct(int $id, string $nombre, string $apellido, int $numero_documento, string $tipo_documento, DateTime $fecha_nacimiento, string $genero, bool $habilitado, string $lugar_trabajo, float $ingreso)
    {
        parent::__construct($id,$nombre,$apellido,$numero_documento,$tipo_documento,$fecha_nacimiento,$genero,$habilitado);
        $this->setLugarTrabajo($lugar_trabajo);
        $this->ingreso = $ingreso;
    }

    public function getLugarTrabajo():string 
    {
        return $this->lugar_trabajo;
    }

    public function setLugarTrabajo(string $lugar_trabajo):void 
    {
        if(strlen($lugar_trabajo) <= 40)
        {
            $this->lugar_trabajo = $lugar_trabajo;
        }
        else
        {
            throw new InvalidArgumentException("El lugar de trabajo solo puede tener un máximo 40 caracteres.");
        }
    }

    public function getIngreso():float
    {
        return $this->ingreso;
    }

    public function setIngreso(float $ingreso):void 
    {
        $this->ingreso = $ingreso;
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
            " Habilitado = ".$this->getHabilitado().
            " Lugar de trabajo = ".$this->getLugarTrabajo().
            " Ingreso = ".$this->getIngreso();
    }
}
?>