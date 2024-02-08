<?php
/**
 * Funcion para cargar los datos enviados por post a la entityda cine para cuando se da de alta
 * $datos ->datos para crear un nuevo cine
  */
function createCineForAdd($datos){
    $respuesta=new Respuesta();
    $respuesta->setError(true);
    $cine = false;
        //comprobamos si en el array de los datos pasados existe la clave nombre
        // si no existe la clave nombre no se crea el cine
        if(existeElementoEnArray($datos,'nombre')==true){
            $cine = new CineEntity(null);
            //comprobamos si en el array de los datos pasados existe la clave salas 
            // y si tiene una clave idSalar
            // si no existe no se crea el cine
            if(existeElementoEnArray($datos,'salas')==true){
                if(existeElementoEnArray($datos['salas'][0],'idSala')==true){
                    cargarCineAEntidad($datos,$cine);
                    cargarSalasAEntidad($datos,$cine);
                }
            }
        }
    return $cine ;
 }

/**
 * 
 * Funcion para cargar los datos enviados por post a la entityda cine para cuando se actualiza
 * $datos ->datos para crear un nuevo cine
 * $id -> id del cine a actualizar
 * $datos ->datos para actualizar
  */ 
 function createCineForUpdate($id,$datos){
    $cine = new CineEntity($id);
    cargarCineAEntidad($datos,$cine);
    cargarSalasAEntidad($datos,$cine);
    return $cine;
 }

 function cargarCineAEntidad($datos,&$cine){
    if(existeElementoEnArray($datos,'mail')==true){
        $cine->setMail($datos['mail']);
    }

    if(existeElementoEnArray($datos,'nombre')==true){
    $cine->setNombre($datos['nombre']);
    }

    if(existeElementoEnArray($datos,'direccion')==true){
        $cine->setDireccion($datos['direccion']);
    
    }

    if(existeElementoEnArray($datos,'telefono')==true){
        $cine->setTelefono($datos['telefono']);
    }
 }

 function cargarSalasAEntidad($datos,&$cine){
    if(existeElementoEnArray($datos,'salas')==true){
        $tempSalas=[];
        for ($a=0; $a<=sizeof($datos['salas'])-1;$a++){
            //Si es un array con varias salas
           // if(is_array(null!=$datos['salas'][$a])){
                if(!is_assoc( $datos['salas'] )){
                
                if(existeElementoEnArray($datos['salas'][$a],'idSala')==true){
                    $sala=new SalaEntity($cine->getId(),$datos['salas'][$a]['idSala'],);
                    if(existeElementoEnArray($datos['salas'][$a],'pelicula')==true){
                    $sala->setPelicula($datos['salas'][$a]['pelicula']);
                    }
                    if(existeElementoEnArray($datos['salas'][$a],'aforo')==true){
                        $sala->setAforo($datos['salas'][$a]['aforo']);
                    }
                    if(existeElementoEnArray($datos['salas'][$a],'es3d')==true){
                    $sala->setEs3d($datos['salas'][$a]['es3d']);
                    }
                    array_push($tempSalas,$sala);
                }
            }else{
                 //Si es una única sala
                if(existeElementoEnArray($datos['salas'],'idSala')==true){
                    $sala=new SalaEntity($cine->getId(),$datos['salas']['idSala'],);
                    if(existeElementoEnArray($datos['salas'],'pelicula')==true){
                    $sala->setPelicula($datos['salas']['pelicula']);
                    }
                    if(existeElementoEnArray($datos['salas'],'aforo')==true){
                        $sala->setAforo($datos['salas']['aforo']);
                    }
                    if(existeElementoEnArray($datos['salas'],'es3d')==true){
                    $sala->setEs3d($datos['salas']['es3d']);
                    }
                    array_push($tempSalas,$sala);
                    break;
                }
            }
        }
        $cine->setSalas($tempSalas);
    }
 }

 function is_assoc( $array ) {
	return array_keys( $array ) !== range( 0, count($array) - 1 );
}
?>


