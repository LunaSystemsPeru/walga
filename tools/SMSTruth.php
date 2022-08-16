<?php


class SMSTruth
{
    private $numero;
    private $texto;
    private $data;

    /**
     * SMSTruth constructor.
     */
    public function __construct()
    {
        $numero = array();
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero[] = $numero;
    }

    /**
     * @return mixed
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * @param mixed $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData()
    {
        $List = implode(', ', $this->numero);
        $this->data = json_encode(["phone" => $List, "msg" => $this->texto]);
    }

    public function sendSMS()
    {
        $url = "https://smsgateway.truthful.be/sms?deviceId=daa06d26d98d0ee8";

        //saco el numero de elementos
        $longitud = count($this->numero);
        for ($i = 0; $i < $longitud; $i++) {
            $datajson = json_encode(["phone" => $this->numero[$i], "msg" => $this->texto]);

            $ch = curl_init($url);
            # Setup request to send json via POST.

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $datajson);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: user:123456'));
            # Return response instead of printing.
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            # Send request.
            $result = curl_exec($ch);
            curl_close($ch);
            # Print response.
            echo "<pre>$result</pre>";
        }

    }
}