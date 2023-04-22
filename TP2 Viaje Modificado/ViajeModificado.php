<?php
class Viaje{
    private $codigo;
    private $destino;
    private $cantMaxPas;
    private $pasajeros;//OBJ pasajero
    private $responsable; //OBJ responsable

    public function __construct($codigo,$destino,$cantMaxPas,$pasajeros,$responsable){
        $this->codigo=$codigo;
        $this->destino=$destino;
        $this->cantMaxPas=$cantMaxPas;
        $this->pasajeros=$pasajeros;
        $this->responsable=$responsable;
    }

    public function getCodigo(){
        return $this->codigo;
    }
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }
    Public function getDestino(){
        return $this->destino;
    }
    public function setDestino($destino){
        $this->destino=$destino;
    }
    public function getCantMaxPas(){
        return $this->cantMaxPas;
    } 
    public function setCantMaxPas($cantMaxPas){
        $this->cantMaxPas=$cantMaxPas;
    }
    public function getPasajeros(){
        return $this->pasajeros;
    }
    public function setPasajeros($pasajeros){
        $this->pasajero=$pasajeros;
    }

    public function getResponsable(){
        return $this->responsable;
    }
    public function setResponsable($responsable){
        $this->responsable=$responsable;
    }
   
    public function __toString(){
        return "Código: " . $this->getCodigo() . "\n" . "Destino: " . $this->getDestino() . "\n" . "Cantidad Max de Pasajeros: " . $this->getCantMaxPas() . "\n"."Pasajeros: "."\n".$this->mostrarDatosPasajeros()."\n"."Responsables: "."\n".$this->mostrarDatosResponsables()."\n";
    }


    public function mostrarDatosPasajeros(){
        $colPasajeros=$this->getPasajeros();
        $cadena="";
        for($i=0; $i<count($colPasajeros); $i++){
            $objPas=$colPasajeros[$i];
            $nombre=$objPas->getNombre();
            $apellido=$objPas->getApellido();
            $dni=$objPas->getNumDocu();
            $telefono=$objPas->getTelefono();
            $cadena=$cadena."Pasajero: ". $nombre." ".$apellido." ".$dni." ".$telefono."\n";
        }
        return $cadena;
    }

    public function buscarPasajero($dni){
        $colPasajeros=$this->getPasajeros();
        $i=0;
        $encontro=false;
        while($i<count($colPasajeros) && !$encontro){
            $encontro=$colPasajeros[$i]->getNumDocu()==$dni;
            $i++;
        }
        if($encontro==false){
            $i=-1;
        }
        return $i-1; 
    }

    
    public function modificarPasajero($indice,$nombre,$apellido,$telefono,$numDocu){
        
        $modifico=false;
        if($indice>=0){
            $colPasajeros=$this->getPasajeros();
            $colPasajeros[$indice]->setNombre($nombre);
            $colPasajeros[$indice]->setApellido($apellido);
            $colPasajeros[$indice]->setTelefono($telefono);
            $colPasajeros[$indice]->setNumDocu($numDocu);
            $modifico=true;
        }
        return $modifico;
    }
   
    public function agregarPasajero($objPas,$colPasajeros){
        array_push($colPasajeros,$objPas);
        //print_r($colPasajeros);
    }

    public function agregarResponsable($objRes){
        $colResponsable=$this->getResponsable();
        $colResponsable[]=$objRes;
    }
    public function buscarResponsable($numLicencia){
        $colResponsable=$this->getResponsable();
        $encontro=false;
        $i=0;
        while($i<count($colResponsable) && !$encontro){
            $encontro=$colResponsable[$i]->getNumLicencia()==$numLicencia;
            $i++;
        }
        if(!$encontro){
            $i=-1;
        }
        return $i-1;
    }

    public function mostrarDatosResponsables(){
        $colResponsable=$this->getResponsable();
        $cadena="";
        for($i=0; $i<count($colResponsable); $i++){
            $objResponsable=$colResponsable[$i];
            $numEmpleado=$objResponsable->getNumEmpleado();
            $numLicencia=$objResponsable->getNumLicencia();
            $nombre=$objResponsable->getNombre();
            $apellido=$objResponsable->getApellido();
            
            $cadena=$cadena."Conductor: ". $nombre." ".$apellido." NroE: ". $numEmpleado." NroL: ".$numLicencia."\n";
        }
        return $cadena;
    }

    public function modificarResponsable($indice,$numEmpleado,$numLicencia,$nombre,$apellido){
        $colResponsable=$this->getResponsable();
        $modifico=false;
        if($indice>=0){
            $colResponsable[$indice]->setNumEmpleado($numEmpleado);
            $colResponsable[$indice]->setNumLicencia($numLicencia);
            $colResponsable[$indice]->setNombre($nombre);
            $colResponsable[$indice]->setApellido($apellido);
            $modifico=true;  
        }
        return $modifico;
    }

    public function modificarViaje($codigo,$destino,$cantMaxPas){
       $this->setCodigo($codigo);
       $this->setDestino($destino);
       $this->setCantMaxPersona($cantMaxPas);
    }
}