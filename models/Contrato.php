<?php
require_once 'Conectar.php';

class Contrato
{
    private $id;
    private $fecha;
    private $clienteid;
    private $usuarioid;
    private $choferid;
    private $vehiculoid;
    private $comprobanteid;
    private $empresaid;
    private $estadocomprobante;
    private $tiposervicioid;
    private $origen;
    private $destino;
    private $servicio;
    private $estado;
    private $horasservicio;
    private $montocontrato;
    private $montopagado;
    private $horainicio;
    private $horatermino;
    private $incluyeigv;
    private $conectar;

    /**
     * Contrato constructor.
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
    public function getClienteid()
    {
        return $this->clienteid;
    }

    /**
     * @param mixed $clienteid
     */
    public function setClienteid($clienteid)
    {
        $this->clienteid = $clienteid;
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
    public function getChoferid()
    {
        return $this->choferid;
    }

    /**
     * @param mixed $choferid
     */
    public function setChoferid($choferid)
    {
        $this->choferid = $choferid;
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
    public function getEstadocomprobante()
    {
        return $this->estadocomprobante;
    }

    /**
     * @param mixed $estadocomprobante
     */
    public function setEstadocomprobante($estadocomprobante)
    {
        $this->estadocomprobante = $estadocomprobante;
    }

    /**
     * @return mixed
     */
    public function getTiposervicioid()
    {
        return $this->tiposervicioid;
    }

    /**
     * @param mixed $tiposervicioid
     */
    public function setTiposervicioid($tiposervicioid)
    {
        $this->tiposervicioid = $tiposervicioid;
    }

    /**
     * @return mixed
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * @param mixed $origen
     */
    public function setOrigen($origen)
    {
        $this->origen = strtoupper($origen);
    }

    /**
     * @return mixed
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * @param mixed $destino
     */
    public function setDestino($destino)
    {
        $this->destino = strtoupper($destino);
    }

    /**
     * @return mixed
     */
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * @param mixed $servicio
     */
    public function setServicio($servicio)
    {
        $this->servicio = strtoupper($servicio);
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
    public function getHorasservicio()
    {
        return $this->horasservicio;
    }

    /**
     * @param mixed $horasservicio
     */
    public function setHorasservicio($horasservicio)
    {
        $this->horasservicio = $horasservicio;
    }

    /**
     * @return mixed
     */
    public function getMontocontrato()
    {
        return $this->montocontrato;
    }

    /**
     * @param mixed $montocontrato
     */
    public function setMontocontrato($montocontrato)
    {
        $this->montocontrato = $montocontrato;
    }

    /**
     * @return mixed
     */
    public function getMontopagado()
    {
        return $this->montopagado;
    }

    /**
     * @param mixed $montopagado
     */
    public function setMontopagado($montopagado)
    {
        $this->montopagado = $montopagado;
    }

    /**
     * @return mixed
     */
    public function getHorainicio()
    {
        return $this->horainicio;
    }

    /**
     * @param mixed $horainicio
     */
    public function setHorainicio($horainicio)
    {
        $this->horainicio = $horainicio;
    }

    /**
     * @return mixed
     */
    public function getHoratermino()
    {
        return $this->horatermino;
    }

    /**
     * @param mixed $horatermino
     */
    public function setHoratermino($horatermino)
    {
        $this->horatermino = $horatermino;
    }

    /**
     * @return mixed
     */
    public function getIncluyeigv()
    {
        return $this->incluyeigv;
    }

    /**
     * @param mixed $incluyeigv
     */
    public function setIncluyeigv($incluyeigv)
    {
        $this->incluyeigv = $incluyeigv;
    }

    public function obtenerId()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo 
                from contratos";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function obtenerDatos()
    {
        $sql = "select * 
        from contratos 
        where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->fecha = $resultado['fecha'];
            $this->clienteid = $resultado['cliente_id'];
            $this->usuarioid = $resultado['usuario_id'];
            $this->choferid = $resultado['chofer_id'];
            $this->vehiculoid = $resultado['vehiculo_id'];
            $this->comprobanteid = $resultado['comprobante_id'];
            $this->empresaid = $resultado['empresa_id'];
            $this->estadocomprobante = $resultado['estado_comprobante'];
            $this->tiposervicioid = $resultado['tiposervicio_id'];
            $this->origen = $resultado['origen'];
            $this->destino = $resultado['destino'];
            $this->servicio = $resultado['servicio'];
            $this->estado = $resultado['estado_contrato'];
            $this->horasservicio = $resultado['horas_servicio'];
            $this->montocontrato = $resultado['monto'];
            $this->montopagado = $resultado['monto_pagado'];
            $this->horainicio = $resultado['hora_inicio'];
            $this->horatermino = $resultado['hora_termino'];
            $this->incluyeigv = $resultado['incluye_igv'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into contratos
                values ('$this->id',
                        '$this->fecha',
                        '$this->clienteid', 
                        '$this->usuarioid',
                        '$this->choferid',
                        '$this->vehiculoid',
                        '11',
                        '$this->empresaid',
                        '1',
                        '$this->tiposervicioid',
                        '$this->origen',
                        '$this->destino',
                        '$this->servicio',
                        '$this->estado',
                        '$this->horasservicio',
                        '$this->montocontrato',
                        '0',
                        '$this->horainicio',
                        '00:00', 
                        '0')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function modificar () {
        $sql = "update contratos 
                set comprobante_id = '$this->comprobanteid',
                    estado_comprobante = '$this->estadocomprobante', 
                    hora_inicio = '$this->horainicio', 
                    hora_termino = '$this->horatermino', 
                    estado_contrato = '$this->estado', 
                    monto = '$this->montocontrato',
                    servicio = '$this->servicio',
                    origen = '$this->origen',
                    destino = '$this->destino',
                    cliente_id = '$this->clienteid',
                    incluye_igv = '$this->incluyeigv'
                where id = '$this->id'";
        echo $sql;
        $this->conectar->ejecutar_idu($sql);
    }

    public function verContratosActivos() {
        $sql = "select c.servicio, c.origen, c.destino, c2.datos, c.id, c.estado_contrato, c.fecha, c.hora_inicio, c.monto, c.monto_pagado, 
                pv.descripcion as comprobante, pv2.descripcion as tiposervicio, v.placa, c.comprobante_id, c.estado_comprobante
                from contratos as c 
                inner join clientes c2 on c.cliente_id = c2.id
                inner join parametros_valores pv on c.comprobante_id = pv.id
                inner join parametros_valores as pv2 on c.tiposervicio_id = pv2.id
                inner join vehiculos v on c.vehiculo_id = v.id
                where c.estado_contrato = 0 or (c.estado_contrato = 1 and c.vehiculo_id = '$this->vehiculoid')
                order by c.fecha asc";
        return $this->conectar->get_Cursor($sql);
    }

    public function verContratosdelDia() {
        $sql = "select c.servicio, c.origen, c.destino, c2.datos, c.id, c.estado_contrato, c.fecha, c.hora_inicio, c.monto, c.monto_pagado, c.incluye_igv,  
                pv.descripcion as comprobante, pv2.descripcion as tiposervicio, v.placa, c.comprobante_id, c.estado_comprobante
                from contratos as c 
                inner join clientes c2 on c.cliente_id = c2.id
                inner join parametros_valores pv on c.comprobante_id = pv.id
                inner join parametros_valores as pv2 on c.tiposervicio_id = pv2.id
                inner join vehiculos v on c.vehiculo_id = v.id
                where c.fecha = '$this->fecha' or (c.estado_comprobante = 0 and c.comprobante_id= 4) 
                order by c.fecha asc";
        return $this->conectar->get_Cursor($sql);
    }

    public function verContratosxCobrar() {
        $sql = "select c.servicio, c.origen, c.destino, c2.datos, c.id, c.estado_contrato, c.fecha, c.hora_inicio, c.monto, c.monto_pagado, c.incluye_igv,  
                pv.descripcion as comprobante, pv2.descripcion as tiposervicio, v.placa, c.comprobante_id, c.estado_comprobante
                from contratos as c 
                inner join clientes c2 on c.cliente_id = c2.id
                inner join parametros_valores pv on c.comprobante_id = pv.id
                inner join parametros_valores as pv2 on c.tiposervicio_id = pv2.id
                inner join vehiculos v on c.vehiculo_id = v.id
                where c.monto_pagado< c.monto
                order by c.fecha asc";
        return $this->conectar->get_Cursor($sql);
    }

    public function verContratosxFecha($inicio, $fin) {
        $sql = "select c.servicio, c.origen, c.destino, c2.datos, c.id, c.estado_contrato, c.fecha, c.hora_inicio, c.monto, c.monto_pagado, c.incluye_igv,  
                pv.descripcion as comprobante, pv2.descripcion as tiposervicio, v.placa, c.comprobante_id, c.estado_comprobante
                from contratos as c 
                inner join clientes c2 on c.cliente_id = c2.id
                inner join parametros_valores pv on c.comprobante_id = pv.id
                inner join parametros_valores as pv2 on c.tiposervicio_id = pv2.id
                inner join vehiculos v on c.vehiculo_id = v.id
                where c.fecha between '$inicio' and '$fin' 
                order by c.id asc";
        return $this->conectar->get_Cursor($sql);
    }

    public function eliminar () {
        $sql = "delete from contratos where id = '$this->id'";
        $this->conectar->ejecutar_idu($sql);
    }

}