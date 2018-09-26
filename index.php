<?php
// router
require 'Router/Router-v1.php';
require 'config.php';

// controllers (are dynamicly called)

// genericModels
require_once "Model/traits\ValidatePHP_ID.php";
require_once 'Model/DataHandler-v3.2.php';
require_once 'Model/DataValidator-v3.2.php';
require_once 'Model/FileHandler-v1.php';
require_once 'Model/HtmlElements-v1.1.php';
require_once 'Model/PhpUtilities-v2.php';
require_once 'Model/SecurityHeaders-v1.php';
require_once 'Model/SessionModel.php';
require_once 'Model/TemplatingSystem-v1.php';

// customModels
require_once 'Model/AuthenticationModel.php';
require_once 'Model/ModelRedacteur.php';

$Router = new Router(BESTAND_DIEPTE);

echo $Router->run();
// echo $Router->error. "<br>";
echo $Router->errorMessage;
// var_dump($Router->filteredPackets);

?>
