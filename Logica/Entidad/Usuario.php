<?php

require_once 'Persona.php';

class Usuario extends Persona implements JsonSerializable
{
    private string $legajo;
    private string $categoria;
    private string $clave;
    
    function __construct(int $id, string $legajo, string $nombre, string $apellido,  string $categoria, string $clave, bool $habilitado)
    {
        parent::__construct($id,$nombre,$apellido,$habilitado);
        $this->setLegajo($legajo);
        $this->setCategoria($categoria);
        $this->setClave($clave);
    }

    public function getLegajo():string
    {
        return $this->legajo;
    }

    public function setLegajo(string $legajo):void
    {
        if(strlen($legajo)==13)
        {
            $this->legajo = $legajo; 
        }
        else
        {
            throw new InvalidArgumentException("El legajo debe tener 13 caracteres");              //LANZAMIENTO
        }
    }

    public function getCategoria():string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria):void
    {
        if(strlen($categoria)<=11)
        {
            $this->categoria = $categoria;
        }
        else
        {
            throw new InvalidArgumentException("La categoria debe tener máximo 11 caracteres");
        }
    }

    public function getClave():string
    {
        return $this->clave;
    }

    public function setClave(string $clave):void
    {
        if (strlen($clave)<=20) 
        {
            $this->clave = $clave;
        } 
        else 
        {
            throw new InvalidArgumentException("La clave debe tener máximo 20 caracteres.");
        }
    }

    public function __toString():string
    {
        return "ID = ".$this->getId().
            " Legajo = ".$this->getLegajo().
            " Nombre = ".$this->getNombre(). 
            " Apellido = ".$this->getApellido().
            " Categoria = ".$this->getCategoria().
            " Clave = ".$this->getClave().
            " Habilitado = ".$this->getHabilitado();
    }

    /**
     * Permite convertir los datos del objeto Usuario a JSON
     * para su manejo dentro de las funciones JavaScript.
     */
    public function jsonSerialize() //similar al toString, pero es para visualizar datos en la consola del navegador
    {
        return [
            'id' => $this->getId(),
            'legajo' => $this->getLegajo(),
            'nombre' => $this->getNombre(),
            'apellido' => $this->getApellido(),
            'categoria' => $this->getCategoria(),
            'clave' => $this->getclave(),
            'habilitado' => $this->getHabilitado(),
        ];
    }
}
?>

