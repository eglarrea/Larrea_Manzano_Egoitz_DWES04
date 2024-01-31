<?php

class CineController implements Controller{
    private $ddbbConexionCine;
    private $ddbbConexionSala;
    function __construct(){
        $this->ddbbConexionCine =new CineDao();
        $this->ddbbConexionSala =new SalaDao();
    }

    /**
     * Funcion que se ejecuta cuando se va a buscar un cine por su id.
     * @return Respuesta en formato json
     */
    function getDataByID($id){
       $respuesta=new Respuesta();
       $repuesta=$this->ddbbConexionCine->getCineById($id);
       ErrorCodes::setHeader200();
       if(is_bool($repuesta) || $repuesta==null){
            $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_200);
            $respuesta->setError(true);
            $respuesta->setMensajeError("El registro no se ha encontrado");
            $respuesta->setRespuesta("");
       }else{
            $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_200);
            $respuesta->setError(false);
            $respuesta->setRespuesta($repuesta);
       }
       return $respuesta;
    }

    
    /**
     * Funcion no implementada para este controller
     * @return Respuesta en formato json
     */
    public function getAllData(){
        $respuesta=new Respuesta();
        ErrorCodes::setHeader500();
        $respuesta->setError(false);
        $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_500);
        $respuesta->setMensajeError("La solicitud no esta disponible");
        return $respuesta;
    }
    
    /**
    * Funcion para añadir un nuevo cine
    * @return Respuesta en formato json
    */
    function newData($datos){
        $respuesta=new Respuesta();
        if(null!=$datos){
            $cineEntity=createCineForAdd($datos);
            if($cineEntity){
                $actualizado=$this->ddbbConexionCine->addCine($cineEntity);
                if(!$actualizado){
                    $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_500);
                    $respuesta->setError(true);
                    $respuesta->setMensajeError("Se ha producido un error al insertar los datos");
                    $respuesta->setRespuesta("");   
                }else{
                    
                    $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_200);
                    $respuesta->setError(true);
                    $respuesta->setMensajeError("Se ha dado de alta correctamente con el id: ".$actualizado);
                    $respuesta->setRespuesta("");   
                }
            }else{
                $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_200);
                $respuesta->setError(true);
                $respuesta->setMensajeError("No se puede crear el cine porque faltan datos obligatorios");
                $respuesta->setRespuesta("");   
            }
        }else{
            $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_200);
            $respuesta->setError(true);
            $respuesta->setMensajeError("No se puede crear el cine porque no se ha enviado ningun dato");
            $respuesta->setRespuesta("");
        }
        return $respuesta;
    }


    /**
    * Funcion que se actualiza los datos generales del cine y/o la pelicula de una sala del cine
    * Se pasa como parametro el id del cine y los datos a actualizar de la entidad cineEnity
    * @return Respuesta en formato json
    */
    function updateData($id,$datos){
        $respuesta=new Respuesta();
        if(!is_null($id) && is_numeric($id)){
            $cineEntity=createCineForUpdate($id,$datos);
            //$cineEntity=updateCine($id,$datos);
            $actualizado=$this->ddbbConexionCine->updateCine($cineEntity);
            if($actualizado){
                $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_200);
                $respuesta->setError(false);
                $respuesta->setMensajeError("El registro con id: ".$id." se ha actualizado correctamente");
                $respuesta->setRespuesta("");
            }else{
                $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_200);
                $respuesta->setError(true);
                $respuesta->setMensajeError("El registro no se ha encontrado o no se ha actualizado");
                $respuesta->setRespuesta("");
            }
        }else{
            ErrorCodes::setHeader500();
            $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_500);
            $respuesta->setError(true);
            $respuesta->setMensajeError("El identificador del cine es nulo o no es numerico");
            $respuesta->setRespuesta("");
        }
        return $respuesta;
    }

   
    /**
    * Funcion para eliminar un cine. Se pasa como parametro el id del cine
    * @return Respuesta en formato json
    */
    function deleteData($id){
        $respuesta=new Respuesta();
        if(!is_null($id) && is_numeric($id)){
            $eliminado = $this->ddbbConexionCine->deleteCine($id);
            $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_200);
            if($eliminado){
                $respuesta->setError(false);
                $respuesta->setMensajeError("El registro con id: ".$id." se ha eliminado correctamente");
                $respuesta->setRespuesta("");
            }else{
                $respuesta->setError(true);
                $respuesta->setMensajeError("El registro a eliminar no se ha encontrado");
                $respuesta->setRespuesta("");
            }
        }else{
            $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_200);
            $respuesta->setError(true);
            $respuesta->setMensajeError("El identificador del cine es nulo o no es numerico");
            $respuesta->setRespuesta("");
        }
        return $respuesta;
    }

}

?>