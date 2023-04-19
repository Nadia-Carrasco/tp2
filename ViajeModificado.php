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
    public function getCantMaxPersonas(){
        return $this->cantMaxPersona;
    } 
    public function setCantMaxPersona($cantMaxPersona){
        $this->cantMaxPersona=$cantMaxPersona;
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
        return "Código: " . $this->getCodigo() . "\n" . "Destino: " . $this->getDestino() . "\n" . "Cantidad Max de Pasajeros: " . $this->getCantMaxPersonas() . "\n"."Pasajeros: ".$this->getPasajeros()."\n"."Responsable: ".$this->getResponsable();
    }

    public function asignarAsientosDisponibles($cantAsientos){
        $cantDiponible=$this->getCantAsientosDispo();
        $dispo=false;
        if($cantAsientos<=$cantDiponible){
            $dispo=true;
            $cantActualAsientos=$cantDiponible-$cantAsientos;
            $this->setCantAsientosDispo($cantActualAsientos);
        }
        return $dispo;
    }

    public function mostrarDatosPasajeros(){
        $colPasajeros=$this->getPasajeros();
        $cadena="";
        for($i=0; $i<count($colPasajeros); $i++){
            $objPas=$colPasajeros[$i];
            $nombre=$colPasajeros->getNombre();
            $apellido=$colPasajeros->getApellido();
            $dni=$colPasajeros->getNumDocu();
            $telefono=$colPasajeros->getTelefono();
            $cadena=$cadena."Pasajero Nro ".$i.": ". $nombre." ".$apellido." ".$dni;
        }
        return $cadena;
    }

    public function buscarPasajero($dni){
        $colPasajeros=$this->getPasajeros();
        $i=0;
        $encontro=false;
        while($i<count($colPasajeros) && !$encontro){
            $objPas=$colPasajeros[$i];
            $encontro=$objPas->getNumDocu()==$dni;
            $i++;
        }
    
        return $encontro; 
    }

    
    public function modificarPasajero($dniBuscar,$nombre,$apellido,$telefono){
        $indice=$this->buscarPasajero($dniBuscar);
        $modifico=false;
        if($indice>=0){
            $colPasajeros=$this->getPasajeros();
            $colPasajeros[$indice]->setNombre($nombre);
            $colPasajeros[$indice]->setApellido($apellido);
            $colPasajeros[$indice]->setTelefono($telefono);
            $modifico=true;
        }
        return $modifico;
    }

    public function agregarPasajero($nombre,$apellido,$numDocu,$telefono){
        $pasajeros=$this->getPasajeros();
        $indice=$this->buscarPasajero($numDocu);
        $seAgrego=false;
        if($indice<0){
            array_push($pasajeros,$nombre,$apellido,$numDocu,$telefono);
            $seAgrego=true;
        }
        return $seAgrego;
    }

    public function buscarResponsable($numLicencia){
        $colResponsable=$this->getResponsable();
        $encontro=true;
        $i=0;
        while($i<count($colResponsable) && $encontro){
            if($colResponsable[$i]->getNumLicencia()==$numLicencia){
                $encontro=false;
            }
            $i++;
        }
        
        return $encontro;
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
            
            $cadena=$cadena."Pasajero Nro ".$i.": ". $nombre." ".$apellido." NroE: ". $numEmpleado." NroL:".$numLicencia;
        }
        return $cadena;
    }
    
    public function mostrarDeUnSoloResponsable($numLicencia){
        $colResponsable=$this->getResponsable();
        $indice=$this->buscarEmpleado($numLicencia);
        $cadena="";
        $objResponsable=$colResponsable[$indice];
        if($indice>=0){
            $numEmpleado=$objResponsable->getNumEmpleado();
            $numLicencia=$objResponsable->getNumLicencia();
            $nombre=$objResponsable->getNombre();
            $apellido=$objResponsable->getApellido();
            $cadena=$cadena."Responsable: "."\n".$numEmpleado."\n".$numLicencia."\N".$nombre."\n".$apellido;
        }else{
            $cadena="No Se Encuentra. "."\n";
        }
        return $cadena;
    }

    public function modificarResponsable($numLicenciaBuscar,$numEmpleado,$nombre,$apellido){
        $indice=$this->buscarEmpleado($numLicenciaBuscar);
        $modifico=false;
        if($indice>=0){
            $colResponsable=$this->getResponsable();
            $colResponsable[$indice]->setNumEmpleado($numEmpleado);
            $colResponsable[$indice]->setNombre($nombre);
            $colResponsable[$indice]->setApellido($apellido);
            $modifico=true;
        }
        return $modifico;
    }

    public function agregarResponsable($numEmpleado,$numLicencia,$nombre,$apellido){
        $colResponsable=$this->getResponsable();
            $colResponsable=array_push($colResponsable,$numEmpleado,$numLicencia,$nombre,$apellido);
        return $colResponsable;
    }

    public function BuscarViaje($colViajes,$codigo){
        $encontro=false;
        $codigoV=$this->getCodigo();
        $i=0;
        while($i<count($colViajes) && !$encontro){
            $encontro=$codigoV==$codigo;
            $i++;
        }
        return $i-1;
    }
    public function modificarViaje($codigo,$destino,$cantMaxPas){
        $indice=$this->buscarViaje($colViajes,$codigo);
        $modifico=false;
        if($indice>=0){
            $colViajes[$indice]->setCodigo($codigo);
            $colViajes[$indice]->setDestino($destino);
            $colViajes[$indice]->setCantMaxPersona($cantMaxPas);
            $modifico=true;
        }
        return $modifico;
    }
}