<?php

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

use Greenter\Model\Sale\BaseSale;

class generateQR
{
    private $companyName;
    private $name;

    /**
     * generateQR constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param BaseSale $sale
     *
     * @return string
     */
    public function getImage($sale)
    {
        $client = $sale->getClient();
        $params = [
            $sale->getCompany()->getRuc(),
            $sale->getTipoDoc(),
            $sale->getSerie(),
            $sale->getCorrelativo(),
            number_format($sale->getMtoIGV(), 2, '.', ''),
            number_format($sale->getMtoImpVenta(), 2, '.', ''),
            $sale->getFechaEmision()->format('Y-m-d'),
            $client->getTipoDoc(),
            $client->getNumDoc(),
        ];
        $content = implode('|', $params) . '|';
        //echo $content;

        $this->companyName = $sale->getCompany()->getRuc();
        $this->name = $sale->getName();

        $this->getQrImage($content);
        //return $this->getQrImage($content);
    }

    public function getQrImage(string $content)
    {
        $PNG_TEMP_DIR = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'qr' . DIRECTORY_SEPARATOR . $this->companyName . DIRECTORY_SEPARATOR;
        if (!is_dir($PNG_TEMP_DIR)) {
            mkdir($PNG_TEMP_DIR);
        }

        $qr = QrCode::create($content)
            // (B1) CORRECTION LEVEL
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Quartile)
            // (B2) SIZE & MARGIN
            ->setSize(240)
            ->setMargin(5);

        // (C) OUTPUT QR CODE
        $writer = new PngWriter();
        $result = $writer->write($qr);

        // (C1) SAVE TO FILE
        $result->saveToFile($PNG_TEMP_DIR . $this->name . ".png");
        //echo $PNG_TEMP_DIR . $this->name . ".png";
    }
}