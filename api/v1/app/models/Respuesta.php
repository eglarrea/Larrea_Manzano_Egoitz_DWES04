<?php
class Respuesta implements JsonSerializable{

    protected $statusCode;
    protected $error;
    protected $mensajeError;
    protected $respuesta;

    function __construct(){
        $this->statusCode="";
        $this->error="";
        $this->mensajeError="";
        $this->respuesta="";
    }

    function setStatusCode($statusCode){
        $this->statusCode=$statusCode;
    }

    function getError(){
        return $this->error;
    }
    function setError($error){
        $this->error=$error;
    }

    function setMensajeError($mensaje){
        $this->mensajeError=$mensaje;
    }

    function setRespuesta($respuesta){
        $this->respuesta=$respuesta;
    }
    /**
     * Funcion que retorna al cliente la respuesta generada
     * */

    function enviarRespuesta(){
        echo (json_encode($this));
    }

    public function jsonSerialize() {
        $arr = get_object_vars( $this );
        return $arr;
    }
}

?>