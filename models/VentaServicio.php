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
        $this->descripcion = htmlentities($descripcion);
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

    public function verFilas($tipo = 0)
    {
        $sql = "select vs.id, vs.descripcion, vs.precio_venta, vs.venta_id, pv.valor1 as unidad, pv.valor2 
                from ventas_servicios as vs 
                inner join parametros_valores pv on vs.unidad_id = pv.id
                where venta_id = '$this->ventaid'";
        if ($tipo == 0) {
            return $this->conectar->get_Cursor($sql);
        }
        if ($tipo == 1) {
            return $this->conectar->get_json_rows($sql);
        }

    }
}