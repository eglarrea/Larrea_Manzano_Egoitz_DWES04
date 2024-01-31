<?php
interface Controller{

     /**
     * Funcion para obtener todos los datos.
     * @return Respuesta
     */
    public function getAllData();
    public function getDataByID($id);
    public function newData($datos);
    public function updateData($id,$datos);
    public function deleteData($datos);

}
?>