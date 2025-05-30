<?php
class EmpresaCable{
    private $colPlanes;
    private $colContratos;

    public function __construct(){
        $this->colContratos=[];
        $this->colPlanes=[];
    }

    /**
     * devuelve el valor
     * @return array
     */
    public function getPlanes(){
        return $this->colPlanes;
    }

    /**
     * cambia el valor
     * @param array $nuevo
     * @return void
     */
    public function setPlanes($nuevo){
        $this->colPlanes=$nuevo;
    }

    /**
     * devuelve el valor
     * @return array
     */
    public function getContratos(){
        return $this->colContratos;
    }

    /**
     * cambia el valor
     * @param array $nuevo
     * @return void
     */
    public function setContratos($nuevo){
        $this->colContratos=$nuevo;
    }

    public function __tostring(){
        $r="La empresa cuenta con los planes:\n";
        $planes= $this->getPlanes();
        foreach($planes as $plan){
            $r .= "- " . $plan->__tostring() . "\n";
        }
        $contratos= $this->getContratos();
        $r .= "\nContratos:\n";
        foreach($contratos as $contrato){
            $r .= "- " . $contrato->__tostring() . "\n";
        }
        return $r;
    }

    public function incorporarPlan($unNuevoPlan){
        $planes= $this->getPlanes();
        $cantPlanes= count($planes);
        $existe= false;
        $resultado=false;

        for( $i=0 ; $i<$cantPlanes ; $i++){
            if( $unNuevoPlan->getCanales() === $planes[$i]->getCanales() && 
                $unNuevoPlan->getMgDatos() === $planes[$i]->getMgDatos()){
                    $existe=true;
            }
        }
        if(!$existe){
            $planes[]=$unNuevoPlan;
            $this->setPlanes($planes);
            $resultado=true;
        }

        return $resultado;        
    }

    public function buscarContrato($tDoc,$nDoc){
        $encontrado=false;
        $contratos= $this->getContratos();
        $i=0;
        $cantContratos=count($contratos);
        $elContrato=null;

        do{
            if( $contratos[$i]->getCliente()->getTipoDoc() === $tDoc &&
                $contratos[$i]->getCliente()->getNumDoc()){
                    $encontrado=true;
                    $elContrato= $contratos[$i];
            }else{
                $i++;
            }
        }while($i<$cantContratos && !$encontrado);

        return $elContrato;
    }

    /**
     * corrobora que no exista un contrato previo con el cliente, en caso de existir y encontrarse activo se debe dar de baja
     * @param object $objPlan
     * @param object $refClie
     * @param string $fIni
     * @param string $fVen
     * @param bool $esWeb true si es via web false si es en la empresa
     * @return void
     */
    public function incorporarContrato($objPlan, $refClie, $fIni, $fVen, $esWeb){
        $tieneContrato= $this->buscarContrato( $refClie->getTipoDoc(), $refClie->getNumDoc());
        $canContratos= count($this->getContratos());

        if($tieneContrato == !null){
            $tieneContrato->setEstado("finalizado");
        }
        if($esWeb){
            $contratos[]= new ContratoWeb($canContratos, $fIni,$fVen,$objPlan,"al dia", 10000, true, $refClie);
        }else{
            $contratos[]= new Contrato($canContratos, $fIni,$fVen,$objPlan,"al dia", 10000, true, $refClie);
        }
    }

    public function retornarPromImporteContratos($cod){
        $impContratos=0;
        $contConPlan=0;
        $contratos= $this->getContratos();
        $cantContratos= count($contratos);

        for($i=0 ; $i<$cantContratos ; $i++){
            if($contratos[$i]->getPlan()->getCodigo() === $cod){
                $impContratos += $contratos[$i]->calcularImporte();
                $contConPlan++;
            }
        }

        if($contConPlan>0){
            $prom= $impContratos / $contConPlan;
        }else{
            $prom=0;
        }

        return $prom;
    }

    public function pagarContrato($cod){
        $encontrado=false;
        $i=0;
        $contratos= $this->getContratos();
        $cantContratos= count($contratos);
        $realizado= false;

        do{
            if( $contratos[$i]->getCodigo() === $cod){
                $encontrado= true;
                $elContrato= $contratos[$i];
            }else{
                $i++;
            }
        } while($i<$cantContratos && !$encontrado);

        if($encontrado){
            $estado= $elContrato->getEstado();
            $ini=new DateTime();
            $ven= $ini->modify('+1 month');
            if($estado === "al dia"){
                $elContrato->setFechaInicio($ini);
                $elContrato->setFechaVencimiento($ven);
            }elseif($estado === "moroso"){
                $elContrato->setEstado("al dia");
                $elContrato->setFechaInicio($ini);
                $elContrato->setFechaVencimiento($ven);
                $elContrato->setCosto( $elContrato->getCosto() + ($elContrato->getCosto()* 0.10*$elContrato->diasContratoVencido()));
            }elseif($estado === "suspendido"){
                $elContrato->setCosto( $elContrato->getCosto() + ($elContrato->getCosto()* 0.10*$elContrato->diasContratoVencido()));
            }
            $realizado= true;
        }

        return $realizado;
    }

}
?>