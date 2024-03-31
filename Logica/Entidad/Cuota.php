<?php
class Cuota 
{
    private int $id;
    private float $valor;
    private DateTime $fecha;

    public function __construct(int $id,float $valor,DateTime $fecha) 
    {
        $this->id = $id;
        $this->valor = $valor;
        $this->fecha = $fecha;
    }

    public function getId():int 
    {
        return $this->id;
    }

    public function getValor():float 
    {
        return $this->valor;
    }

    public function setValor(float $valor):void 
    {
        $this->valor = $valor;
    }

    public function getFecha():DateTime 
    {
        return $this->fecha;
    }

    public function setFecha(DateTime $fecha):void 
    {
        $this->fecha = $fecha;
    }

    public function __toString():string 
    {
        return "ID: ".$this->getId().
            " Valor: $".number_format($this->getValor(), 2).
            " Fecha: ".$this->getFecha()->format('d-m-Y');
    }
}
?>
