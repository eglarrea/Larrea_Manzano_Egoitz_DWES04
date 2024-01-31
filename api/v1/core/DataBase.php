<?php
ini_set('display_errors','On');
class DataBase {
    private static $instance;
    private $conexion;
    private $datosConfiguracion = [];
    

    private function __construct(){
        $this->loadConfig();
        $this->conectToDataBase();
    }
    private  function conectToDataBase(){
        try{
            $this->conexion=new PDO("mysql:host={$this->datosConfiguracion['host']};dbname={$this->datosConfiguracion['database']};charset=utf8",$this->datosConfiguracion['user'],$this->datosConfiguracion['password']);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $ex) {
            die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
        }

    }

    private function loadConfig(){
        $contenidoFichero=file_get_contents("../config/dataBase.json");
        $this->datosConfiguracion=json_decode($contenidoFichero,true);
    }

    public static function getInstance(){
        if (!self::$instance){
            self::$instance= new self();
        }
        return self::$instance;
    }


    public function getConexion(){
        return $this->conexion;
    }
    
}


/*$variable=DataBase::getInstance();
$a='fdsa';
$variable=DataBase::getInstance();
$a='fdsa';*/
?>