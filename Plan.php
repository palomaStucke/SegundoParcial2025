<?php
class Plan{
    private $codigo;
    private $colCanales;
    private $importe;
    private $mgDatos;

    /**
     * crea la clase
     * @param int $cod
     * @param array $canales
     * @param float|int $imp
     */
    public function __construct($cod,$canales,$imp){
        $this->codigo=$cod;
        $this->colCanales=$canales;
        $this->importe=$imp;
        $this->mgDatos= 100;
    }

    /**
     * devuelve el valor
     * @return int
     */
    public function getCodigo(){
        return $this->codigo;
    }

    /**
     * cambia el valor
     * @param int $nuevo
     * @return void
     */
    public function setCodigo($nuevo){
        $this->codigo=$nuevo;
    }

    /**
     * devuelve el valor
     * @return array
     */
    public function getCanales(){
        return $this->colCanales;
    }

    /**
     * cambia el valor
     * @param array $nuevo
     * @return void
     */
    public function setCanales($nuevo){
        $this->colCanales=$nuevo;
    }

    /**
     * devuelve el valor
     * @return float|int
     */
    public function getImporte(){
        return $this->importe;
    }

    /**
     * cambia el valor
     * @param float|int $nuevo
     * @return void
     */
    public function setImporte($nuevo){
        $this->importe=$nuevo;
    }

    /**
     * devuelve el valor
     * @return int|null
     */
    public function getMgDatos(){
        return $this->mgDatos;
    }

    /**
     * cambia el valor
     * @param null|int $nuevo
     * @return void
     */
    public function setMgDatos($nuevo){
        $this->mgDatos=$nuevo;
    }

    public function __tostring(){
        $r="El plan " . $this->getCodigo(). "\nIncluye los canales: " ;
        $canales= $this->getCanales();
        foreach($canales as $canal){
            $r .= "- ". $canal->__tostring() . "\n";
        }
        $r .= "Importe: $" . $this->getImporte() . "\n";

        if( $this->getMgDatos() == null){
            $r .= "No incluye MG de datos.\n";
        }else{
            $r .= "Incluye " . $this->getMgDatos() . " MG de datos.\n";
        }

        return $r;
    }

}
?>