<?php

class Mysql
{
    /**
     * ESTOS ATRIBUTOS LOS USARE PARA EVITAR LA LLAMADA
     * EN CADA METODO DE CADA CLASE CRUD, REDUCIENDO LA
     * CANTIDAD DE VECES QUE SE LLAMARAN POR CLASES.
     */
    public mysqli $conexion; 
    public mysqli_result $resultado;
    public mysqli_stmt $stmt;
    /**
     * SIENDO PUBLICAS, SE PUEDEN MANEJAR DE FORMA EFICIENTE
     * NOTA → intentar manejarlos en privado usando un get no
     * funciona, ya que requieren un valor predeterminado, esto
     * solo funcionaria con el atributo $conexión.
     */
    private string $usuario = "root";
    private string $servidor = "localhost";
    private string $basedatos = "jardin";
    private string $contrasenia = "37202750y";

    public function __construct()
    {
        $this->conexion = mysqli_connect($this->servidor,$this->usuario,$this->contrasenia,$this->basedatos);
    }
    //crear archivo de configuración
}
?>

