<?php
class Domicilio
{
    private string $provincia;
    private string $localidad;
    private int $codigo_postal;
    private string $barrio;
    private string $calle;
    private string $numero;

    public function __construct(string $provincia,string $localidad,int $codigo_postal,string $barrio,string $calle,string $numero)
    {
        $this->setProvincia($provincia);
        $this->setLocalidad($localidad);
        $this->setCodigoPostal($codigo_postal);
        $this->setBarrio($barrio);
        $this->setCalle($calle);
        $this->setNumero($numero);
    }

    public function getProvincia():string
    {
        return $this->provincia;
    }

    public function setProvincia(string $provincia):void
    {
        if(strlen($provincia) <= 50)
        {
            $this->provincia = $provincia;
        }
        else
        {
            throw new InvalidArgumentException("La provincia debe tener máximo 50 caracteres");
        }
    }

    public function getLocalidad():string
    {
        return $this->localidad;
    }

    public function setLocalidad(string $localidad):void
    {
        if(strlen($localidad) <= 40)
        {
            $this->localidad = $localidad;
        }
        else
        {
            throw new InvalidArgumentException("La localidad debe tener máximo 40 caracteres");
        }
    }

    public function getCodigoPostal():int
    {
        return $this->codigo_postal;
    }

    public function setCodigoPostal(int $codigo_postal):void
    {
        if(strlen((string) $codigo_postal) <= 4)
        {
            $this->codigo_postal = $codigo_postal;
        }
        else
        {
            throw new InvalidArgumentException("El codigo postal debe tener máximo 4 digitos");
        }
    }

    public function getBarrio():string
    {
        return $this->barrio;
    }

    public function setBarrio(string $barrio):void
    {
        if(strlen($barrio) <= 30)
        {
            $this->barrio = $barrio;
        }
        else
        {
            throw new InvalidArgumentException("El barrio debe tener máximo 30 caracteres");
        }
    }

    public function getCalle():string
    {
        return $this->calle;
    }

    public function setCalle(string $calle):void
    {
        if(strlen($calle) <= 40)
        {
            $this->calle = $calle;
        }
        else
        {
            throw new InvalidArgumentException("La calle debe tener máximo 40 caracteres");
        }
    }

    public function getNumero():string
    {
        return $this->numero;
    }

    public function setNumero(string $numero):void
    {
        if(strlen($numero) <= 12)
        {
            $this->numero = $numero;
        }
        else
        {
            throw new InvalidArgumentException("El numero de casa debe tener máximo 12 caracteres");
        }
    }

    public function __toString():string
    {
        return "Provincia = ".$this->getProvincia().
            " Localidad = ".$this->getLocalidad().
            " Código postal = ".$this->getCodigoPostal().
            " Barrio = ".$this->getBarrio().
            " Calle = ".$this->getCalle().
            " Número = ".$this->getNumero();
    }
}
?>