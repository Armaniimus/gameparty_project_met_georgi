<?php
// router
require_once 'Router/Router-v1.php';
require_once 'config.php';

// controllers (are dynamicly called)

// genericModels
require_once "Model/traits/ValidatePHP_ID.php";
require_once 'Model/DataHandler-v3.2.php';
require_once 'Model/DataValidator-v3.2.php';
require_once 'Model/FileHandler-v1.php';
require_once 'Model/HtmlElements-v1.1.php';
require_once 'Model/PhpUtilities-v2.php';
require_once 'Model/SecurityHeaders-v1.php';
require_once 'Model/SessionModel.php';
require_once 'Model/TemplatingSystem-v1.php';

// customModels
require_once 'Model/SessionContextModel.php';
require_once 'Model/ModelRedacteur.php';
require_once 'Model/ModelCatalogus.php';

// Authentication
$Authentication = new SessionContextModel(DB_NAME, DB_USERNAME, DB_PASS, DB_SERVER_ADRESS, DB_TYPE);
$Authentication->SessionSupport();
if (isset($_POST["logout"])) {
    $Authentication->logout();
}


// Router and return
$Router = new Router(BESTAND_DIEPTE);
$echo = $Router->run();

// if ($Router->error) {
//     require_once "Controller/Controller_catalogus.php ";
//     $Controller = new Controller_catalogus("home");
//     $echo = $Controller->runController();
// }

echo $echo;
// print_r($_SESSION);
?>
