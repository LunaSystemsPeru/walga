<?php
require_once 'Conectar.php';

class VentaSunat
{
    private $ventaid;
    private $fecha;
    private $respuesta;
    private $estado;
    private $nombre;
    private $codigosunat;
    private $hash;
    private $conectar;

    /**
     * VentaSunat constructor.
     */
    public function __construct()
    {
        $this->conectar = Conectar::getInstancia();
    }

    /**
     * @return mixed
     */
    public function getVentaid()
    {
        return $this->ventaid;
    }

    /**
     * @param mixed $ventaid
     */
    public function setVentaid($ventaid): void
    {
        $this->ventaid = $ventaid;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * @param mixed $respuesta
     */
    public function setRespuesta($respuesta): void
    {
        $this->respuesta = $respuesta;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getCodigosunat()
    {
        return $this->codigosunat;
    }

    /**
     * @param mixed $codigosunat
     */
    public function setCodigosunat($codigosunat): void
    {
        $this->codigosunat = $codigosunat;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param mixed $hash
     */
    public function setHash($hash): void
    {
        $this->hash = $hash;
    }

    public function insertar()
    {
        $sql = "insert into ventas_sunat
                values ('$this->ventaid',
                        '$this->fecha',
                        '$this->respuesta', 
                        '$this->estado',
                        '$this->nombre',
                        '$this->codigosunat',
                        '$this->hash')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from ventas_sunat 
        where venta_id = '$this->ventaid'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->fecha = $resultado['fecha'];
            $this->respuesta = $resultado['respuesta_error'];
            $this->estado = $resultado['estado'];
            $this->nombre = $resultado['nombre_documento'];
            $this->codigosunat = $resultado['codigo_sunat'];
            $this->hash = $resultado['hash'];
            return true;
        } else {
            return false;
        }
    }


}