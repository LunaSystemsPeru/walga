<?php
require_once 'Conectar.php';

class Vehiculo
{
    private $id;
    private $placa;
    private $seriebin;
    private $marca;
    private $modelo;
    private $anio;
    private $toneladas;
    private $estado;
    private $chofer_id;
    private $empresa_id;
    private $conectar;

    /**
     * Vehiculo constructor.
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
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * @param mixed $placa
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }

    /**
     * @return mixed
     */
    public function getSeriebin()
    {
        return $this->seriebin;
    }

    /**
     * @param mixed $seriebin
     */
    public function setSeriebin($seriebin)
    {
        $this->seriebin = $seriebin;
    }

    /**
     * @return mixed
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param mixed $marca
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    /**
     * @return mixed
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * @param mixed $modelo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * @return mixed
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * @param mixed $anio
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;
    }

    /**
     * @return mixed
     */
    public function getToneladas()
    {
        return $this->toneladas;
    }

    /**
     * @param mixed $toneladas
     */
    public function setToneladas($toneladas)
    {
        $this->toneladas = $toneladas;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getChoferId()
    {
        return $this->chofer_id;
    }

    /**
     * @param mixed $chofer_id
     */
    public function setChoferId($chofer_id)
    {
        $this->chofer_id = $chofer_id;
    }

    /**
     * @return mixed
     */
    public function getEmpresaId()
    {
        return $this->empresa_id;
    }

    /**
     * @param mixed $empresa_id
     */
    public function setEmpresaId($empresa_id)
    {
        $this->empresa_id = $empresa_id;
    }

    public function obtenerId()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo 
                from vehiculos";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from vehiculos 
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->placa = $resultado['placa'];
            $this->seriebin = $resultado['seriebin'];
            $this->marca = $resultado['marca'];
            $this->modelo = $resultado['modelo'];
            $this->anio = $resultado['anio'];
            $this->toneladas = $resultado['capacidad_ton'];
            $this->estado = $resultado['estado'];
            $this->chofer_id = $resultado['chofer_id'];
            $this->empresa_id = $resultado['empresa_id'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into vehiculos
                values ('$this->id',
                        '$this->placa',
                        '$this->seriebin', 
                        '$this->marca',
                        '$this->modelo',
                        '$this->anio',
                        '$this->toneladas',
                        '$this->estado',
                        '$this->chofer_id',
                        '$this->empresa_id')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function actualizar()
    {
        $sql = "update vehiculos
                set placa = '$this->placa',
                    seriebin = '$this->seriebin',
                    marca = '$this->marca',
                    modelo = '$this->modelo',
                    anio = '$this->anio',
                    capacidad_ton = '$this->toneladas',
                    chofer_id = '$this->chofer_id',
                    estado = '$this->estado'
                where id = $this->id";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verFilas($json = false)
    {
        $sql = "select * from vehiculos 
                where estado = 1 and empresa_id = '$this->empresa_id'
                order by placa asc";
        if ($json) {
            return $this->conectar->get_json_rows($sql);
        } else {
            return $this->conectar->get_Cursor($sql);
        }

    }

    public function verPlacasTrabajo($json = false)
    {
        $sql = "select * from vehiculos 
                where estado = 1 and placa != 'SINPLA' and empresa_id = '$this->empresa_id'
                order by marca asc";
        if ($json) {
            return $this->conectar->get_json_rows($sql);
        } else {
            return $this->conectar->get_Cursor($sql);
        }

    }
}