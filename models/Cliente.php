<?php
require_once 'Conectar.php';

class Cliente
{
    private $id;
    private $datos;
    private $celular;
    private $email;
    private $entidad_id;
    private $empresa_id;
    private $conectar;

    /**
     * Cliente constructor.
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
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param mixed $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEntidadId()
    {
        return $this->entidad_id;
    }

    /**
     * @param mixed $entidad_id
     */
    public function setEntidadId($entidad_id)
    {
        $this->entidad_id = $entidad_id;
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
                from clientes";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from clientes 
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->datos = $resultado['datos'];
            $this->celular = $resultado['celular'];
            $this->email = $resultado['email'];
            $this->entidad_id = $resultado['entidad_id'];
            $this->empresa_id = $resultado['empresa_id'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into clientes
                values ('$this->id',
                        '$this->datos',
                        '$this->celular', 
                        '$this->email',
                        '$this->entidad_id',
                        '$this->empresa_id')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function actualizar()
    {
        $sql = "update clientes
                set datos = '$this->datos',
                    celular = '$this->celular',
                    email = '$this->email',
                    entidad_id = '$this->entidad_id'
                where id = $this->id";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verFilas()
    {
        $sql = "select * from clientes 
                where empresa_id = '$this->empresa_id'
                order by datos asc";
        return $this->conectar->get_Cursor($sql);
    }
}