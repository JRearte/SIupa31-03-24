<?php
require('../Libreria/FPDF/fpdf.php');
require_once ("../Logica/Servicio/GestorUsuario.php");

class Reporte extends FPDF 
{
    
    private $fecha;
    private string $titulo;
    private $cabecera;
    private int $ancho;
    private int $ejeX;
    private int $ejeY;

    public function __construct()
    {
        parent::__construct(); //Herencia de las funciones FPDF
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $this->fecha = date('d/m/Y');
    }


    /**
     * Configuración predeterminada para la "Cabecera de página"
     */
    function Header()
    {
        //Fondo de cabecera principal
        $this->SetFillColor(71, 133, 213); //cambio de color
        $this->Rect(0,0,$this->GetPageWidth(),8,'F');

        //Logo
        $this->image('../Presentacion/css/imagen/jardin2.png',170,10,20,27);

        //Firma del sistema
        $this->SetXY(25, $this->GetY()+4);
        $this->SetTextColor(161, 169, 179);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10,"Sistema de Informacion Upa", 0, 1, 'L');

        //Título
        $this->SetXY(25,$this->GetY()-2);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10,$this->titulo, 0, 1, 'L');

        //Cabecera dinámica, en dependencia de los valores de los objetos
        $this->SetXY($this->ejeX,$this->ejeY);
        $this->SetFillColor(200, 200, 200); //cambio de color
        $this->Rect($this->ejeX,$this->ejeY,$this->ancho,10,'F');
        $this->SetFont('Arial', 'B', 10);
        foreach($this->cabecera as $datos)
        {
            $this->Cell(40, 10,$datos,1, 0,'C');
        }
        $this->Ln();//Salto de línea
    }

    /**
     * Configuración predeterminado para el "Pie de página"
     */
    function Footer() 
    {
        //Fondo de pie de página
        $this->SetFillColor(173, 216, 230); //cambio de color
        $this->Rect(0,$this->GetPageHeight()-20,210,28,'F');

        //Fecha de la creación del PDF
        $this->SetFont('Arial','B',8);
        $this->SetXY(100,-15);
        $this->Cell(0,10,'Fecha: '.$this->fecha,0,1,'R');

        //Contador de paginas
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Pagina: '.$this->PageNo(),0,0,'C');
    }


    /**
     * Reporte de los usuarios
     */
    public function generarReporteUsuario():void
    {
        $usuario = new GestorUsuario();
        $usuarios = $usuario->listarUsuarios();
        $cantCoordinador = 0;
        $cantMaestro = 0;
        $contador = 0;

        $this->ancho = 160;
        $this->ejeX = 25;
        $this->ejeY = 40;

        $this->cabecera = ['Legajo','Nombre','Apellido','Categoria'];
        $this->titulo = "Reporte de Maestras Jardineras";

        $this->AddPage();
        $this->SetFont('Arial','',10);
        foreach ($usuarios as $usuario) 
        {
            $contador ++;
            $this->SetX(25);
            $this->Cell(40, 10, $usuario->getLegajo(), 1, 0, 'C');
            $this->Cell(40, 10, $usuario->getNombre(), 1, 0, 'C');
            $this->Cell(40, 10, $usuario->getApellido(), 1, 0,'C');
            $this->Cell(40, 10, $usuario->getCategoria(), 1, 0, 'C');
            $this->Ln();
            if($usuario->getCategoria() === "Coordinador")
            {
                $cantCoordinador ++;
            }
            else
            {
                $cantMaestro ++;
            }
        }
        
        if($cantCoordinador!=1)
        {$cardinalidad = 'Coordinadores';}
        else
        {$cardinalidad = 'Coordinador';}

        if($cantMaestro!=1)
        {$cardinalidad2 = 'Maestros';}
        else
        {$cardinalidad2 = 'Maestro';}

        $this->SetFont('Arial','',12);
        $texto = "En la fecha $this->fecha, se realizo el informe del personal que participa en el Jardin Maternal upa, con una totalidad de $contador participantes, siendo $cantCoordinador $cardinalidad y $cantMaestro $cardinalidad2 actualmente.";
        $this->SetXY(25,$this->GetY()+5);
        $this->MultiCell(160, 5,$texto, 0,'L');

        ob_clean();                                                         //Limpiar buffer (es lo mas importante para los reportes)
        $this->Output('Reporte_de_maestras_jardineras.pdf','D');
    }



    /**
     * Reporte de las salas
     */
    public function generarReporteSala():void
    {
        $sala = new GestorSala();
        $salas = $sala->listarSalas();

        $this->ancho = 120;
        $this->ejeX = 45;
        $this->ejeY = 40;

        $this->cabecera = ['Nombre','Edad','Capacidad'];
        $this->titulo = "Reporte de Salas";
        $this->AddPage();
        $this->SetFont('Arial','',10);
        foreach ($salas as $sala)
        {
            $this->SetX(45);
            $this->Cell(40, 10, $sala->getNombre(), 1, 0, 'C');
            $this->Cell(40, 10, $sala->getEdad(), 1, 0, 'C');
            $this->Cell(40, 10, $sala->getCapacidad(), 1, 0,'C');
            $this->Ln();
        }
        ob_clean();                                                         
        $this->Output('Reporte_de_Salas.pdf','D');
    }
}?>