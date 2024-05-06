<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('America/Lima');

require '../models/Empresa.php';
require '../models/Venta.php';
require '../models/VentaServicio.php';
require '../models/Entidad.php';
require '../tools/NumerosaLetras.php';
require '../models/VentaCuota.php';
require '../models/ParametroValor.php';
require '../models/VentaSunat.php';
require '../tools/Util.php';

require('../tools/fpdf/fpdf.php');
define('FPDF_FONTPATH', '../tools/fpdf/font/');

class PDF extends FPDF
{
    function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if ($style == 'F')
            $op = 'f';
        elseif ($style == 'FD' || $style == 'DF')
            $op = 'B';
        else
            $op = 'S';
        $MyArc = 4 / 3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m', ($x + $r) * $k, ($hp - $y) * $k));

        $xc = $x + $w - $r;
        $yc = $y + $r;
        $this->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - $y) * $k));
        if (strpos($corners, '2') === false)
            $this->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - $y) * $k));
        else
            $this->_Arc($xc + $r * $MyArc, $yc - $r, $xc + $r, $yc - $r * $MyArc, $xc + $r, $yc);

        $xc = $x + $w - $r;
        $yc = $y + $h - $r;
        $this->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - $yc) * $k));
        if (strpos($corners, '3') === false)
            $this->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - ($y + $h)) * $k));
        else
            $this->_Arc($xc + $r, $yc + $r * $MyArc, $xc + $r * $MyArc, $yc + $r, $xc, $yc + $r);

        $xc = $x + $r;
        $yc = $y + $h - $r;
        $this->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - ($y + $h)) * $k));
        if (strpos($corners, '4') === false)
            $this->_out(sprintf('%.2F %.2F l', ($x) * $k, ($hp - ($y + $h)) * $k));
        else
            $this->_Arc($xc - $r * $MyArc, $yc + $r, $xc - $r, $yc + $r * $MyArc, $xc - $r, $yc);

        $xc = $x + $r;
        $yc = $y + $r;
        $this->_out(sprintf('%.2F %.2F l', ($x) * $k, ($hp - $yc) * $k));
        if (strpos($corners, '1') === false) {
            $this->_out(sprintf('%.2F %.2F l', ($x) * $k, ($hp - $y) * $k));
            $this->_out(sprintf('%.2F %.2F l', ($x + $r) * $k, ($hp - $y) * $k));
        } else
            $this->_Arc($xc - $r, $yc - $r * $MyArc, $xc - $r * $MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1 * $this->k, ($h - $y1) * $this->k,
            $x2 * $this->k, ($h - $y2) * $this->k, $x3 * $this->k, ($h - $y3) * $this->k));
    }
}

$ventaid = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$Parametro = new ParametroValor();

$Util = new Util();
$NumeroaLetra = new NumerosaLetras();

$Venta = new Venta();
$Venta->setId($ventaid);
$Venta->obtenerDatos();

$Empresa = new Empresa();
$Empresa->setId($Venta->getEmpresaid());
$Empresa->obtenerDatos();

$Cliente = new Entidad();
$Cliente->setId($Venta->getEntidadid());
$Cliente->obtenerDatos();

$Parametro->setId($Venta->getComprobanteid());
$Parametro->obtenerDatos();
$nombreDocumentoSUNAT = $Parametro->getDescripcion();
$abreviaturaSUNAT = $Parametro->getValor1();
$codSUNAT = $Parametro->getValor2();

$serie = $Util->zerofill($Venta->getSerie(), 4);
$numero = $Util->zerofill($Venta->getNumero(), 8);

$VentaServicio = new VentaServicio();
$VentaServicio->setVentaid($Venta->getId());

$Sunat = new VentaSunat();
$Sunat->setVentaid($Venta->getId());
$Sunat->obtenerDatos();

$Cuota = new VentaCuota();
$Cuota->setVentaid($Venta->getId());

//variables
//forma pago
$Parametro->setId($Venta->getFormaPagoId());
$Parametro->obtenerDatos();
$formapago = $Parametro->getDescripcion();

//detraccion
$Parametro->setId($Venta->getDetraccionid());
$Parametro->obtenerDatos();
$nombre_detraccion =$Parametro->getDescripcion();
$porcentaje_detraccion = $Parametro->getValor1() / 100;

//guias relacionadas
/*$c_guiasrel = new VentaGuiaRelacionada();
$c_guiasrel->setIdventa($c_venta->getIdVenta());
$itemguias = "";
foreach ($c_guiasrel->verFilas() as $fila) {
    $itemguias .= $fila['valor'] . " | " . $fila['serie'] . " - " . $fila['numero'] . " ";
}*/

$id_moneda = 1;
$nmoneda = "";
$ncorto = "";
if ($id_moneda == 1) {
    $nmoneda = "SOLES";
    $ncorto = "PEN";
}
if ($id_moneda == 2) {
    $nmoneda = "DOLAR AMERICANO";
    $ncorto = "USD";
}

