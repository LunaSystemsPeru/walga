<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

date_default_timezone_set('America/Lima');

//ob_start();
//require('../includes/fpdf.php');

require '../models/Empresa.php';
require '../models/Venta.php';
require '../models/VentaServicio.php';
require '../models/Entidad.php';
require '../models/ComprobanteSunat.php';
require '../tools/NumerosaLetras.php';
require '../models/VentaSunat.php';
require '../models/ParametroValor.php';
require '../tools/Util.php';

require('../tools/fpdf/fpdf.php');
define('FPDF_FONTPATH', '../tools/fpdf/font/');

$id_venta = filter_input(INPUT_GET, 'id_venta', FILTER_SANITIZE_NUMBER_INT);


$Util = new Util();
$c_numeros_letras = new NumerosaLetras();

$Venta = new Venta();
$Venta->setId($id_venta);
$Venta->obtenerDatos();

$Empresa = new Empresa();
$Empresa->setId($Venta->getEmpresaid());
$Empresa->obtenerDatos();

$Entidad = new Entidad();
$Entidad->setId($Venta->getEntidadid());
$Entidad->obtenerDatos();

$Comprobante = new ComprobanteSunat();
$Comprobante->setId($Venta->getComprobanteid());
$Comprobante->obtenerDatosVenta();

$Parametro = new ParametroValor();
$Parametro->setId($Venta->getComprobanteid());
$Parametro->obtenerDatos();

$serie = $Util->zerofill($Venta->getSerie(), 4);
$numero = $Util->zerofill($Venta->getNumero(), 8);

$Servicios = new VentaServicio();
$Servicios->setVentaid($Venta->getId());

$VentaSunat = new VentaSunat();
$VentaSunat->setVentaid($Venta->getId());
$VentaSunat->obtenerDatos();

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

if (strlen($Entidad->getNrodocumento()) < 8) {
    $Entidad->setNrodocumento("00000000");
}

$pdf = new FPDF('P', 'mm', array(80, 350));
$pdf->SetMargins(8, 8, 8);
$pdf->SetAutoPageBreak(true, 8);
$pdf->AddPage();

$altura_linea = 4;

$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(00, 00, 0);
$pdf->Cell(64, $altura_linea, "*** " . htmlentities("COMPLEJO DEPORTIVO LEO SOCCER") . " ***", 0, 1, 'C');
$pdf->Image('../public/images/logo_leosoccer.png', $pdf->GetX()+12, $pdf->GetY(), 40, 40);
$pdf->Ln(42);

$pdf->MultiCell(64, $altura_linea, htmlentities($Empresa->getRuc() . " | " . $Empresa->getRazonSocial()), 0, 'C');
$pdf->Cell(64, $altura_linea, "Cel/Tel: +51 949 490 436", 0, 1, 'C');
$pdf->MultiCell(64, $altura_linea, htmlentities('OTR.PARCELA 3 MZA. B LOTE. 03 Z.I. SECTOR LOS ALAMOS - ANCASH - SANTA - NUEVO CHIMBOTE'), 0, 'C');
$pdf->Ln();

$pdf->Cell(64, $altura_linea, $Parametro->getDescripcion() . " ELECTRONICA ", 0, 1, 'C');
$pdf->Cell(64, $altura_linea, "Serie: " . $Venta->getSerie() . " -  Numero: " . $Util->zerofill($Venta->getNumero(), 5), 0, 1, 'C');
$pdf->Cell(64, $altura_linea, "Fecha: " . $Util->fecha_mysql_web($Venta->getFecha()) . " " . date("h:i:s a"), 0, 1, 'L');
$pdf->Cell(64, $altura_linea, "Cliente: " . $Entidad->getNrodocumento(), 0, 1, 'L');
$pdf->MultiCell(64, $altura_linea, htmlentities($Entidad->getRazonsocial()), 0, 'J');
$pdf->Ln();

$a_productos = $Servicios->verFilas();
$suma = 0;
foreach ($a_productos as $value) {
    $suma += ($value['precio_venta']);
    $y = $pdf->GetY();
    $pdf->SetX(58);
    $pdf->Cell(5, $altura_linea, "x", 0, 0, 'R');
    $pdf->Cell(10, $altura_linea, number_format($value['precio_venta'], 2), 0, 1, 'R');
    $pdf->SetX(8);
    $pdf->SetY($y);
    $pdf->MultiCell(49, $altura_linea, number_format(1, 0) . " | " . html_entity_decode($value['descripcion']), 0, 'J');
}

$pdf->Ln(2);
if ($VentaSunat->getNombre() != "-") {
    $pdf->Image('../public/qr/' . $Empresa->getRuc() . "/" . $VentaSunat->getNombre() . '.png', $pdf->GetX(), $pdf->GetY(), 22, 22);
}

$pdf->Ln(2);
$pdf->Cell(50, $altura_linea, "SUB TOTAL: ", 0, 0, 'R');
$pdf->Cell(14, $altura_linea, number_format($Venta->getTotal() / 1.18, 2), 0, 1, 'R');
$pdf->Cell(50, $altura_linea, "IGV: ", 0, 0, 'R');
$pdf->Cell(14, $altura_linea, number_format($Venta->getTotal() / 1.18 * 0.18, 2), 0, 1, 'R');
$pdf->Cell(50, $altura_linea, "TOTAL: ", 0, 0, 'R');
$pdf->Cell(14, $altura_linea, number_format($Venta->getTotal(), 2), 0, 1, 'R');

$pdf->Ln(10);
$pdf->Cell(64, $altura_linea, $c_numeros_letras->to_word($Venta->getTotal(), $ncorto), 0, 1, 'J');

$pdf->Ln(2);
$pdf->MultiCell(64, $altura_linea, "Representacion Impresa de la " . $Parametro->getDescripcion() . " ELECTRONICA, esta puede ser consultada en https://walgainversiones.com", 0, 'J');
$pdf->Cell(64, $altura_linea, "Gracias por su visita", 0, 1, 'J');
$nombre_archivo = $VentaSunat->getNombre() . ".pdf";
$pdf->Output($nombre_archivo, "I");
