<?php
require_once 'Conectar.php';

class VentaServicio
{
    private $id;
    private $ventaid;
    private $descripcion;
    private $unidadid;
    private $precio;
    private $conectar;

    /**
     * VentaServicio constructor.
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

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getUnidadid()
    {
        return $this->unidadid;
    }

    /**
     * @param mixed $unidadid
     */
    public function setUnidadid($unidadid)
    {
        $this->unidadid = $unidadid;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function obtenerId()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo 
                from ventas_servicios";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function insertar()
    {
        $sql = "insert into ventas_servicios
                values ('$this->id',
                        '$this->ventaid',
                        '$this->descripcion',
                        '$this->unidadid',
                        '$this->precio')";
        $this->conectar->ejecutar_idu($sql);
    }
}