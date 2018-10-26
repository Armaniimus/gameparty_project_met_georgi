<?php
// router
require_once 'Router/Router-v2.2.php';
require_once 'config.php';

// controllers (are dynamicly called)

// genericModels
require_once "Model/traits/ValidatePHP_ID-v2.0.php";
require_once 'Model/DataHandler-v4.0.php';
require_once 'Model/DataValidator-v4.0.php';
require_once 'Model/FileHandler-v2.0.php';
require_once 'Model/HtmlElements-v2.0.php';
require_once 'Model/PhpUtilities-v3.0.php';
require_once 'Model/SessionModel-v2.0.php';
require_once 'Model/TemplatingSystem-v2.0.php';

// customModels
require_once 'Model/SessionContextModel.php';
require_once 'Model/ModelRedacteur.php';
require_once 'Model/ModelCatalogus.php';

// Authentication
$Authentication = new SessionContextModel(DB_NAME, DB_USERNAME, DB_PASS, DB_SERVER_ADRESS, DB_TYPE);
$Authentication->sessionSupport();
if (isset($_POST["logout"])) {
    $Authentication->logout();
}


// Router and return
$Router = new Router(BESTAND_DIEPTE);
$echo = $Router->run();

if ($Router->error) {
    require_once "Controller/Controller_catalogus.php";
    // $Controller = new Controller_catalogus("home");
    // $echo = $Controller->runController();

    $Controller = new Controller_catalogus();
    $echo = $Controller->home();
}

echo $echo;
// echo $Router->errorMessage;
// print_r($Router->getFilterPackets());
// print_r($_SESSION);
?>
