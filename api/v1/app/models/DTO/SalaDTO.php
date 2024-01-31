<?php
   require_once ("Dto.php");
    class SalaDTO extends Dto {
      //  protected $idCine;
        protected $idSala;
        protected $pelicula;
        protected $aforo;
        protected $es3d;

        public function __construct($idSala,$pelicula,$aforo,$es3d){
            //$this->idCine=$idCine;
            $this->idSala=$idSala;
            $this->pelicula=$pelicula;
            $this->aforo=$aforo;
            $this->es3d=$es3d;
        }

        /**
         * Get the value of idSala
         */
        public function getIdSala()
        {
                return $this->idSala;
        }

        /**
         * Set the value of idSala
         */
        public function setIdSala($idSala): self
        {
                $this->idSala = $idSala;

                return $this;
        }

        /**
         * Get the value of idCine
         */
       /* public function getIdCine()
        {
                return $this->idCine;
        }*/

        /**
         * Set the value of idCine
         */
       /* public function setIdCine($idCine): self
        {
                $this->idCine = $idCine;

                return $this;
        }*/

        /**
         * Get the value of pelicula
         */
        public function getPelicula()
        {
                return $this->pelicula;
        }

        /**
         * Set the value of pelicula
         */
        public function setPelicula($pelicula): self
        {
                $this->pelicula = $pelicula;

                return $this;
        }

        /**
         * Get the value of aforo
         */
        public function getAforo()
        {
                return $this->aforo;
        }

        /**
         * Set the value of aforo
         */
        public function setAforo($aforo): self
        {
                $this->aforo = $aforo;

                return $this;
        }

        /**
         * Get the value of es3d
         */
        public function getEs3d()
        {
                return $this->es3d;
        }

        /**
         * Set the value of es3d
         */
        public function setEs3d($es3d): self
        {
                $this->es3d = $es3d;

                return $this;
        }
    }
?>
