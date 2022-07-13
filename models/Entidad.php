<?php
require_once 'Conectar.php';

class Entidad
{
    private $id;
    private $razonsocial;
    private $direccion;
    private $nrodocumento;
    private $conectar;

    /**
     * Entidad constructor.
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
    public function getRazonsocial()
    {
        return $this->razonsocial;
    }

    /**
     * @param mixed $razonsocial
     */
    public function setRazonsocial($razonsocial)
    {
        $this->razonsocial = $razonsocial;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getNrodocumento()
    {
        return $this->nrodocumento;
    }

    /**
     * @param mixed $nrodocumento
     */
    public function setNrodocumento($nrodocumento)
    {
        $this->nrodocumento = $nrodocumento;
    }

    public function obtenerId()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo 
                from entidades";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function validarDocumento()
    {
        $sql = "select ifnull(id, 0) as id 
        from entidades 
        where documento = '$this->nrodocumento'";
        $this->id = $this->conectar->get_valor_query($sql, "id");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from entidades 
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->razonsocial = $resultado['razonsocial'];
            $this->direccion = $resultado['direccion'];
            $this->nrodocumento = $resultado['documento'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into entidades
                values ('$this->id',
                        '$this->razonsocial',
                        '$this->direccion', 
                        '$this->nrodocumento')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function actualizar()
    {
        $sql = "update entidades
                set razonsocial = '$this->razonsocial',
                    direccion = '$this->direccion'
                where id = $this->id";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verFilas()
    {
        $sql = "select * from entidades 
                order by razonsocial asc";
        return $this->conectar->get_Cursor($sql);
    }

}