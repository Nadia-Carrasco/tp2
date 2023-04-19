<?php
include_once("ViajeModificado.php");
include_once("Pasajero.php");
include_once("ResponsableV.php");

/**
 * Muestra un menu con varias opciones
 * @return int
*/
function menu(){
    echo "1. Agregar Viaje "."\n"."2. Agregar Datos del Conductor"."\n"."3. Agregar Datos del Pasajero "."\n"."4. Modificar Conductor"."\n"."5. Modificar Pasajero"."\n"."6. Modificar Viaje"."\n"."7. Mostrar Datos Conductor"."\n"."8. Mostrar Datos Pasajero "."\n"."9. Mostrar datos Viaje"."\n"."10. Salir"."\n"."Ingrese Opción: ";
    $opcion=trim(fgets(STDIN));
    return $opcion;
}

$opcion=menu();
$colViaje=[];
$colPasajero=[];
$colResponsable=[];

do{
    
    switch($opcion){
        case 1:
            echo "Ingrese Cantidad de Viajes: ";
            $cantViajes=trim(fgets(STDIN));
            $i=0;
            do{
                if(count($colViaje)==0){
                    echo "Ingrese código del viaje: ";
                    $codigoViaje=trim(fgets(STDIN));
                    echo "Ingrese Destino: ";
                    $destinoViaje=trim(fgets(STDIN));
                    echo "Cantidad Max de Pasajeros: ";
                    $cantMaxPasajeros=trim(fgets(STDIN));
                    $newViaje=new Viaje($codigoViaje,$destinoViaje,$cantMaxPasajeros,$colPasajero,$colResponsable);
                    $colViaje[]=$newViaje;
                }else{
                    echo "Ingrese código del viaje: ";
                    $codigoViaje=trim(fgets(STDIN));
                    $result=$newViaje->buscarViaje($colViaje,$codigoViaje);
                    if($result>=0){
                        do{
                            echo "Viaje Ya Ingresado. Ingrese otro codigo: ";
                            $codigoViaje=trim(fgets(STDIN));
                            $result=$newViaje->buscarViaje($colViaje,$codigoViaje);
                        }while($result<0);
                        echo "Ingrese Destino: ";
                        $destinoViaje=trim(fgets(STDIN));
                        echo "Cantidad Maxima de Pasajeros: ";
                        $cantMaxPasajeros=trim(fgets(STDIN));
                        $newViaje=new Viaje($codigoViaje,$destinoViaje,$cantMaxPasajeros,$colPasajero,$colResponsable);
                        $colViaje[]=$newViaje;
                    }else{
                        echo "Ingrese Destino: ";
                        $destinoViaje=trim(fgets(STDIN));
                        echo "Cantidad Maxima de Pasajeros: ";
                        $cantMaxPasajeros=trim(fgets(STDIN));
                        $newViaje=new Viaje($codigoViaje,$destinoViaje,$cantMaxPasajeros,$colPasajero,$colResponsable);
                        $colViaje[]=$newViaje;
                    }
                }
                $i++;
            }while($i!=$cantViajes);
            $opcion=menu();
            break;
        case 2:
            echo "Ingrese Cantidad de Conductores: ";
            $cantConduc=trim(fgets(STDIN));
            $i=0;
            do{
                if($colViaje>0){
                    if(count($colResponsable)==0){
                        echo "Número del Conductor: ";
                        $numConduc=trim(fgets(STDIN));
                        echo "Número de Licencia del Conductor: ";
                        $numLicenciaConduc=trim(fgets(STDIN));
                        echo "Nombre del Conductor: ";
                        $nameConduc=trim(fgets(STDIN));
                        echo "Apellido del Conductor: ";
                        $apellidoConduc=trim(fgets(STDIN));   
                        $newConduc=new ResponsableV($numConduc,$numLicenciaConduc,$nameConduc,$apellidoConduc);
                        $colResponsable[]=$newConduc;
                    }else{
                            echo "Número del Conductor: ";
                            $numConduc=trim(fgets(STDIN));
                            echo "Número de Licencia del Conductor: ";
                            $numLicenciaConduc=trim(fgets(STDIN));
                            $result=$newViaje->buscarResponsable($numLicenciaConduc);
                            if($result){
                                do{
                                    echo "Conductor Ya Ingresado. Ingrese número del Conductor: ";
                                    $numConduc=trim(fgets(STDIN));
                                    echo "Número de Licencia del Conductor: ";
                                    $numLicenciaConduc=trim(fgets(STDIN));
                                    $result=$newViaje->buscarResponsable($numLicenciaConduc);
                                }while($result=false);
                                    
                        
                            }else{
                                echo "Nombre del Conductor: ";
                                $nameConduc=trim(fgets(STDIN));
                                echo "Apellido del Conductor: ";
                                $apellidoConduc=trim(fgets(STDIN));   
                                $newConduc=new ResponsableV($numConduc,$numLicenciaConduc,$nameConduc,$apellidoConduc);
                                $colResponsable[]=$newConduc;
                            }
                    }
                    
                    
                }else{
                    echo "Primero debe Ingresar un Viaje. Vuelva a la opción 1."."\n";
                }
                $i++;
            }while($i!=$cantConduc);
            $opcion=menu();
            break;
        case 3:
            echo "Ingrese nombre pasajero: ";
            $namePas=trim(fgets(STDIN));
            echo "Ingrese Apellido pasajero: ";
            $apellidoPas=trim(fgets(STDIN));
            echo "Ingrese numero documento pasajero: ";
            $numDocuPas=trim(fgets(STDIN));
            echo "Ingrese telefono pasajero: ";
            $telefonoPas=trim(fgets(STDIN));  
            $newPas=new Pasajero($namePas,$apellidoPas,$numDocuPas,$colResponsable); 
            break;
    }
}while($opcion!=10);
/*
do{

    switch($opcion){
        case 1:
            echo "Ingrese Cantidad de Viajes: ";
            $cantViajes=trim(fgets(STDIN));
            $i=0;
            do{
                if(count($colViaje)==0){
                    echo "Ingrese código del viaje: ";
                    $codigoViaje=trim(fgets(STDIN));
                    echo "Ingrese Destino: ";
                    $destinoViaje=trim(fgets(STDIN));
                    echo "Cantidad Max de Pasajeros: ";
                    $cantMaxPasajeros=trim(fgets(STDIN));
                    $newViaje=new Viaje($codigoViaje,$destinoViaje,$cantMaxPasajeros,$colPasajero,$colResponsable);
                    $colViaje[]=$newViaje;
                }else{
                    echo "Ingrese código del viaje: ";
                    $codigoViaje=trim(fgets(STDIN));
                    $result=$newViaje->buscarViaje($colViaje,$codigoViaje);
                    if($result>=0){
                        do{
                            echo "Viaje Ya Ingresado. Ingrese otro codigo: ";
                            $codigoViaje=trim(fgets(STDIN));
                            $result=$newViaje->buscarViaje($colViaje,$codigoViaje);
                        }while($result<0);
                        echo "Ingrese Destino: ";
                        $destinoViaje=trim(fgets(STDIN));
                        echo "Cantidad Maxima de Pasajeros: ";
                        $cantMaxPasajeros=trim(fgets(STDIN));
                        $newViaje=new Viaje($codigoViaje,$destinoViaje,$cantMaxPasajeros,$colPasajero,$colResponsable);
                        $colViaje[]=$newViaje;
                    }else{
                        echo "Ingrese Destino: ";
                        $destinoViaje=trim(fgets(STDIN));
                        echo "Cantidad Maxima de Pasajeros: ";
                        $cantMaxPasajeros=trim(fgets(STDIN));
                        $newViaje=new Viaje($codigoViaje,$destinoViaje,$cantMaxPasajeros,$colPasajero,$colResponsable);
                        $colViaje[]=$newViaje;
                    }
                }
                $i++;
            }while($i!=$cantViajes);
            $opcion=menu();
            break;
        case 2:
            echo "Ingrese Cantidad de Conductores: ";
            $cantConduc=trim(fgets(STDIN));
            $i=0;
            do{
                if(count($colViaje)>0){
                    if(count($colResponsable)==0){
                        echo "Ingrese Número de Empleado: ";
                        $numConduc=trim(fgets(STDIN));
                        echo "Ingrese Número de Licencia: ";
                        $numLicencia=trim(fgets(STDIN));
                        echo "Ingrese Nombre: ";
                        $nameConduc=trim(fgets(STDIN));
                        echo "Ingrese Apellido: ";
                        $apellidoConduc=trim(fgets(STDIN));
                        $newConduc=new ResponsableV($numConduc,$numLicencia,$nameConduc,$apellidoConduc);
                        $colResponsable[]=$newConduc;
                        
                    }else{
                        echo "Ingrese Número de Empleado: ";
                        $numConduc=trim(fgets(STDIN));
                        echo "Ingrese Número de Licencia: ";
                        $numLicencia=trim(fgets(STDIN));
                        $result=$newViaje->buscarEmpleado($numLicencia);
                        if($result>=0){
                            do{
                                echo "Empleado Ya Ingresado. Ingrese Número de Empleado: ";
                                $numConduc=trim(fgets(STDIN));
                                echo "Ingrese Número de Licencia: ";
                                $numLicencia=trim(fgets(STDIN));
                                $result=$newViaje->buscarEmpleado($numLicencia);
                            }while($result<0);
                            echo "Ingrese Nombre: ";
                            $nameConduc=trim(fgets(STDIN));
                            echo "Ingrese Apellido: ";
                            $apellidoConduc=trim(fgets(STDIN));
                            $newConduc=new ResponsableV($numConduc,$numLicencia,$nameConduc,$apellidoConduc);
                            $colResponsable[]=$newConduc;
                        }else{
                            echo "Ingrese Nombre: ";
                            $nameConduc=trim(fgets(STDIN));
                            echo "Ingrese Apellido: ";
                            $apellidoConduc=trim(fgets(STDIN));
                            $newConduc=new ResponsableV($numConduc,$numLicencia,$nameConduc,$apellidoConduc);
                            $colResponsable[]=$newConduc;
                        }   
                    }  
                }else{
                    echo "Primero debe iniciar un viaje. Complete la opcion 1."."\n";
                }
               $i++; 
            }while($i!=$cantConduc);
            $opcion=menu();
            break;
        case 3:
            echo "Ingrese Cantidad de Pasajeros: ";
            $cantPas=trim(fgets(STDIN));
            $i=0;
            do{
                if(count($colViaje)>0){
                    if(count($colPasajero)==0){
                        echo "Ingrese Nombre: ";
                        $namePas=trim(fgets(STDIN));
                        echo "Ingrese Apellido: ";
                        $apellidoPas=trim(fgets(STDIN));
                        echo "Ingrese Número de Documento: ";
                        $numDocuPas=trim(fgets(STDIN));
                        echo "Ingrese Teléfono: ";
                        $telefonoPas=trim(fgets(STDIN));
                        $newPas=new Pasajero($namePas,$apellidoPas,$numDocuPas,$telefonoPas,$colResponsable);
                        $colPasajero[]=$newPas;
                    }else{
                        echo "Ingrese Nombre: ";
                        $namePas=trim(fgets(STDIN));
                        echo "Ingrese Apellido: ";
                        $apellidoPas=trim(fgets(STDIN));
                        echo "Ingrese Número de Documento: ";
                        $numDocuPas=trim(fgets(STDIN));
                        $result=$newViaje->buscarPasajero($numDocuPas);
                        if($result>=0){
                            do{
                                echo "Pasajero ya ingresado. Ingrese nombre nuevo pasajero: ";
                                $namePas=trim(fgets(STDIN));
                                echo "Ingrese Apellido: ";
                                $apellidoPas=trim(fgets(STDIN));
                                echo "Ingrese Número de Documento: ";
                                $numDocuPas=trim(fgets(STDIN));
                                $result=$newViaje->buscarPasajero($numDocuPas);
                            }while($result<0);
                            echo "Ingrese Teléfono: ";
                            $telefonoPas=trim(fgets(STDIN));
                            $newPas=new Pasajero($namePas,$apellidoPas,$numDocuPas,$telefonoPas,$colResponsable);
                            $colPasajero[]=$newPas;
                        }
                        echo "Ingrese Teléfono: ";
                        $telefonoPas=trim(fgets(STDIN));
                        $newPas=new Pasajero($namePas,$apellidoPas,$numDocuPas,$telefonoPas,$colResponsable);
                        $colPasajero[]=$newPas;
                    }
                }else{
                    echo "Primero debe Ingresar un Viaje. Vuelva a la opcion 1."."\n";
                }
                $i++;                
            }while($i!=$cantPas);
            $opcion=menu();
            break;
        case 4:
            break;
        case 5:
            break;
        case 6:
            break;
        case 7:
            if($colViaje>0){
                $mensaje=$newViaje->mostrarDatosResponsables();
                echo $mensaje;
            }else{
                echo "Primero debe Ingresar un Viaje. Vuelva a la opcion 1."."\n";
            }
            $opcion=menu();
            break;
        case 8:
            break;
        case 9:
            break;
    }
}while($opcion!=10);

*/