<?php 

class Sala implements JsonSerializable
{
    private int $id;
    private string $nombre;
    private int $edad;
    private int $capacidad;

    function __construct(int $id, string $nombre, int $edad, int $capacidad)
    {
        $this->id = $id;
        $this->setNombre($nombre);
        $this->setCapacidad($capacidad);
        $this->setEdad($edad);
    }

    public function getID():int
    {
        return $this->id;
    }

    public function getNombre():string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre):void
    {
        if(strlen($nombre) <= 30)
        {
            $this->nombre = $nombre;
        }
        else
        {
            throw new InvalidArgumentException("El nombre de la sala debe tener máximo 30 caracteres.");
        }
        
    }

    public function getEdad():int
    {
        return $this->edad;
    }

    public function setEdad(int $edad):void
    {
        if(strlen((string)$edad) == 1)
        {
            $this->edad = $edad;
        }
        else
        {
            throw new InvalidArgumentException("El rango de edad debe ser de 1 digito.");
        }
    }

    public function getCapacidad():int
    {
        return $this->capacidad;
    }

    public function setCapacidad(int $capacidad):void
    {
        if(strlen((string)$capacidad) <= 2)
        {
            $this->capacidad = $capacidad;
        }
        else
        {
            throw new InvalidArgumentException("La capacidad debe ser máximo de 2 digito.");
        }
    }

    public function __toString():string
    {
        return "ID = ".$this->getId().
            " Nombre = ".$this->getNombre().
            " Edad = ".$this->getEdad().
            " Capacidad = ".$this->getCapacidad();
    }

/*********************************************************************************/

    /**
     * Permite convertir los datos del objeto Sala a JSON
     * para su manejo dentro de las funciones JavaScript.
     */
    public function jsonSerialize()
    {
        return [
            'id_sala' => $this->getId(),
            'nombre' => $this->getNombre(),
            'edad' => $this->getEdad(),
            'capacidad' => $this->getCapacidad()
        ];
    }

}
?>