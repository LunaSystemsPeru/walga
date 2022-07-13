<?php
require_once 'Conectar.php';

class Chofer
{
    private $id;
    private $brevete;
    private $datos;
    private $categoria;
    private $fec_vencimiento;
    private $estado;
    private $empresa_id;
    private $conectar;

    /**
     * Chofer constructor.
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
    public function getBrevete()
    {
        return $this->brevete;
    }

    /**
     * @param mixed $brevete
     */
    public function setBrevete($brevete)
    {
        $this->brevete = $brevete;
    }

    /**
     * @return mixed
     */
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * @param mixed $datos
     */
    public function setDatos($datos)
    {
        $this->datos = $datos;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getFecVencimiento()
    {
        return $this->fec_vencimiento;
    }

    /**
     * @param mixed $fec_vencimiento
     */
    public function setFecVencimiento($fec_vencimiento)
    {
        $this->fec_vencimiento = $fec_vencimiento;
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
        $sql = "select ifnull(max(id), 1) as codigo 
                from chofer";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from chofer 
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->brevete = $resultado['brevete'];
            $this->datos = $resultado['datos'];
            $this->categoria = $resultado['categoria'];
            $this->fec_vencimiento = $resultado['fec_vencimiento'];
            $this->estado = $resultado['estado'];
            $this->empresa_id = $resultado['empresa_id'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into chofer
                values ('$this->id',
                        '$this->brevete', 
                        '$this->datos',
                        '$this->categoria',
                        '$this->fec_vencimiento',
                        '1',
                        '$this->empresa_id')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function actualizar()
    {
        $sql = "update chofer
                set datos = '$this->datos',
                    categoria = '$this->categoria',
                    fec_vencimiento = '$this->fec_vencimiento',
                    estado = '$this->estado'
                where id = $this->id";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verChofer()
    {
        $sql = "select * from chofer where empresa_id = '$this->empresa_id'";
        return $this->conectar->get_Cursor($sql);
    }
}
