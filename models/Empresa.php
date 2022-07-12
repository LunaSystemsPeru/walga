<?php
require_once 'Conectar.php';

class Empresa
{
    private $id;
    private $razonsocial;
    private $ruc;
    private $dirfiscal;
    private $ubigeo;
    private $departamento;
    private $provincia;
    private $distrito;
    private $codsunat;
    private $usersunat;
    private $passsunat;
    private $conectar;

    /**
     * Empresa constructor.
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
    public function getDirfiscal()
    {
        return $this->dirfiscal;
    }

    /**
     * @param mixed $dirfiscal
     */
    public function setDirfiscal($dirfiscal)
    {
        $this->dirfiscal = $dirfiscal;
    }

    /**
     * @return mixed
     */
    public function getUbigeo()
    {
        return $this->ubigeo;
    }

    /**
     * @param mixed $ubigeo
     */
    public function setUbigeo($ubigeo)
    {
        $this->ubigeo = $ubigeo;
    }

    /**
     * @return mixed
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * @param mixed $departamento
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }

    /**
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * @param mixed $provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    /**
     * @return mixed
     */
    public function getDistrito()
    {
        return $this->distrito;
    }

    /**
     * @param mixed $distrito
     */
    public function setDistrito($distrito)
    {
        $this->distrito = $distrito;
    }

    /**
     * @return mixed
     */
    public function getCodsunat()
    {
        return $this->codsunat;
    }

    /**
     * @param mixed $codsunat
     */
    public function setCodsunat($codsunat)
    {
        $this->codsunat = $codsunat;
    }

    /**
     * @return mixed
     */
    public function getUsersunat()
    {
        return $this->usersunat;
    }

    /**
     * @param mixed $usersunat
     */
    public function setUsersunat($usersunat)
    {
        $this->usersunat = $usersunat;
    }

    /**
     * @return mixed
     */
    public function getPasssunat()
    {
        return $this->passsunat;
    }

    /**
     * @param mixed $passsunat
     */
    public function setPasssunat($passsunat)
    {
        $this->passsunat = $passsunat;
    }

    /**
     * @return mixed
     */
    public function getRuc()
    {
        return $this->ruc;
    }

    /**
     * @param mixed $ruc
     */
    public function setRuc($ruc)
    {
        $this->ruc = $ruc;
    }

    public function obtenerDatos()
    {
        $sql = "select * 
                from empresas 
                where id = '$this->id'";
        $resultado = $this->conectar->get_Row($sql);
        if ($resultado) {
            $this->razonsocial = $resultado['razonsocial'];
            $this->ruc = $resultado['ruc'];
            $this->dirfiscal = $resultado['dirfiscal'];
            $this->ubigeo = $resultado['ubigeo'];
            $this->departamento = $resultado['departamento'];
            $this->provincia = $resultado['provincia'];
            $this->distrito = $resultado['distrito'];
            $this->codsunat = $resultado['codsunat'];
            $this->usersunat = $resultado['usersunat'];
            $this->passsunat = $resultado['passsunat'];
            return true;
        } else {
            return false;
        }
    }
}