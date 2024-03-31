<?php

abstract class Persona
{
    private int $id;
    private string $nombre;
    private string $apellido;
    private bool $habilitado;

    function __construct(int $id, string $nombre, string $apellido, bool $habilitado)
    {
        $this->setID($id);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->habilitado = $habilitado;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setID(int $id):void
    {
        $this->id = $id;
    }

    public function getNombre():string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre):void
    {
        if (strlen($nombre) <= 20) 
        {
            $this->nombre = $nombre;
        } 
        else
        {
            throw new InvalidArgumentException("El nombre debe tener máximo 20 caracteres.");
        }
    }

    public function getApellido():string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido):void
    {
        if (strlen($apellido) <= 20)
        {
            $this->apellido = $apellido;
        }
        else
        {
            throw new InvalidArgumentException("El apellido debe tener máximo 20 caracteres.");
        }
    }

    public function getHabilitado()
    {
        return $this->habilitado;
    }

    public function setHabilitado(bool $habilitado)
    {
        $this->habilitado - $habilitado;
    }
}
?>