<?php
class Home {
    private $listaRutasValidas=array(); 

    /**
     * Funcion que retonar la lista de rutas activas en el api.
     * @return Respuesta en formato json
     */
    function index($ruta){
        $sw_encontrado=false;
        $respuesta=new Respuesta();
        //obtenemos la lista de las rutas activas y creamos un array con la url y method para 
        //retornar al usuario y sepa que rutas hay disponibles
        foreach($ruta as $posicion=>$ruta)
        {
            $arrayRutas=array();
            $arrayRutas['ruta']= $posicion;
            $arrayRutas['methodType']=  $ruta['methodType'];
            array_push($this->listaRutasValidas,$arrayRutas);
            $sw_encontrado=true;
        }
               
        if(!$sw_encontrado){
            $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_200);
            $respuesta->setError(true);
            $respuesta->setMensajeError("Las rutas no estan activas");
            $respuesta->setRespuesta("");
            
        }else{
            $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_200);
            $respuesta->setError(false);
            $respuesta->setMensajeError("El Api consta de estas rutas y methods types permitidos");
            $respuesta->setRespuesta($this->listaRutasValidas);
        }
        
        $respuesta->enviarRespuesta();
    }
}

?>