<?php
require_once 'Conectar.php';

class ClientePago
{
    private $id;
    private $fechapago;
    private $clienteid;
    private $usuarioid;
    private $monto;
    private $conectar;

    /**
     * ClientePago constructor.
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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFechapago()
    {
        return $this->fechapago;
    }

    /**
     * @param mixed $fechapago
     */
    public function setFechapago($fechapago)
    {
        $this->fechapago = $fechapago;
    }

    /**
     * @return mixed
     */
    public function getClienteid()
    {
        return $this->clienteid;
    }

    /**
     * @param mixed $clienteid
     */
    public function setClienteid($clienteid)
    {
        $this->clienteid = $clienteid;
    }

    /**
     * @return mixed
     */
    public function getUsuarioid()
    {
        return $this->usuarioid;
    }

    /**
     * @param mixed $usuarioid
     */
    public function setUsuarioid($usuarioid)
    {
        $this->usuarioid = $usuarioid;
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

    public function obtenerId()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo 
                from clientes_pagos";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from clientes_pagos 
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->id = $resultado['id'];
            $this->fechapago = $resultado['fecha_pago'];
            $this->monto = $resultado['monto'];
            $this->clienteid = $resultado['cliente_id'];
            $this->usuarioid = $resultado['usuario_id'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into clientes_pagos
                values ('$this->id',
                        '$this->fechapago',
                        '$this->monto', 
                        '$this->clienteid',
                        '$this->usuarioid')";
        $this->conectar->ejecutar_idu($sql);
    }

}