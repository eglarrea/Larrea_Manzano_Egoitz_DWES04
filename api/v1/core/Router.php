<?php
class Router {
    protected $routes = array();
    protected $params = array();

    public function addRoute($route,$params){
        $this->routes[$route]=$params;
    }

    public function getRoutes(){
        return $this->routes;
    }

    public function getParams(){
        return $this->params;
    }

    /*public function match($url){
        $urlParams=explode("/",$url['path']);
        foreach($this->routes as $route=>$params){
            if($url['path'] == $route){
                if($params['controller']==$url['controller'] &&
                    $params['action']==$url['action']){
                    $this->params=$params;
                    return true;
                }else{

                }
            }else{
               // return false;
            }
        }
    }*/

    public function matchRoutes($url){      
        foreach($this->routes as $route=>$params){            
            if($url['HTTP']==$params['methodType']){
                $patron=str_replace(['{id}','/'],['([0-9]+)', '\/'],$route);
                $patron='/^'.$patron.'$/';
                if(preg_match($patron,$url['path'])){
                    $this->params=$params;
                    return true;
                }
            }
        }

        ErrorCodes::setHeader404();
        $respuesta=new Respuesta();
        $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_404);
        $respuesta->setError(true);
        $respuesta->setMensajeError("No he ha encontrado el punto de acceso. Url no valida.");
        $respuesta->enviarRespuesta();
        return false;
    }


    /**
     * Funcion que obtniene todas las rutas activas que existes 
     * en el fichero de configuracion de rutas
     */
    function getRutasValidas(){
        $listaRutasActivasApi=obtenerFicheroJson("../config/rutasApi.json");
        if($listaRutasActivasApi!=null){
            for ($i = 0; $i <= sizeof($listaRutasActivasApi)-1; $i++) {
                if($listaRutasActivasApi[$i]['activa']==true){
                    $this->addRoute($listaRutasActivasApi[$i]['ruta'],$listaRutasActivasApi[$i]['params']);
                }
            }
        }
    }
}

?>