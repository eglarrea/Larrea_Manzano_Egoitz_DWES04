<?php
require("../app/models/DTO/CineDTO.php");
class CineDao extends Dao{
    private $salaDao;
    public function __construct(){
        parent::__construct();
        $this->salaDao =new SalaDao();
    }

     //Funcion para obtener todos los cines
    public function getAllCines(){
        $sentencia=$this->conexion->query("select * from  cines");
        $listaCines=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        $cinesDTO=array();
        for ($i=0; $i < count($listaCines); $i++) { 
            $fila=$listaCines[$i];
            $salas=$this->salaDao->getSalasByIdCine($fila['id']);
            $cine= new CineDTO($fila['id'],$fila['nombre'],$fila['direccion'],$fila['mail'],$fila['telefono'],$salas);
            array_push($cinesDTO,$cine);
        }
       return $cinesDTO;
    }

    //Funcion para obtener los datos de un cine por id
    public function getCineById($id){
        $sentencia=$this->conexion->prepare("select * from  cines where id=:id");
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();
        $salas=$this->salaDao->getSalasByIdCine( $id);

        $detalleCine=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        $cine=null;
        for ($i=0; $i < count($detalleCine); $i++) { 
            $fila=$detalleCine[$i];
            $cine= new CineDTO($fila['id'],$fila['nombre'],$fila['direccion'],$fila['mail'],$fila['telefono'],$salas);
        }
        return $cine;
    }

    //Funcion para añadir un nuevo cine con salas
    public function addCine($enitytCine){
        try{
            $this->conexion->beginTransaction();
            $sentencia=$this->conexion->prepare("insert into cines (nombre,direccion,mail,telefono) 
                                                values (:nombre,:direccion,:mail,:telefono)");
            $valorParametro=$enitytCine->getNombre();
            $sentencia->bindValue(':nombre', $enitytCine->getNombre());                                    
            $valorParametro1=$enitytCine->getDireccion();
            $sentencia->bindValue(':direccion', $enitytCine->getDireccion());
            $valorParametro2=$enitytCine->getMail();
            $sentencia->bindValue(':mail', $enitytCine->getMail());
            $valorParametro3=$enitytCine->getTelefono();
            $sentencia->bindValue(':telefono', $enitytCine->getTelefono());
            $sentencia->execute();
            $idCine= $this->conexion->lastInsertId();

            $salas= $enitytCine->getSalas();
        
            if(null!= $salas){
                for ($a=0; $a<=sizeof($salas)-1;$a++){
                    $salas[$a]->setIdCine($idCine);
                    $retornoSala=$this->salaDao-> addSala($salas[$a]);
                }
            }
            $this->conexion->commit();
            return $idCine;
        }catch (Exception $e){
             $this->conexion->rollBack();
        }
        return false;
    }
    
    //Funcion para actualizar los datos del cine y/o sala
    public function updateCine($enitytCine){
        $actualizado=0;
        $salaActualizado=false;
        $retorno=false;
        $setValues=$this->setValuesUpdate($enitytCine);
       
        if($setValues!=''){
            $sentencia=$this->conexion->prepare("update cines set ".$setValues. " where id=:id");

            //$id = $enitytCine->getId();
            $sentencia->bindValue(':id', $enitytCine->getId());

            if (null!=$enitytCine->getNombre()){                
                $sentencia->bindValue(':nombre', $enitytCine->getNombre());
                $setcomma=',';
            }
            
            if (null!=$enitytCine->getDireccion()){
                $setValues=$setValues.$setcomma;
                $sentencia->bindValue(':direccion', $enitytCine->getDireccion());
                $setcomma=',';
            }
            
            if (null!=$enitytCine->getMail()){
                $setValues=$setValues.$setcomma;
                $sentencia->bindValue(':mail', $enitytCine->getMail());
                $setcomma=',';
            }
        
            if (null!=$enitytCine->getTelefono()){
                $setValues=$setValues.$setcomma;
                $sentencia->bindValue(':telefono', $enitytCine->getTelefono());
            }

            $sentencia->execute();
            $actualizado=$sentencia->rowCount();
        }

        $salas= $enitytCine->getSalas();
       //Si hay salas para actualizar 
        if(null!= $salas){
            $numeroSalas=sizeof($salas);
            $salasActualizadas=0;
            for ($a=0; $a<=$numeroSalas-1;$a++){
                $existeSala=$this->salaDao->getSalasByIdCineAndIdSala($enitytCine->getId(), $salas[$a]->getIdSala());
                if(null!=$existeSala){
                    $retornoSala=$this->salaDao->updateSala($salas[$a]);
                    if($retornoSala){
                        $salasActualizadas =$salasActualizadas +1;
                    }
                    if($salasActualizadas==$numeroSalas){
                        $salaActualizado=false;
                    }
                }
            }
        }

        if ($actualizado >= 1 || $salaActualizado){
            $retorno=true;
        } else {
            $retorno=false;
        }

       return $retorno; 
    }

    //Funcion para crear la update dinamica segun los valores informados
    private function setValuesUpdate($enitytCine){
        $setValues='';
        $setcomma='';
        if (null!=$enitytCine->getNombre()){
            $setValues=$setValues.' nombre=:nombre';
            $setcomma=',';
        }
        
        if (null!=$enitytCine->getDireccion()){
            $setValues=$setValues.$setcomma;
            $setValues=$setValues.' direccion=:direccion';
            $setcomma=',';
        }
        
        if (null!=$enitytCine->getMail()){
            $setValues=$setValues.$setcomma;
            $setValues=$setValues.' mail=:mail';
            $setcomma=',';
        }
       
        if (null!=$enitytCine->getTelefono()){
            $setValues=$setValues.$setcomma;
            $setValues=$setValues.' telefono=:telefono';
        }
        return $setValues;
    }

    //Metodo para eliminar un cine
    public function deleteCine($id){
        try{
            $this->conexion->beginTransaction();
            $sentencia=$this->conexion->prepare("delete from cines where id=:id");
            $sentencia->bindValue(':id', $id);
            $sentencia->execute();
            $retorno=$sentencia->rowCount();
            $this->conexion->commit();
        }catch (Exception $e){
            $this->conexion->rollBack();
        }
        
        if ($retorno >= 1){
            return true;
        }else{
            return false;
        }
    }

}

?>