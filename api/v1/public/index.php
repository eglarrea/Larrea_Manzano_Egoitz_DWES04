<?php
// Rutas de core

require("../config/includesComunes.php");

$ruta= new Router();
$ruta->getRutasValidas();

$url=$_SERVER['QUERY_STRING'];
$methodUrl= $_SERVER['REQUEST_METHOD'];
$urlParams=explode("/",$url);

$urlArray=array(
'HTTP'=>$methodUrl,
'path'=>$url,
'controller'=>'',
'action'=>'',
'params'=>'',
);
$params=[];

if(!empty($urlParams[3])){
    $urlArray['controller']=ucwords($urlParams[3]."Controller");
    if(!empty($urlParams[4])){
        $urlArray['action']=$urlParams[4];
        if(!empty($urlParams[5])){
            $urlArray['params']=$urlParams[5];
        }
    }else{
        $urlArray['action']="getAllData";
    }
}else{
    $methodUrl="GET";
    $urlArray['HTTP']=$methodUrl;
    $urlArray['path']='/v1/public';
    $urlArray['controller']='Home'; 
    $urlArray['action']='index';  
    $params[]=$ruta->getRoutes();
}


$sw_error=false;
if($methodUrl==='GET'){
    $params[]=  intval($urlArray['params']) ?? null;
}elseif ($methodUrl==='POST') {
    $jsonRecibido=file_get_contents('php://input');
    $params[]=json_decode($jsonRecibido, true);
}elseif ($methodUrl==='DELETE') {
    $params[]=  intval($urlArray['params']) ?? null;
}elseif ($methodUrl==='PUT') {
    $jsonRecibido=file_get_contents('php://input');
    $params[]=intval($urlArray['params']) ?? null;
    $params[]=json_decode($jsonRecibido, true);
}else{
    $sw_error=true;
    ErrorCodes::setHeader501();
    $respuesta=new Respuesta();
    $respuesta->setStatusCode(ErrorCodes::HTTP_CODE_501);
    $respuesta->setError(true);
    $respuesta->setMensajeError("El metodo request no esta soportado por el api");
    $respuesta->setRespuesta("");
    $respuesta->enviarRespuesta();
}


if(!$sw_error && $ruta->matchRoutes($urlArray)){
    $controller=$ruta->getParams()['controller'];
    $action=$ruta->getParams()['methodController'];
    $controller= new $controller();
    if(method_exists($controller,$action)){
        $respuesta=call_user_func_array([$controller,$action],$params);
        $respuesta->enviarRespuesta();
    }
}

/*echo('<pre>');
print_r($urlArray).'<br>';

echo('</pre>');
echo('<pre>');
print_r($urlParams).'<br>';

echo('</pre>');*/

?>