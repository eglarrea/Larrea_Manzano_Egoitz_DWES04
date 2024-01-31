<?php

/**
 * Funcion leer un fichero de una ruta y descodificar el fichero json
 */
function obtenerFicheroJson($rutaFichero){
    try {
        if (!file_exists($rutaFichero))
        {
           throw new Exception("No existe el fichero:".$rutaFichero);
        }else{
            $data = file_get_contents($rutaFichero);
            $datosJson = json_decode($data, true);
            return $datosJson;
        }     
    } catch (Exception $e) {
        $respuesta=new Respuesta();
        $respuesta->setError("true");
        $respuesta->setMensajeError("Se ha producido un error en el sistema");
        ErrorCodes::setHeader500();
        $respuesta->enviarRespuesta();
    }
}

/**
 * Funcion leer un fichero de una ruta y descodificar el fichero json
 */
function guardarFicheroJson($strDatosJson, $rutaFichero){
    $json_string = json_encode($strDatosJson);
    file_put_contents($rutaFichero, $json_string);
}

/**
 * Funcion para comprobar si en un array asociativo existe elemeno
 * $objeto=array(nombre'=>'nombre,'mail'=>'');
 * $campo el el nombre del elemento
 * existeElementoEnArray($datos,'mail')
 */
function existeElementoEnArray($objeto,$campo){
    if(array_key_exists($campo,$objeto)){
        if($objeto[$campo]!=null){
            return true;
        }else{
            return false;
        }
    }
    return false;
 }

?>