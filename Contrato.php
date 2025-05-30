<?php
class Contrato{
    private $codigo;
    private $fInicio;
    private $fVencimiento;
    private $objPlan;
    private $estado;
    private $costo;
    private $renov;
    private $objCliente;

    /**
     * crea la clase
     * @param int $cod codigo
     * @param string $ini fecha inicio
     * @param string $ven fecha vencimiento
     * @param object $plan
     * @param string $est estado (al dia, moroso, suspendido, finalizado)
     * @param float|int $cos costo
     * @param bool $ren renovacion
     * @param object $clie cliente
     */
    public function __construct($cod,$ini,$ven,$plan,$est,$cos,$ren,$clie){
        $this->codigo=$cod;
        $this->fInicio=$ini;
        $this->fVencimiento=$ven;
        $this->objPlan=$plan;
        $this->estado=$est;
        $this->costo=$cos;
        $this->renov=$ren;
        $this->objCliente=$clie;
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
     * @return string
     */
    public function getFechaInicio(){
        return $this->fInicio;
    }

    /**
     * cambia el valor
     * @param string $nuevo
     * @return void
     */
    public function setFechaInicio($nuevo){
        $this->fInicio=$nuevo;
    }

    /**
     * devuelve el valor
     * @return string
     */
    public function getFechaVencimiento(){
        return $this->fVencimiento;
    }

    /**
     * cambia el valor
     * @param string $nuevo
     * @return void
     */
    public function setFechaVencimiento($nuevo){
        $this->fVencimiento=$nuevo;
    }

    /**
     * devuelve el valor
     * @return object
     */
    public function getPlan(){
        return $this->objPlan;
    }

    /**
     * cambia el valor
     * @param object $nuevo
     * @return void
     */
    public function setPlan($nuevo){
        $this->objPlan=$nuevo;
    }

    /**
     * devuelve el valor
     * @return string
     */
    public function getEstado(){
        return $this->estado;
    }

    /**
     * cambia el valor
     * @param string $nuevo
     * @return void
     */
    public function setEstado($nuevo){
        $this->estado=$nuevo;
    }

    /**
     * devuelve el valor
     * @return bool
     */
    public function getRenovacion(){
        return $this->renov;
    }

    /**
     * cambia el valor
     * @param bool $nuevo
     * @return void
     */
    public function setRenovacion($nuevo){
        $this->renov=$nuevo;
    }

    /**
     * devuelve el valor
     * @return float|int
     */
    public function getCosto(){
        return $this->costo;
    }

    /**
     * cambia el valor
     * @param float|int $nuevo
     * @return void
     */
    public function setCosto($nuevo){
        $this->costo=$nuevo;
    }

    /**
     * devuelve el valor
     * @return object
     */
    public function getCliente(){
        return $this->objCliente;
    }

    /**
     * cambia el valor
     * @param object $nuevo
     * @return void
     */
    public function setCliente($nuevo){
        $this->objCliente=$nuevo;
    }

    public function __tostring(){
        $r= "El contrato " . $this->getCodigo() .  " inicializa el " . $this->getFechaInicio() . " y vence el " . $this->getFechaVencimiento()
            . "\n.Cuenta con el plan " . $this->getPlan()->__tostring() . "\nEstado: " . $this->getEstado()
            . "\nCosto: $" . $this->getCosto();
        if($this->getRenovacion()){
            $r .= "\nSe renueva";
        }else{
            $r .= "\nNo se renueva";
        }

        $r .= "\nCliente: " . $this->getCliente()->__tostring() . "\n";

        return $r;
    }

    public function actualizarEstadoContrato($unContrato){
        $dVencidos= $this->diasContratoVencido($unContrato);
        if($dVencidos >= 10){
            $unContrato->setEstado("suspendido");
        }elseif($dVencidos<10 && $dVencidos>0){
            $unContrato->setEstado("moroso");
        }else{
            $unContrato->setEstado("al dia");
        }
    }

    public function calcularImporte(){
        $final= $this->getPlan()->getImporte();
        $canales=$this->getPlan()->getCanales();

        foreach($canales as $canal){
            $final += $canal->getImporte();
        }
        return $final;
    }
}
?>