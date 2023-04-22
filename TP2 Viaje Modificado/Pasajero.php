<?php
class Pasajero{
    private $nombre;
    private $apellido;
    private $numDocu;
    private $telefono;
    private $responsable; //obj 
    //se crean los objts con el metodo constructor 
    public function __construct($nombre,$apellido,$numDocu,$telefono,$responsable){
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->numDocu=$numDocu;
        $this->telefono=$telefono;
        $this->responsable=$responsable;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }
    public function setApellido($apellido){
        $this->apellido=$apellido;
    }

    public function getNumDocu(){
        return $this->numDocu;
    }
    public function setNumDocu($numDocu){
        $this->numDocu=$numDocu;
    }

    public function getTelefono(){
        return $this->telefono;
    }
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }

    public function getResponsable(){
        return $this->responsable;
    }
    public function setResponsable($responsable){
        $this->responsable=$responsable;
    }

    public function __toString(){
        return "Nombre: ".$this->getNombre()."\n"."Apellido: ".$this->getApellido()."\n"."Número Documento: ".$this->getNumDocu()."\n"."Teléfono: ".$this->getTelefono()."\n"."Responsable: ".$this->getResponsable();
    }    

}