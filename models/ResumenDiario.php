<?php
require_once 'Conectar.php';

class ResumenDiario
{
    private $id;
    private $empresa_id;
    private $fecha_cp;
    private $fecha_envio;
    private $tipo_resumen;
    private $nro_items;
    private $sunat_ticket;
    private $sunat_nombre_xml;
    private $estado;
    private $conectar;

    /**
     * ResumenDiario constructor.
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
    public function setId($id): void
    {
        $this->id = $id;
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
    public function setEmpresaId($empresa_id): void
    {
        $this->empresa_id = $empresa_id;
    }

    /**
     * @return mixed
     */
    public function getFechaCp()
    {
        return $this->fecha_cp;
    }

    /**
     * @param mixed $fecha_cp
     */
    public function setFechaCp($fecha_cp): void
    {
        $this->fecha_cp = $fecha_cp;
    }

    /**
     * @return mixed
     */
    public function getFechaEnvio()
    {
        return $this->fecha_envio;
    }

    /**
     * @param mixed $fecha_envio
     */
    public function setFechaEnvio($fecha_envio): void
    {
        $this->fecha_envio = $fecha_envio;
    }

    /**
     * @return mixed
     */
    public function getTipoResumen()
    {
        return $this->tipo_resumen;
    }

    /**
     * @param mixed $tipo_resumen
     */
    public function setTipoResumen($tipo_resumen): void
    {
        $this->tipo_resumen = $tipo_resumen;
    }

    /**
     * @return mixed
     */
    public function getNroItems()
    {
        return $this->nro_items;
    }

    /**
     * @param mixed $nro_items
     */
    public function setNroItems($nro_items): void
    {
        $this->nro_items = $nro_items;
    }

    /**
     * @return mixed
     */
    public function getSunatTicket()
    {
        return $this->sunat_ticket;
    }

    /**
     * @param mixed $sunat_ticket
     */
    public function setSunatTicket($sunat_ticket): void
    {
        $this->sunat_ticket = $sunat_ticket;
    }

    /**
     * @return mixed
     */
    public function getSunatNombreXml()
    {
        return $this->sunat_nombre_xml;
    }

    /**
     * @param mixed $sunat_nombre_xml
     */
    public function setSunatNombreXml($sunat_nombre_xml): void
    {
        $this->sunat_nombre_xml = $sunat_nombre_xml;
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
    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }


    public function obtenerID()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo from sunat_resumen_diario";
        $this->id = $this->conectar->get_valor_query($sql, 'codigo');
    }

    public function getNroResumen()
    {
        $sql = "select (count(*)+1) as nro from sunat_resumen_diario 
                where fecha_envio = current_date() and empresa_id = '$this->empresa_id' and tipo_resumen = '$this->tipo_resumen'";
        return $this->conectar->get_valor_query($sql, 'nro');
    }

    public function insertar()
    {
        //0 para pendiente
        //1 para aceptado
        //2 para rechazo
        $sql = "insert into sunat_resumen_diario values ('$this->id', '$this->empresa_id', '$this->fecha_cp', current_date(), , '$this->tipo_resumen', '$this->nro_items', '$this->sunat_ticket', '$this->sunat_nombre_xml', '0')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verResumenFechas() {
        $sql =" ";
    }
}