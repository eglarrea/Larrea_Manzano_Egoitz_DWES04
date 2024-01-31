<?php
// Rutas de core
require("../core/Router.php");
//Rutas model
//require_once("../app/models/Objeto.php");
//require("../app/models/Cine.php");
//require("../app/models/Sala.php");
require("../app/models/Respuesta.php");
require_once("../app/models/converts/cineConvert.php");
require("../app/models/Entity/CineEntity.php");
require("../app/models/Entity/SalaEntity.php");
require_once ("../app/models/DAO/Dao.php");
require_once("../app/models/DAO/CineDao.php");
require_once("../app/models/DAO/SalaDao.php");

//Rutas de vendor
require("../vendor/funcComunes.php");
require("../vendor/ErrorCodes.php");


//Rutas Controllers
require("../app/controllers/Controller.php");
require("../app/controllers/Home.php");
require("../app/controllers/CineController.php");
require("../app/controllers/CinesController.php");

?>