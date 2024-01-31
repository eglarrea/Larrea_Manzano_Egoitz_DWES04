<?php
require("../core/Database.php");
abstract class Dao{
    protected $conexion;

    public function __construct(){
        $instancia=DataBase::getInstance();
        $this->conexion= $instancia->getConexion();
    }

}

?>