if (strlen($Cliente->getNrodocumento()) < 8) {
    $Cliente->setNrodocumento("00000000");
}

$pdf = new PDF('P', 'mm', 'A4');
$pdf->SetMargins(10, 8, 10);
$pdf->SetAutoPageBreak(true, 8);
$pdf->AddPage();

//$imagen = 'logowalga.png';
$r = 0;
$g = 101;
$b = 46;

$pdf->Image('../public/images/logo3.png', 10, 10, 25, 25);
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0, 0, 0);

$pdf->SetDrawColor(115, 115, 115);


$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(255, 255, 255);
//$pdf->SetFillColor(0, 101,46);
//$pdf->Rect(140, 10, 60, 24,"");
$pdf->RoundedRect(140, 10, 60, 24, 2, '1234', '');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetY(10);
$pdf->SetX(140);
$pdf->Cell(60, 8, "RUC: " . $Empresa->getRuc(), 0, 1, 'C');
$pdf->SetX(140);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es blanco)
$pdf->SetFillColor(244, 112, 30);
$pdf->MultiCell(60, 5, $nombreDocumentoSUNAT . PHP_EOL . " ELECTRONICA", 0, "C", 1);
//$pdf->Cell(70, 8, $c_tido->getNombre() . " ELECTRONICA", 0, 1, 'C', 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX(140);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(60, 8, $serie . "-" . $numero, 0, 1, 'C');

$pdf->SetTextColor(1, 99, 48);
$pdf->SetY(10);
$pdf->SetX(40);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(110, 4, $Empresa->getRazonSocial(), 0, 1, 'L');
$pdf->SetX(40);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(110, 3.5, $Empresa->getRazonsocial(), 0, 1, 'L');

$pdf->SetX(40);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(92, 3.5, $Empresa->getDirfiscal(), 0, "L");
$pdf->SetX(40);
$pdf->MultiCell(92, 3.5, "SUC. MZA. G LOTE. 06 P.J. RAMON CASTILLA ANCASH - SANTA - CHIMBOTE", 0, "L");
$pdf->SetX(40);
$pdf->Cell(75, 3.5, "Telefono: 949", 0, 1, 'L');

$pdf->SetY(39);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es blanco)
$pdf->SetFillColor($r, $g, $b);
$pdf->Cell(190, 6, "FACTURADO A ", 0, 1, 'C', 1);
$pdf->Ln(3);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);

$pdf->RoundedRect(10, 47, 190, 23, 2, '1234', '');

$pdf->Cell(25, 4, "CLIENTE: ", 0, 0, 'L');
$pdf->Cell(93, 4, $Cliente->getNrodocumento(), 0, 0, 'L');
$pdf->Cell(47, 4, "FECHA EMISION:", 0, 0, 'R');
$pdf->Cell(25, 4, $Util->fecha_tabla($Venta->getFecha()), 0, 1, 'R');

$pdf->Cell(118, 4, addslashes($Cliente->getRazonsocial()), 0, 0, 'L');
$pdf->Cell(47, 4, "MONEDA:", 0, 0, 'R');
$pdf->Cell(25, 4, $nmoneda, 0, 1, 'R');

$itemguias = 0;

$YACTUAL = $pdf->GetY();
$pdf->Cell(25, 4, "DIRECCION:", 0, 0, 'L');
//$pdf->Cell(130, 5, addslashes($c_entidad->getDireccion()), 0, 0, 'L');
$pdf->SetX(128);
$pdf->Cell(47, 4, "FORMA DE PAGO:", 0, 0, 'R');
$pdf->Cell(25, 4, $formapago, 0, 0, 'R');
$pdf->SetX(35);
$pdf->MultiCell(90, 4, addslashes(trim($Cliente->getDireccion())));
$pdf->SetX(10);
$pdf->Cell(170, 4, "GUIAS RELACIONADAS: " . $itemguias, 0, 1, 'L');

$pdf->Ln(3);

$y = $pdf->GetY();
//$pdf->Line(10, $y, 200, $y);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetTextColor(255, 255, 255);  // Establece el color del texto (en este caso es blanco)
$pdf->SetFillColor($r, $g, $b);
$pdf->Cell(15, 5, "CANT.", 0, 0, 'C', 1);
$pdf->Cell(15, 5, "UND. MED.", 0, 0, 'C', 1);
$pdf->Cell(120, 5, "DESCRIPCION", 0, 0, 'C', 1);
$pdf->Cell(20, 5, "P.UNIT ", 0, 0, 'C', 1);
$pdf->Cell(20, 5, "P. TOTAL", 0, 1, 'C', 1);
$pdf->Ln(1);

$y = $pdf->GetY();
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);

$suma = 0;
$items = array();

