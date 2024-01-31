<?php
    require_once ("Dto.php");
    class CineDTO extends Dto {
        protected $id;
        protected $nombre;
        protected $direccion;
        protected $mail;
        protected $telefono;
        protected $salas=array();

       // public function __construct($id,$nombre){
            public function __construct($id,$nombre,$direccion,$mail,$telefono,$salas){
            $this->id=$id;
            $this->nombre=$nombre;
            $this->direccion=$direccion;
            $this->mail=$mail;
            $this->telefono=$telefono;
            $this->salas=$salas;
        }

        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Get the value of nombre
         */
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Get the value of direccion
         */
        public function getDireccion()
        {
                return $this->direccion;
        }

        /**
         * Get the value of mail
         */
        public function getMail()
        {
                return $this->mail;
        }


        /**
         * Get the value of telefono
         */
        public function getTelefono()
        {
                return $this->telefono;
        }

        /**
         * Get the value of salas
         */
        public function getSalas()
        {
                return $this->salas;
        }
        
    }
?>
