<?php
class ContratoWeb extends Contrato{
    private $descuento;

    public function __construct($cod, $ini, $ven, $plan, $est, $cos, $ren, $clie){
        parent:: __construct($cod, $ini,$ven,$plan,$est,$cos,$ren,$clie);
        $this->descuento=0.10;
    }

    /**
     * devuelve el valor
     * @return float
     */
    public function getDescuento(){
        return $this->descuento;
    }

    /**
     * cambia el valor
     * @param float $nuevo
     * @return void
     */
    public function setDescuento($nuevo){
        $this->descuento=$nuevo;
    }

    public function __tostring(){
        return parent::__tostring() . "Tiene un " . ($this->getDescuento()*100) . "% de decuento por ser via web\n";
    }

    public function calcularImporte(){
        $final= parent:: calcularImporte() - (parent:: calcularImporte() * $this->getDescuento());
        return $final;
    }
}
?>