<?php
require_once 'Conectar.php';

class Parametro
{
    private $id;
    private $descripcion;
    private $tipo;
    private $conectar;

    /**
     * Parametro constructor.
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
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function obtenerId()
    {
        $sql = "select ifnull(max(id), 1) as codigo 
                from parametros";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from parametros 
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->descripcion = $resultado['descripcion'];
            $this->tipo= $resultado['tipo'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into parametros
                values ('$this->id',
                        '$this->descripcion',
                        '$this->tipo')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function actualizar()
    {
        $sql = "update parametros
                set descripcion = '$this->descripcion',
                    tipo = '$this->tipo'
                    id = '$this->id'
                where id = $this->id";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verFilas()
    {
        $sql = "select * from parametros 
                order by descripcion asc";
        return $this->conectar->get_Cursor($sql);
    }
}