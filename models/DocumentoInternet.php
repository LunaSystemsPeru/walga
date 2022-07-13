<?php


class DocumentoInternet
{
    private $tipo_documento;
    private $nro_documento;

    /**
     * DocumentoInternet constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getTipoDocumento()
    {
        return $this->tipo_documento;
    }

    /**
     * @param mixed $tipo_documento
     */
    public function setTipoDocumento($tipo_documento)
    {
        $this->tipo_documento = $tipo_documento;
    }

    /**
     * @return mixed
     */
    public function getNroDocumento()
    {
        return $this->nro_documento;
    }

    /**
     * @param mixed $nro_documento
     */
    public function setNroDocumento($nro_documento)
    {
        $this->nro_documento = $nro_documento;
    }

    public function validar()
    {
        $direccion = "http://lunasystemsperu.com/apis/apidni.php?dni=";

        //si es ruc
        if ($this->tipo_documento == 1) {
            $direccion = "https://lunasystemsperu.com/apis/apiruc.php?ruc=" . $this->nro_documento;
        }

        //si es dni
        if ($this->tipo_documento == 2) {
            $direccion = "https://lunasystemsperu.com/apis/apidni.php?dni=" . $this->nro_documento;
        }

/*
        $json = file_get_contents($direccion, FALSE);
        // Check for errors
        if ($json === FALSE) {
            die('Error');
        }
*/

//create a new cURL resource
        $ch = curl_init($direccion);

//setup request to send json via POST
        $data = array(
            'username' => 'codexworld',
            'password' => '123456'
        );
        $payload = json_encode(array("user" => $data));

//attach encoded JSON string to the POST fields
       // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

//set the content type to application/json
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

//return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute the POST request
        $result = curl_exec($ch);

//close cURL resource
        curl_close($ch);
        return $result;
    }
}