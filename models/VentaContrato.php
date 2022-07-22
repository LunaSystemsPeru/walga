<?php
require_once 'Conectar.php';

class VentaContrato
{
    private $contratoid;
    private $ventaid;
    private $conectar;

    /**
     * VentaContrato constructor.
     */
    public function __construct()
    {
        $this->conectar = Conectar::getInstancia();
    }

    /**
     * @return mixed
     */
    public function getContratoid()
    {
        return $this->contratoid;
    }

    /**
     * @param mixed $contratoid
     */
    public function setContratoid($contratoid)
    {
        $this->contratoid = $contratoid;
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
    public function setVentaid($ventaid)
    {
        $this->ventaid = $ventaid;
    }

    public function insertar()
    {
        $sql = "insert into contratos_ventas
                values ('$this->contratoid',
                        '$this->ventaid')";
        $this->conectar->ejecutar_idu($sql);
    }

}