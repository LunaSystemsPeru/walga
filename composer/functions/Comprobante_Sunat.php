<?php

use Greenter\See;

require '../../models/VentaSunat.php';
require 'generateQR.php';

class Comprobante_Sunat
{
    private See $see;
    private Config $config;

    public function setConfig(Empresa $Empresa)
    {
        $Config = new Config();
        $Config->setRuc($Empresa->getRuc());
        $Config->setUsersol($Empresa->getUsersunat());
        $Config->setClavesol($Empresa->getPasssunat());

        $this->see = $Config->getSee();
        $this->config = $Config;
    }


    public function envioSunat($enviar, $invoice, $idventa)
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
        $SunatVenta->setVentaid($idventa);
        $SunatVenta->setFecha(date("Y-m-d"));
        $SunatVenta->insertar();

        if ($enviar == false) {
            return json_encode(["id" => $idventa,"aceptado" => true, "observaciones" => "", "nombreDocumento" => $invoice->getName(), "codigoSunat" => ""]);
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
        return json_encode(["id" => $idventa, "aceptado" => $aceptadosunat, "observaciones" => $observaciones, "nombreDocumento" => $invoice->getName(), "codigoSunat" => $code]);
    }

}