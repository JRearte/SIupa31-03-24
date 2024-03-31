<?php
class Correo 
{
    private int $id;
    private string $mail;

    public function __construct(int $id, string $mail) 
    {
        $this->id = $id;
        $this->setMail($mail);
    }

    public function getId():int 
    {
        return $this->id;
    }

    public function getMail():string 
    {
        return $this->mail;
    }

    public function setMail(string $mail):void 
    {
        if(strlen($mail) <= 45)
        {
            $this->mail = $mail;
        }
        else
        {
            throw new InvalidArgumentException("El mail debe tener máximo 45 caracteres.");
        }
    }

    public function __toString():string 
    {
        return "ID: ".$this->getId().
            " Correo: ".$this->getMail();
    }
}
?>
