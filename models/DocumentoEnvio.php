<?php


class DocumentoEnvio
{
    private $ruta;

    /**
     * DocumentoEnvio constructor.
     * @param $ruta
     */
    public function __construct()
    {
        $url = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        $rutabase = dirname(dirname(dirname($url))) . DIRECTORY_SEPARATOR;
        $this->ruta = $rutabase;
        //print_r($rutabase);
    }

    public function enviarSunat($documento_id, $venta_id, $serie = '')
    {
        $nombre_archivo = match (intval($documento_id)) {
            3 => 'boleta',
            4 => 'factura',
        };

        $ruta = $this->ruta . "composer/generateXML/" . $nombre_archivo . ".php";
        //echo $ruta;

        $post = [
            'id' => $venta_id
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ruta);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($ch);
        curl_close($ch);

        return $respuesta;
    }

}