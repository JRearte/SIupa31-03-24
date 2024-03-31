<?php
class Telefono 
{
    private int $id;
    private int $numero;

    public function __construct(int $id, int $numero) 
    {
        $this->id = $id;
        $this->numero = $numero;
    }

    public function getId():int 
    {
        return $this->id;
    }

    public function getNumero():int 
    {
        return $this->numero;
    }

    public function setNumero(int $numero):void 
    {
        $this->numero = $numero;
    }

    public function __toString():string 
    {
        return "ID: ".$this->getId().
            " Número de Teléfono: ".$this->getNumero();
    }
}
?>