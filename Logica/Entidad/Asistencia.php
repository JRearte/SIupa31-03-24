<?php
class Asistencia
{
    private int $id;
    private DateTime $fecha;
    private DateTime $hora;
    private string $tipo_inasistencia;

    public function __construct(int $id,DateTime $fecha,DateTime $hora,string $tipo_inasistencia)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->setTipoInasistencia($tipo_inasistencia);
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function getFecha():DateTime 
    {
        return $this->fecha;
    }

    public function setFecha(DateTime $fecha):void 
    {
        $this->fecha = $fecha;
    }

    public function getHora():DateTime 
    {
        return $this->hora;
    }

    public function setHora(DateTime $hora):void 
    {
        $this->hora = $hora;
    }

    public function getTipoInasistencia():string 
    {
        return $this->tipo_inasistencia;
    }

    public function setTipoInasistencia(string $tipo_inasistencia):void 
    {
        if(strlen($tipo_inasistencia) <= 13)
        {
            $this->tipo_inasistencia = $tipo_inasistencia;
        }
        else
        {
            throw new InvalidArgumentException("El tipo de inasistencia debe tener máximo 13 caracteres.");
        }
    }

    public function __toString():string 
    {
        return "ID: " .$this->getId().
            " Fecha: ".$this->getFecha()->format('d-m-Y').
            " Hora: ".$this->getHora()->format('H:i').
            " Tipo de Inasistencia: ".$this->getTipoInasistencia();
    }
}
?>