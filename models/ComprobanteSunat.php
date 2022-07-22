<?php
require_once 'Conectar.php';

class ComprobanteSunat
{
    private $id;
    private $comprobanteid;
    private $serie;
    private $numero;
    private $empresaid;
    private $conectar;

    /**
     * ComprobanteSunat constructor.
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

    public function obtenerId()
    {
        $sql = "select ifnull(max(id)+1, 1) as codigo 
                from comprobantes_empresas";
        $this->id = $this->conectar->get_valor_query($sql, "codigo");
    }

    public function obtenerDatosVenta()
    {
        $sql = "select * 
        from comprobantes_empresas 
        where comprobante_id = '$this->comprobanteid' and empresa_id = '$this->empresaid'";
        echo $sql;
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->id = $resultado['id'];
            $this->serie = $resultado['serie'];
            $this->numero = $resultado['numero'];
            return true;
        } else {
            return false;
        }
    }

    public function insertar()
    {
        $sql = "insert into comprobantes_empresas
                values ('$this->id',
                        '$this->comprobanteid', 
                        '$this->serie',
                        '$this->numero',
                        '$this->empresaid')";
        $this->conectar->ejecutar_idu($sql);
    }

    public function actualizar()
    {
        $sql = "update comprobantes_empresas
                set serie = '$this->serie',
                    numero = '$this->numero',
                where id = $this->id";
        $this->conectar->ejecutar_idu($sql);
    }

    public function verFilas () {
        $sql = "select ce.id, ce.comprobante_id, ce.serie, ce.numero, pv.descripcion, pv.valor1, pv.valor2 
                from comprobantes_empresas as ce 
                    inner join parametros_valores pv on ce.comprobante_id = pv.id
                where ce.empresa_id = '$this->empresaid'";
        return $this->conectar->get_Cursor($sql);
    }


}