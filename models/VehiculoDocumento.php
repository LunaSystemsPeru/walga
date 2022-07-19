<?php
require_once 'Conectar.php';

class VehiculoDocumento
{
    private $id;
    private $vehiculoid;
    private $nombre;
    private $fec_emision;
    private $fec_vencimiento;
    private $estado;
    private $emisorid;
    private $nombrearchivo;
    private $conectar;

    /**
     * VehiculoDocumento constructor.
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getFecEmision()
    {
        return $this->fec_emision;
    }

    /**
     * @param mixed $fec_emision
     */
    public function setFecEmision($fec_emision)
    {
        $this->fec_emision = $fec_emision;
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
    public function getEmisorid()
    {
        return $this->emisorid;
    }

    /**
     * @param mixed $emisorid
     */
    public function setEmisorid($emisorid)
    {
        $this->emisorid = $emisorid;
    }

    /**
     * @return mixed
     */
    public function getNombrearchivo()
    {
        return $this->nombrearchivo;
    }

    /**
     * @param mixed $nombrearchivo
     */
    public function setNombrearchivo($nombrearchivo)
    {
        $this->nombrearchivo = $nombrearchivo;
    }

    public function obtenerId()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo 
                from vehiculos_documentos";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from vehiculos_documentos 
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->vehiculoid = $resultado['vehiculo_id'];
            $this->nombre = $resultado['documento'];
            $this->fec_emision = $resultado['fec_emision'];
            $this->fec_vencimiento = $resultado['fec_vencimiento'];
            $this->estado = $resultado['estado'];
            $this->emisorid = $resultado['emisor_id'];
            $this->nombrearchivo = $resultado['archivo'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into vehiculos_documentos
                values ('$this->id',
                        '$this->vehiculoid',
                        '$this->nombre',
                        '$this->fec_emision',
                        '$this->fec_vencimiento',
                        '1',
                        '$this->emisorid',
                        '$this->nombrearchivo')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verFilas()
    {
        $sql = "select vd.id, vd.documento, vd.estado, vd.fec_vencimiento, vd.fec_emision, v.placa, v.marca, v.modelo 
                from vehiculos_documentos as vd 
                inner join vehiculos v on vd.vehiculo_id = v.id
                order by fec_vencimiento desc";
        return $this->conectar->get_Cursor($sql);
    }
}