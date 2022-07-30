<?php
require_once 'Conectar.php';

class VentaCuota
{
    private $id;
    private $fecha_vencimiento;
    private $monto;
    private $ventaid;
    private $conectar;

    /**
     * VentaCuota constructor.
     */
    public function __construct()
    {
        $this->conectar = Conectar::getInstancia();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFechaVencimiento()
    {
        return $this->fecha_vencimiento;
    }

    /**
     * @param mixed $fecha_vencimiento
     */
    public function setFechaVencimiento($fecha_vencimiento): void
    {
        $this->fecha_vencimiento = $fecha_vencimiento;
    }

    /**
     * @return mixed
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * @param mixed $monto
     */
    public function setMonto($monto): void
    {
        $this->monto = $monto;
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

    public function verFilas()
    {
        $sql = "select * 
                from ventas_cuotas
                where venta_id = '$this->ventaid'";
        return $this->conectar->get_Cursor($sql);
    }
}