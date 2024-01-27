<?php
require_once 'Conectar.php';

class ParametroValor
{
    private $id;
    private $parametro_id;
    private $descripcion;
    private $valor1;
    private $valor2;
    private $conectar;

    /**
     * ParametroValor constructor.
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
    public function getParametroId()
    {
        return $this->parametro_id;
    }

    /**
     * @param mixed $parametro_id
     */
    public function setParametroId($parametro_id)
    {
        $this->parametro_id = $parametro_id;
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
        $this->descripcion = trim(strtoupper($descripcion));
    }

    /**
     * @return mixed
     */
    public function getValor1()
    {
        return $this->valor1;
    }

    /**
     * @param mixed $valor1
     */
    public function setValor1($valor1)
    {
        $this->valor1 = $valor1;
    }

    /**
     * @return mixed
     */
    public function getValor2()
    {
        return $this->valor2;
    }

    /**
     * @param mixed $valor2
     */
    public function setValor2($valor2)
    {
        $this->valor2 = $valor2;
    }

    public function obtenerId()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo 
                from parametros_valores";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from parametros_valores 
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->descripcion = $resultado['descripcion'];
            $this->valor1 = $resultado['valor1'];
            $this->valor2 = $resultado['valor2'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into parametros_valores
                values ('$this->id',
                        '$this->parametro_id',
                        '$this->descripcion',
                        '$this->valor1',
                        '$this->valor2')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function actualizar()
    {
        $sql = "update parametros_valores
                set descripcion = '$this->descripcion',
                    valor1 = '$this->valor1'
                    valor2 = '$this->valor2'
                where id = $this->id";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verFilas($isJson = false)
    {
        $sql = "select * from parametros_valores
                where parametro_id = '$this->parametro_id'
                order by descripcion asc";
        if ($isJson) {
            return $this->conectar->get_json_rows($sql);
        } else {
            return $this->conectar->get_Cursor($sql);
        }
    }
}