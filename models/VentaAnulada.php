<?php
require_once 'Conectar.php';

class VentaAnulada
{
    private $venta_id;
    private $fecha_anulacion;
    private $motivo;
    private $conectar;

    /**
     * VentaAnulada constructor.
     */
    public function __construct()
    {
        $this->conectar = Conectar::getInstancia();
    }

    /**
     * @return mixed
     */
    public function getVentaId()
    {
        return $this->venta_id;
    }

    /**
     * @param mixed $venta_id
     */
    public function setVentaId($venta_id): void
    {
        $this->venta_id = $venta_id;
    }

    /**
     * @return mixed
     */
    public function getFechaAnulacion()
    {
        return $this->fecha_anulacion;
    }

    /**
     * @param mixed $fecha_anulacion
     */
    public function setFechaAnulacion($fecha_anulacion): void
    {
        $this->fecha_anulacion = $fecha_anulacion;
    }

    /**
     * @return mixed
     */
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * @param mixed $motivo
     */
    public function setMotivo($motivo): void
    {
        $this->motivo = $motivo;
    }

    public function insertar()
    {
        $sql = "insert into ventas_anuladas values ('$this->venta_id', '$this->fecha_anulacion', '$this->motivo')";
        $this->conectar->ejecutar_idu($sql);
    }
}