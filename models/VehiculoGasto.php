<?php
require_once 'Conectar.php';

class VehiculoGasto
{
    private $id;
    private $vehiculoid;
    private $usuarioid;
    private $fecha;
    private $monto;
    private $orometro;
    private $gastoid;
    private $conectar;

    /**
     * VehiculoGasto constructor.
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
    public function getVehiculoid()
    {
        return $this->vehiculoid;
    }

    /**
     * @param mixed $vehiculoid
     */
    public function setVehiculoid($vehiculoid)
    {
        $this->vehiculoid = $vehiculoid;
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
    public function getOrometro()
    {
        return $this->orometro;
    }

    /**
     * @param mixed $orometro
     */
    public function setOrometro($orometro)
    {
        $this->orometro = $orometro;
    }

    /**
     * @return mixed
     */
    public function getGastoid()
    {
        return $this->gastoid;
    }

    /**
     * @param mixed $gastoid
     */
    public function setGastoid($gastoid)
    {
        $this->gastoid = $gastoid;
    }

    public function obtenerId()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo 
                from vehiculos_gastos";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from vehiculos_gastos
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->vehiculoid = $resultado['vehiculo_id'];
            $this->fecha = $resultado['fecha'];
            $this->monto = $resultado['monto'];
            $this->orometro = $resultado['orometro'];
            $this->usuarioid = $resultado['usuario_id'];
            $this->gastoid = $resultado['gasto_id'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into vehiculos_gastos
                values ('$this->id',
                        '$this->vehiculoid',
                        '$this->fecha', 
                        '$this->monto',
                        '$this->orometro',
                        '$this->usuarioid', 
                        '$this->gastoid')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function limpiar()
    {
        $sql = "delete from vehiculos_gastos
                where fecha = '$this->fecha' and vehiculo_id '$this->vehiculoid'";
        $this->conectar->ejecutar_idu($sql);
    }

    public function actualizar()
    {
        $sql = "update vehiculos_gastos
                set monto = '$this->monto',
                    orometro = '$this->orometro',
                where id = $this->id";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verGastosOperadores()
    {
        $sql = "select pv.id, pv.descripcion, pv.valor1, ifnull(vg.monto,0) as monto, vg.orometro
                from parametros_valores as pv
                         left join vehiculos_gastos vg on pv.id = vg.gasto_id and  vg.fecha = '$this->fecha' and vg.vehiculo_id = '$this->vehiculoid'
                where pv.parametro_id = 8";
        return $this->conectar->get_Cursor($sql);
    }


    public function verFilas()
    {
        $sql = "select * from vehiculos_gastos 
                where fecha = '$this->fecha' and vehiculo_id = '$this->vehiculoid'";
        return $this->conectar->get_Cursor($sql);
    }
}