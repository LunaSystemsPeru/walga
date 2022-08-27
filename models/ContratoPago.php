<?php
require_once 'Conectar.php';

class ContratoPago
{
    private $id;
    private $fecha;
    private $monto;
    private $clientepagoid;
    private $contratoid;
    private $tipopagoid;
    private $conectar;

    /**
     * ContratoPago constructor.
     */
    public function __construct()
    {
        $this->conectar = Conectar::getInstancia();
        $this->tipopagoid = 23;
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
    public function setId($id)
    {
        $this->id = $id;
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
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
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
    public function setMonto($monto)
    {
        $this->monto = $monto;
    }

    /**
     * @return mixed
     */
    public function getClientepagoid()
    {
        return $this->clientepagoid;
    }

    /**
     * @param mixed $clientepagoid
     */
    public function setClientepagoid($clientepagoid)
    {
        $this->clientepagoid = $clientepagoid;
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
     * @return int
     */
    public function getTipopagoid(): int
    {
        return $this->tipopagoid;
    }

    /**
     * @param int $tipopagoid
     */
    public function setTipopagoid(int $tipopagoid): void
    {
        $this->tipopagoid = $tipopagoid;
    }

    public function obtenerId()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo 
                from contratos_pagos";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from contratos_pagos 
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->id = $resultado['id'];
            $this->fecha = $resultado['fecha_pago'];
            $this->monto = $resultado['monto'];
            $this->clientepagoid = $resultado['pago_id'];
            $this->contratoid = $resultado['contrato_id'];
            $this->tipopagoid = $resultado['tipopago_id'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into contratos_pagos
                values ('$this->id',
                        '$this->fecha',
                        '$this->monto', 
                        '$this->clientepagoid',
                        '$this->contratoid', 
                        '$this->tipopagoid')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function eliminar()
    {
        $sql = "delete from contratos_pagos
                where contrato_id = '$this->contratoid'";
        $this->conectar->ejecutar_idu($sql);
    }

    public function eliminarId()
    {
        $sql = "delete from contratos_pagos
                where id = '$this->id'";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verFilas()
    {
        $sql = "select cp.monto, cp.fecha_pago, cp.pago_id, cp.contrato_id, cp.id, pv.descripcion as tipopago 
                from contratos_pagos as cp 
                inner join parametros_valores as pv on pv.id = cp.tipopago_id
                where cp.contrato_id = '$this->contratoid'";
        return $this->conectar->get_Cursor($sql);
    }


}