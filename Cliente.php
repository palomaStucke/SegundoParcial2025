<?php
class Cliente{
    private $nombre;
    private $apellido;
    private $tipo;
    private $numero_doc;

    public function __construct($nom,$ape,$tipD,$numDoc){
        $this->nombre=$nom;
        $this->apellido=$ape;
        $this->tipo=$tipD;
        $this->numero_doc=$numDoc;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nuevo){
        $this->nombre=$nuevo;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function setApellido($nuevo){
        $this->apellido=$nuevo;
    }

    public function getTipoDoc(){
        return $this->tipo;
    }
    
    public function setTipoDoc($nuevo){
        $this->tipo=$nuevo;
    }

    public function getNumDoc(){
        return $this->numero_doc;
    }

    public function setNumDoc($nuevo){
        $this->numero_doc=$nuevo;
    }

    public function __tostring(){
        return "Nombre: ".$this->getNombre()." Apellido: ".$this->getApellido() ." Tipo y número de documento: ". $this->getTipoDoc()." ". $this->getNumDoc();
    }

}
?>