<?php

require("../app/models/DTO/SalaDTO.php");
class SalaDao extends Dao{
  
    public function __construct(){
        parent::__construct();
    }


    public function addSala($enitytSala){
        $sentencia=$this->conexion->prepare("insert into salas (idCine,idSala,pelicula,aforo,es3d) 
                                            values (:idCine,:idSala,:pelicula,:aforo,:es3d)");

        $idCine= $enitytSala->getIdCine();
        $idSala = $enitytSala->getIdSala();
        $sentencia->bindValue(':idCine',  $idCine);
        $sentencia->bindValue(':idSala',  $idSala);
        $sentencia->bindValue(':pelicula', $enitytSala->getPelicula());
        $sentencia->bindValue(':aforo', $enitytSala->getAforo());
        $sentencia->bindValue(':es3d', $enitytSala->getEs3d());
        $sentencia->execute();
        $retorno=$sentencia->rowCount();

        if ($retorno >= 1){
            return true;
        }else{
            return false;
        }
    }
    
    public function updateSala($enitytSala){
        $setValues=$this->setValuesUpdate($enitytSala);
       
        $sentencia=$this->conexion->prepare("update salas set ".$setValues. " where idCine=:idCine and idSala=:idSala ");

        $idCine= $enitytSala->getIdCine();
        $idSala = $enitytSala->getIdSala();

        $sentencia->bindValue(':idCine',  $idCine);
        $sentencia->bindValue(':idSala',  $idSala);
        

        if (null!=$enitytSala->getPelicula()){
            $sentencia->bindValue(':pelicula', $enitytSala->getPelicula());
            $setcomma=',';
        }
        
        if (null!=$enitytSala->getAforo()){
            $setValues=$setValues.$setcomma;
            $sentencia->bindValue(':aforo', $enitytSala->getAforo());
            $setcomma=',';
        }
        
        if (null!=$enitytSala->getEs3d()){
            $setValues=$setValues.$setcomma;
            $sentencia->bindValue(':es3d', $enitytSala->getEs3d());
        }
       
        $actual=$sentencia->execute();
        $retorno=$sentencia->rowCount();

        if ($retorno >= 1){
            return true;
        }else{
            return false;
        }

    }

    public function getSalasByIdCine($idCine){
        $sentencia=$this->conexion->prepare("select * from  salas where idCine=:idCine");
        $sentencia->bindValue(':idCine', $idCine);
        $sentencia->execute();
        $salas=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        $salasCine=[];
        for ($i=0; $i < count($salas); $i++) { 
            $fila=$salas[$i];
            $sala= new SalaDTO($fila['idSala'],$fila['pelicula'],$fila['aforo'],$fila['es3d']);
            array_push($salasCine,$sala);
        }
        return $salasCine;
    }


    private function setValuesUpdate($enitytSala){
        $setValues='';
        $setcomma='';
        if (null!=$enitytSala->getPelicula()){
            $setValues=$setValues.' pelicula=:pelicula';
            $setcomma=',';
        }
        
        if (null!=$enitytSala->getAforo()){
            $setValues=$setValues.$setcomma;
            $setValues=$setValues.' aforo=:aforo';
            $setcomma=',';
        }
        
        if (null!=$enitytSala->getEs3d()){
            $setValues=$setValues.$setcomma;
            $setValues=$setValues.' es3d=:es3d';
        }
        
        return $setValues;
    }

}

?>