$a_servicios = $VentaServicio->verFilas();
foreach ($a_servicios as $value) {
    $cantidad = 1;
    $precio = $value['precio_venta'];
    $subtotal = $cantidad * $precio;
    $pdf->Cell(15, 4, $cantidad, 0, 0, 'C');
    //$pdf->Cell(110, 10, $value['descripcion'], 0, 0, 'L');
    $pdf->SetX(160);
    $pdf->Cell(20, 4, number_format($precio, 2), 0, 0, 'R');
    $pdf->Cell(20, 4, number_format($subtotal, 2), 0, 0, 'R');
    $pdf->SetX(25);
    $pdf->MultiCell(135, 4, addslashes($value['unidad'] . " | " . $value['descripcion']), 0, 'J');
    //$pdf->Ln(2);
}

$pdf->SetY(-75);

$pdf->Ln(3);
$y = $pdf->GetY();
$pdf->Line(10, $y, 200, $y);

$pdf->SetY(-70);
$hcelda = 4;
$pdf->SetX(63);
$pdf->Cell(15, $hcelda, "Nro Cuota", 1, 0, 'C');
$pdf->Cell(25, $hcelda, "Fecha Vcto: ", 1, 0, 'C');
$pdf->Cell(20, $hcelda, "Monto: ", 1, 1, 'C');

$arraycuotas = $Cuota->verFilas();
$xcobrarcuotas = 0;
$norcuota = 1;
foreach ($arraycuotas as $fila) {
    $pdf->SetX(63);
    $pdf->Cell(15, $hcelda, $norcuota, 1, 0, 'C');
    $pdf->Cell(25, $hcelda, $fila['fecha_vencimiento'], 1, 0, 'C');
    $pdf->Cell(20, $hcelda, number_format($fila['monto'], 2), 1, 1, 'R');
    $xcobrarcuotas += $fila['monto'];
    $norcuota++;
}
$pdf->SetX(63);
$pdf->Cell(40, $hcelda, "TOTAL CREDITO:", 1, 0, 'C');
$pdf->Cell(20, $hcelda, number_format($xcobrarcuotas, 2), 1, 1, 'R');
$pdf->SetX(63);
$pdf->Cell(40, $hcelda, "IMPOR. DETRACC. (" . $porcentaje_detraccion * 100 . " %)", 1, 0, 'C');
$pdf->Cell(20, $hcelda, number_format($porcentaje_detraccion * $Venta->getTotal(), 2), 1, 1, 'R');

$pdf->SetY(-64);
$pdf->Image('../tools/generateQR/temp/' . $Sunat->getNombre() . '.png', 130, 228, 22, 22);


$pdf->Ln(2);
$pdf->Cell(170, 5, "SUB TOTAL: ", 0, 0, 'R');
$pdf->Cell(20, 5, number_format($Venta->getTotal() / 1.18, 2), 0, 1, 'R');

$total_final = number_format($Venta->getTotal(), 2, ".", "");

$pdf->Cell(70, 4, "Importe en Letras", 0, 0, 'L');
$pdf->Cell(100, 4, "IGV: ", 0, 0, 'R');
$pdf->Cell(20, 4, number_format($Venta->getTotal() / 1.18 * 0.18, 2), 0, 1, 'R');
$pdf->Cell(120, 4, addslashes($NumeroaLetra->to_word($total_final, $ncorto)), 0, 0, 'L');
$pdf->Cell(50, 4, "TOTAL: ", 0, 0, 'R');
$pdf->Cell(20, 4, number_format($Venta->getTotal(), 2), 0, 1, 'R');

$pdf->Ln(3);
$y = $pdf->GetY();
$pdf->Line(10, $y, 200, $y);
$pdf->Ln(2);
$pdf->MultiCell(190, 4, addslashes("BANCO DE CREDITO DEL PERU (BCP) "), 0, 'L');
$pdf->MultiCell(190, 4, addslashes("CUENTA CORRIENTE EN MONEDA NACIONAL:   310-2601665-0-56  - CCI: 00231000260166505611 "), 0, 'L');
$pdf->Ln(1);
$pdf->MultiCell(190, 4, addslashes("VENTA SUJETA AL SPOT: CTA BANCO DE LA NACION:  00-781-236640"), 0, 'L');
$pdf->Ln(2);

$y = $pdf->GetY();
$pdf->Line(10, $y, 200, $y);
$pdf->Ln(2);
$pdf->MultiCell(190, 4, addslashes("Representacion Impresa de la " . $nombreDocumentoSUNAT . " ELECTRONICA, visite https://walgainversiones.ga/"), 0, 'C');
$pdf->MultiCell(190, 4, addslashes("Resumen: " . $Sunat->getHash()), 0, 'C');
$pdf->MultiCell(190, 4, addslashes("Visita nuestro Facebook: https://www.facebook.com/walga.eirl/"), 0, 'C');
$pdf->MultiCell(190, 4, addslashes("correo: walga.inversioneseirl@gmail.com"), 0, 'C');


$nombre_archivo = $Sunat->getNombre() . ".pdf";
//para abrir y generarle nombre automaticamente
$pdf->Output($nombre_archivo, "I");
