<?php
class DatoMedico
{
    private int $id;
    private string $tipo;
    private string $nombre;

    public function __construct(int $id, string $tipo, string $nombre) 
    {
        $this->id = $id;
        $this->setTipo($tipo);
        $this->setNombre($nombre);
    }

    public function getId():int 
    {
        return $this->id;
    }

    public function getNombre():string 
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre):void
    {
        if(strlen($nombre) <= 60)
        {
            $this->nombre = $nombre;
        }
        else
        {
            throw new InvalidArgumentException("El nombre del dato médico debe tener máximo 60 caracteres");
        }
    }

    public function getTipo():string 
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo):void
    {
        if(strlen($tipo) <= 12)
        {
            $this->tipo = $tipo;
        }
        else
        {
            throw new InvalidArgumentException("El tipo de dato médico debe tener máximo 12 caracteres");
        }
    }

    public function __toString():string 
    {
        return "ID:" .$this->id ."Nombre:".$this->nombre;
    }
}

?>