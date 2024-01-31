<?php

class CinesController implements Controller{
    private $ddbbConexionCine;
    function __construct(){
         $this->ddbbConexionCine =new CineDao();
    }

    /**
     * Funcion para obtener todos los cines existentes.
     * @return Respuesta en formato json
     */
    function getAllData(){
       $respuesta=new Respuesta();
       $repuesta= $this->ddbbConexionCine->getAllCines();
       ErrorCodes::setHeader200();
       $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_200);
       $respuesta->setError(false);
       $respuesta->setRespuesta($repuesta);
       return $respuesta;
    }

    /**
     * Funcion no implementada para este controller.
     * @return Respuesta en formato json
     */
    public function getDataByID($id){
        $respuesta=new Respuesta();
        ErrorCodes::setHeader500();
        $respuesta->setError(false);
        $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_500);
        $respuesta->setMensajeError("La solicitud no esta disponible");
        return $respuesta;
    }
    
    /**
     * Funcion no implementada para este controller.
     * @return Respuesta en formato json
     */
    public function newData($datos){
        $respuesta=new Respuesta();
        ErrorCodes::setHeader500();
        $respuesta->setError(false);
        $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_500);
        $respuesta->setMensajeError("La solicitud no esta disponible");
        return $respuesta;
    }

    /**
     * Funcion no implementada para este controller.
     * @return Respuesta en formato json
     */
    public function updateData($id,$datos){
        $respuesta=new Respuesta();
        ErrorCodes::setHeader500();
        $respuesta->setError(false);
        $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_500);
        $respuesta->setMensajeError("La solicitud no esta disponible");
        return $respuesta;
    }

    /**
     * Funcion no implementada para este controller.
     * @return Respuesta en formato json
     */
    public function deleteData($datos){
        $respuesta=new Respuesta();
        ErrorCodes::setHeader500();
        $respuesta->setError(false);
        $respuesta->setStatusCode(ErrorCodes::setHeader404());
        $respuesta->setMensajeError("La solicitud no esta disponible");
        return $respuesta;
    }
}

?>