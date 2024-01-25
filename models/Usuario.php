<?php
require_once 'Conectar.php';

class Usuario
{
    private $id;
    private $username;
    private $password;
    private $fec_login;
    private $fec_creacion;
    private $estado;
    private $empresa_id;
    private $tipousuario_id;
    private $conectar;

    /**
     * Usuario constructor.
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFecLogin()
    {
        return $this->fec_login;
    }

    /**
     * @param mixed $fec_login
     */
    public function setFecLogin($fec_login)
    {
        $this->fec_login = $fec_login;
    }

    /**
     * @return mixed
     */
    public function getFecCreacion()
    {
        return $this->fec_creacion;
    }

    /**
     * @param mixed $fec_creacion
     */
    public function setFecCreacion($fec_creacion)
    {
        $this->fec_creacion = $fec_creacion;
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

    /**
     * @return mixed
     */
    public function getTipousuarioId()
    {
        return $this->tipousuario_id;
    }

    /**
     * @param mixed $tipousuario_id
     */
    public function setTipousuarioId($tipousuario_id)
    {
        $this->tipousuario_id = $tipousuario_id;
    }

    public function obtenerId()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo 
                from usuarios";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function validarUsername()
    {
        $sql = "select ifnull(id, 0) as id 
        from usuarios 
        where username = '$this->username'";
        $this->id = $this->conectar->get_valor_query($sql, "id");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from usuarios 
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->username = $resultado['username'];
            $this->password = $resultado['password'];
            $this->fec_login = $resultado['fec_login'];
            $this->fec_creacion = $resultado['fec_creacion'];
            $this->estado = $resultado['estado'];
            $this->empresa_id = $resultado['empresa_id'];
            $this->tipousuario_id = $resultado['tipousuario_id'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into usuarios
                values ('$this->id',
                        '$this->username', 
                        '$this->password',
                        '1000-01-01', 
                        date('Y-m-d'),
                        '1',
                        '$this->empresa_id',
                        '$this->tipousuario_id')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function actualizar()
    {
        $sql = "update usuarios
                set password = '$this->password',
                    estado = '$this->estado',
                    tipousuario_id = '$this->tipousuario_id'
                where id = $this->id";
        $this->conectar->ejecutar_idu($sql);
    }

    public function actualizarLogin()
    {
        $sql = "update usuarios
                set fec_login = 'date('Y-m-d')'
                where id = $this->id";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verFilas()
    {
        $sql = "select * from usuarios where empresa_id = '$this->empresa_id'";
        return $this->conectar->get_Cursor($sql);
    }
}