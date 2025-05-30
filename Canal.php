<?php
class Canal{
    private $tipo;
    private $importe;
    private $hd;

    /**
     * crea la clase
     * @param string $t tipo (noticia/deportivo/infantil/etc)
     * @param float|int $i importe
     * @param bool $hd si es hd o no
     */
    public function __construct($t,$i,$hd){
        $this->tipo=$t;
        $this->importe=$i;
        $this->hd=$hd;
    }

    /**
     * devuelve el valor
     * @return string
     */
    public function getTipo(){
        return $this->tipo;
    }

    /**
     * cambia el valor
     * @param string $nuevo
     * @return void
     */
    public function setTipo($nuevo){
        $this->tipo=$nuevo;
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
     * @return bool
     */
    public function getHD(){
        return $this->hd;
    }

    /**
     * cambia el valor
     * @param bool $nuevo
     * @return void
     */
    public function setHD($nuevo){
        $this->hd=$nuevo;
    }

    public function __tostring(){
        $r="El canal es " . $this->getTipo() . "\nImporte: $" . $this->getImporte() . "\n";

        if($this->getHD()){
            $r .= "Es HD";
        }else{
            $r .= "No es HD";
        }

        return $r;
    }
}
?>