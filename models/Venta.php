<?php
require_once 'Conectar.php';

class Venta
{
    private $id;
    private $fecha;
    private $comprobanteid;
    private $serie;
    private $numero;
    private $empresaid;
    private $usuarioid;
    private $igv;
    private $total;
    private $estado;
    private $enviadosunat;
    private $entidadid;
    private $detraccionid;
    private $formapagoid;
    private $conectar;

    /**
     * Venta constructor.
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
    public function getComprobanteid()
    {
        return $this->comprobanteid;
    }

    /**
     * @param mixed $comprobanteid
     */
    public function setComprobanteid($comprobanteid)
    {
        $this->comprobanteid = $comprobanteid;
    }

    /**
     * @return mixed
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * @param mixed $serie
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getEmpresaid()
    {
        return $this->empresaid;
    }

    /**
     * @param mixed $empresaid
     */
    public function setEmpresaid($empresaid)
    {
        $this->empresaid = $empresaid;
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
    public function getIgv()
    {
        return $this->igv;
    }

    /**
     * @param mixed $igv
     */
    public function setIgv($igv)
    {
        $this->igv = $igv;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
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
    public function getEnviadosunat()
    {
        return $this->enviadosunat;
    }

    /**
     * @param mixed $enviadosunat
     */
    public function setEnviadosunat($enviadosunat)
    {
        $this->enviadosunat = $enviadosunat;
    }

    /**
     * @return mixed
     */
    public function getEntidadid()
    {
        return $this->entidadid;
    }

    /**
     * @param mixed $entidadid
     */
    public function setEntidadid($entidadid)
    {
        $this->entidadid = $entidadid;
    }

    /**
     * @return mixed
     */
    public function getDetraccionid()
    {
        return $this->detraccionid;
    }

    /**
     * @param mixed $detraccionid
     */
    public function setDetraccionid($detraccionid)
    {
        $this->detraccionid = $detraccionid;
    }

    /**
     * @return mixed
     */
    public function getFormapagoid()
    {
        return $this->formapagoid;
    }

    /**
     * @param mixed $formapagoid
     */
    public function setFormapagoid($formapagoid): void
    {
        $this->formapagoid = $formapagoid;
    }

    public function obtenerId()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo 
                from ventas";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from ventas 
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->fecha = $resultado['fecha'];
            $this->comprobanteid = $resultado['comprobante_id'];
            $this->serie = $resultado['serie'];
            $this->numero = $resultado['numero'];
            $this->empresaid = $resultado['empresa_id'];
            $this->usuarioid = $resultado['usuario_id'];
            $this->igv = $resultado['igv'];
            $this->total = $resultado['total'];
            $this->estado = $resultado['estado'];
            $this->enviadosunat = $resultado['enviado_sunat'];
            $this->entidadid = $resultado['entidad_id'];
            $this->detraccionid = $resultado['detraccion_id'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into ventas
                values ('$this->id',
                        '$this->fecha',
                        '$this->comprobanteid', 
                        '$this->serie',
                        '$this->numero',
                        '$this->empresaid',
                        '$this->usuarioid',
                        '$this->igv',
                        '$this->total',
                        '1',
                        '0',
                        '$this->entidadid',
                        '$this->detraccionid')";
        //echo $sql;
        return $this->conectar->ejecutar_idu($sql);
    }

    function updateEstado()
    {
        $sql = "update ventas set estado = '$this->estado' where id = '$this->id'";
        $this->conectar->ejecutar_idu($sql);
    }

    function updateEnviadoSunat()
    {
        $sql = "update ventas set enviado_sunat = '$this->enviadosunat' where id = '$this->id'";
        $this->conectar->ejecutar_idu($sql);
    }

    function verVentasdelMes()
    {
        $sql = "select v.fecha, v.id, v.comprobante_id, pv.valor1, v.serie, v.numero, e.razonsocial, e.documento, v.total, v.estado, v.enviado_sunat, u.username, vs.nombre_documento 
                from ventas as v 
                inner join entidades e on v.entidad_id = e.id 
                inner join parametros_valores pv on v.comprobante_id = pv.id 
                inner join usuarios u on v.usuario_id = u.tipousuario_id  
                inner join ventas_sunat vs on v.id = vs.venta_id
                where year(v.fecha) = year(current_date()) and month(v.fecha) = month(current_date()) and v.empresa_id = '$this->empresaid'";
        return $this->conectar->get_Cursor($sql);
    }

    function verVentasEntreFechas($inicio, $fin)
    {
        $sql = "select v.fecha, v.id, v.comprobante_id, pv.valor1 as docsunat_abreviado, v.serie, v.numero, e.razonsocial, e.documento, v.total, v.estado, v.enviado_sunat, u.username, vs.nombre_documento 
                from ventas as v 
                inner join entidades e on v.entidad_id = e.id 
                inner join parametros_valores pv on v.comprobante_id = pv.id 
                inner join usuarios u on v.usuario_id = u.tipousuario_id  
                inner join ventas_sunat vs on v.id = vs.venta_id
                where v.fecha between '$inicio' and '$fin' and v.empresa_id = '$this->empresaid'";
        return $this->conectar->get_Cursor($sql);
    }

    function verVentasxSerieEntreFechas($inicio, $fin)
    {
        $sql = "select v.fecha, v.id, v.comprobante_id, pv.valor1 as docsunat_abreviado, v.serie, v.numero, e.razonsocial, e.documento, v.total, v.estado, u.username 
                from ventas as v 
                inner join entidades e on v.entidad_id = e.id 
                inner join parametros_valores pv on v.comprobante_id = pv.id 
                inner join usuarios u on v.usuario_id = u.id
                where v.fecha between '$inicio' and '$fin' and v.serie Like '%$this->serie%'
                order by v.fecha desc, v.numero desc ";
        return $this->conectar->get_json_rows($sql);
    }

    public function getJsonDataVenta()
    {
        $sql = "select v.id, v.fecha, pv.valor1 as doc_abreviado, pv.descripcion as doc_nombre, v.serie, v.numero, e.documento, e.razonsocial, e.direccion, v.estado, v.total
                from ventas as v
                inner join entidades e on v.entidad_id = e.id
                inner join parametros_valores pv on v.comprobante_id = pv.id
                where v.id = '$this->id'";
        return $this->conectar->get_json_row($sql);
    }
}