<?php

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\Sale\Legend;
use Greenter\See;

require '../../models/VentaSunat.php';
require '../../models/Empresa.php';
require_once '../../models/Venta.php';
require '../../models/Entidad.php';
require '../src/Config.php';

require '../../tools/NumerosaLetras.php';

require 'generateQR.php';

class Comprobante_Sunat
{
    private See $see;
    private Config $config;
    private Venta $Venta;
    private Empresa $Empresa;

    /**
     * Comprobante_Sunat constructor.
     * @param Venta $Venta
     */
    public function __construct(Venta $Venta)
    {
        $this->Venta = $Venta;

        $this->Empresa = new Empresa();
        $this->Empresa->setId($this->Venta->getEmpresaid());
        $this->Empresa->obtenerDatos();

        $this->setConfig();
    }

    private function setConfig()
    {
        $Config = new Config();
        $Config->setRuc($this->Empresa->getRuc());
        $Config->setUsersol($this->Empresa->getUsersunat());
        $Config->setClavesol($this->Empresa->getPasssunat());

        $this->see = $Config->getSee();
        $this->config = $Config;
    }


    public function envioSunat($enviar, $invoice): string
    {
        $QrGenerator = new generateQR();
        $QrGenerator->getImage($invoice);

        $SunatVenta = new VentaSunat();

        if ($enviar == false) {
            $this->see->getXmlSigned($invoice);
        }

        // Guardar XML firmado digitalmente.
        file_put_contents("../../public/xml/" . $invoice->getName() . '.xml',
            $this->see->getFactory()->getLastXml());

        $SunatVenta->setCodigoSunat(0);
        $SunatVenta->setEstado(0);
        $SunatVenta->setNombre($invoice->getName());
        $SunatVenta->setRespuesta("");
        $SunatVenta->setHash($this->config->getHash($invoice));
        $SunatVenta->setVentaid($this->Venta->getId());
        $SunatVenta->setFecha(date("Y-m-d"));
        $SunatVenta->insertar();

        if ($enviar == false) {
            return json_encode(["id" => $this->Venta->getId(), "aceptado" => true, "observaciones" => "", "nombreDocumento" => $invoice->getName(), "codigoSunat" => ""]);
        }

        $result = $this->see->send($invoice);

        $aceptadosunat = true;
        $observaciones = "";

        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$result->isSuccess()) {
            $indiceaceptado = 3;
            // Mostrar error al conectarse a SUNAT.
            $observaciones = 'Codigo Error: ' . $result->getError()->getCode();
            $aceptadosunat = false;
            //echo 'Codigo Error: '.$result->getError()->getCode();
            //echo 'Mensaje Error: '.$result->getError()->getMessage();
        } else {
            // Guardamos el CDR
            file_put_contents("../../public/cdr/" . 'R-' . $invoice->getName() . '.zip', $result->getCdrZip());

            $cdr = $result->getCdrResponse();

            $code = (int)$cdr->getCode();

            if ($code === 0) {
                // echo 'ESTADO: ACEPTADA'.PHP_EOL;
                if (count($cdr->getNotes()) > 0) {
                    // echo 'OBSERVACIONES:'.PHP_EOL;
                    // Corregir estas observaciones en siguientes emisiones.
                    // var_dump($cdr->getNotes());
                    $observaciones = $cdr->getNotes();
                    $indiceaceptado = 2;
                }
            } else if ($code >= 2000 && $code <= 3999) {
                // echo 'ESTADO: RECHAZADA'.PHP_EOL;
                $aceptadosunat = false;
                $indiceaceptado = 4;
            } else {
                /* Esto no debería darse, pero si ocurre, es un CDR inválido que debería tratarse como un error-excepción. */
                /*code: 0100 a 1999 */
                $aceptadosunat = false;
                $indiceaceptado = 4;
                // echo 'Excepción';
            }
        }
        return json_encode(["id" => $this->Venta->getId(), "aceptado" => $aceptadosunat, "observaciones" => $observaciones, "nombreDocumento" => $invoice->getName(), "codigoSunat" => $code]);
    }

    public function getCompany()
    {

        // Emisor
        $address = (new Address())
            ->setUbigueo($this->Empresa->getUbigeo())
            ->setDepartamento($this->Empresa->getDepartamento())
            ->setProvincia($this->Empresa->getProvincia())
            ->setDistrito($this->Empresa->getDistrito())
            ->setUrbanizacion('-')
            ->setDireccion($this->Empresa->getDirfiscal())
            ->setCodLocal($this->Empresa->getCodsunat()); // Codigo de establecimiento asignado por SUNAT, 0000 por defecto.

        return (new Company())
            ->setRuc($this->Empresa->getRuc())
            ->setRazonSocial($this->Empresa->getRazonsocial())
            ->setNombreComercial($this->Empresa->getRazonsocial())
            ->setAddress($address);
    }

    public function getClient()
    {
        $Cliente = new Entidad();
        $Cliente->setId($this->Venta->getEntidadid());
        $Cliente->obtenerDatos();

        $tipoDoc = '0';
        $longitudDocCliente = strlen($Cliente->getNrodocumento());
        if ($longitudDocCliente == 11) {
            $tipoDoc = '6';
        }

        if ($longitudDocCliente == 8) {
            $tipoDoc = '1';
        }

        // Cliente
        return (new Client())
            ->setTipoDoc($tipoDoc)
            ->setNumDoc($Cliente->getNrodocumento())
            ->setRznSocial($Cliente->getRazonsocial());
    }

    public function getLegend($totalGeneral)
    {
        $NumeroLetras = new NumerosaLetras();

        return (new Legend())
            ->setCode('1000') // Monto en letras - Catalog. 52
            ->setValue($NumeroLetras->to_word($totalGeneral, "PEN"));
    }
}