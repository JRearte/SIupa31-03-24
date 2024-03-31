<?php
class Carrera
{
    private int $id;
    private int $codigo;
    private string $nombre;

    public function __construct(int $id,int $codigo,string $nombre)
    {
        $this->id = $id;
        $this->setCodigo($codigo);
        $this->setNombre($nombre);
    }

    public function getID()
    {
        return $this->id;
    }

    public function setID(int $id)
    {
        $this->id = $id;
    }

    public function getCodigo():int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo):void
    {
        if(strlen((string)$codigo) <= 4)
        {
            $this->codigo = $codigo;
        }
        else
        {
            throw new InvalidArgumentException("El código debe tener máximo 4 digitos");
        }
    }

    public function getNombre():string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre):void
    {
        if(strlen($nombre) <= 90)
        {
            $this->nombre = $nombre;
        }
        else
        {
            throw new InvalidArgumentException("El nombre debe tener máximo 90 caracteres");
        }
    }

    public function __toString():string
    {
        return "Código de carrera = ".$this->getCodigo().
            " Nombre de carrera = ".$this->getNombre();
    }
}
?>