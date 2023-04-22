<?php
include_once("ViajeModificado.php");
include_once("Pasajero.php");
include_once("ResponsableV.php");

function menu(){
    echo " 1. Mostrar Datos Pasajeros "."\n"." 2. Mostrar Datos del Viaje "."\n"." 3. Mostrar Datos Responsable "."\n"." 4. Modificar Pasajero "."\n"." 5. Modificar Responsable "."\n". " 6. Modificar Viaje "."\n"." 7. Agregar Pasajero "."\n"." 8. Agregar Responsable "."\n"." 9. Salir"."\n"."Ingrese Opción: ";
    $opcion=trim(fgets(STDIN));
    return $opcion;
}
$objResponsable=[];
$responsable1=new ResponsableV(15,22,"Pepe","Mero");
$responsable2=new ResponsableV(3,58,"Paulo","Clavito");
$responsable3=new ResponsableV(6,71,"Pedro", "Piedra");
array_push($objResponsable,$responsable1,$responsable2,$responsable3);

$objPasajero=[];
$pasajero1=new Pasajero("Luis","Lopez",45001145,2994555542,$objResponsable);
$pasajero2=new Pasajero("María","Merced",4545443,2994884659,$objResponsable);
$pasajero3=new Pasajero("Mía", "Vera",47115550,2994758562,$objResponsable);
array_push($objPasajero,$pasajero1,$pasajero2,$pasajero3);


$objViaje= new Viaje(44,"Colombia",20,$objPasajero,$objResponsable);

$opcion=menu();

do{
    switch($opcion){
        case 1:
            echo $objViaje->mostrarDatosPasajeros();
            
            $opcion=menu();
            break;
        case 2:
            echo $objViaje;
            $opcion=menu();
            break;
        case 3:
            echo $objViaje->mostrarDatosResponsables();
            $opcion=menu();
        case 4:
            echo "Ingrese Número de Documento para Modificar Pasajero: ";
            $numDocuPas=trim(fgets(STDIN));
            $indice=$objViaje->buscarPasajero($numDocuPas);
            if($indice>=0){
                echo "Nombre Pasajero: ";
                $nombrePas=trim(fgets(STDIN));
                echo "Apellido Pasajero: ";
                $apellidoPas=trim(fgets(STDIN));
                echo "Teléfono: ";
                $telefonoPas=trim(fgets(STDIN));
                echo "Número Documento: ";
                $numDocu=trim(fgets(STDIN));

                $result=$objViaje->modificarPasajero($indice,$nombrePas,$apellidoPas,$telefonoPas,$numDocu);
                if($result){
                    echo "Modificado. "."\n";
                }
            }else{
                echo "El pasajero NO se encontró en el viaje "."\n";
            }
            $opcion=menu();
            break;
        case 5:
            echo "Ingrese Número de Licencia para modificar Responsable: ";
            $numR=trim(fgets(STDIN));
            $indice=$objViaje->buscarResponsable($numR);
            if($indice>=0){
                echo "Número Empleado: ";
                $numEmpleado=trim(fgets(STDIN));
                echo "Número Licencia: ";
                $numLicencia=trim(fgets(STDIN));
                echo "Nombre: ";
                $nombre=trim(fgets(STDIN));
                echo "Apellido: ";
                $apellido=trim(fgets(STDIN));

                $result=$objViaje->modificarResponsable($indice,$numEmpleado,$numLicencia,$nombre,$apellido);
                if($result){
                    echo "Modificado. "."\n";
                }
            }else{
                echo "El Responsable no se encontró. "."\n";
            }
            $opcion=menu();
            break;
        case 6:
                echo "Nuevo Codigo: ";
                $nuevoCodigo=trim(fgets(STDIN));
                echo "Nuevo Destino: ";
                $nuevoDestino=trim(fgets(STDIN));
                echo "Cant Max de Pasajeros: ";
                $cantMaxPas=trim(fgets(STDIN)); 
                $objViaje->modificarViaje($nuevoCodigo,$nuevoDestino,$cantMaxPas);

            $opcion=menu();
            break;
        case 7:
            if(count($objPasajero)<$objViaje->getCantMaxPas()){
            
                    echo "Número Documento: ";
                    $numDocuNuevo=trim(fgets(STDIN));
                    $indice=$objViaje->buscarPasajero($numDocuNuevo);
                    if($indice<0){
                        echo "Ingrese Nombre: ";
                        $nombreNuevo=trim(fgets(STDIN));
                        echo "Ingrese Apellido: ";
                        $apellidoNuevo=trim(fgets(STDIN));
                        echo "Número Teléfono: ";
                        $numTelNuevo=trim(fgets(STDIN));
                        $nuevoPasajero=new Pasajero($nombreNuevo,$apellidoNuevo,$numDocuNuevo,$numTelNuevo,$objResponsable);
                        $objViaje->agregarPasajero($nuevoPasajero,$objPasajero); 
                        
                    }else{
                        echo "Pasajero Ya Ingresado"."\n";
                    }
            }
            $opcion=menu();
            break;
        case 8:
           echo "Número de Licencia: ";
           $numLicencia=trim(fgets(STDIN));
           $indice=$objViaje->buscarResponsable($numLicencia);
           if($indice<0){
                echo "Número de Empleado: ";
                $numEmpleado=trim(fgets(STDIN));
                echo "Nombre: ";
                $nombre=trim(fgets(STDIN));
                echo "Apellido: ";
                $apellido=trim(fgets(STDIN));
                $nuevoRespo=new ResponsableV($numEmpleado,$numLicencia,$nombre,$apellido);
                $objViaje->agregarResponsable($nuevoRespo);
            }else{
                echo "Responsable ya ingresado. "."\n";
            }
            $opcion=menu();
            break;
    }
}while($opcion!=9);
