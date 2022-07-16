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
    private $descripcion;
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
            $this->descripcion = $resultado['descripcion'];
            $this->usuarioid = $resultado['usuario_id'];
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
                        '$this->descripcion',
                        '$this->usuarioid')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function actualizar()
    {
        $sql = "update vehiculos_gastos
                set monto = '$this->datos',
                    descripcion = '$this->celular',
                    orometro = '$this->email',
                where id = $this->id";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verFilas()
    {
        $sql = "select * from vehiculos_gastos 
                where fecha = '$this->fecha' and vehiculo_id = '$this->vehiculoid'
                order by descripcion asc ";
        return $this->conectar->get_Cursor($sql);
    }
}