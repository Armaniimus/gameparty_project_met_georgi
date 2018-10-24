<?php
/**
 * routs the url to the correct controller
 */
class Router {

    // initialize vars
    Private $rootUrlStart;
    Private $packets;
    Public $filteredPackets;
    Public $error;
    Public $errorMessage;


    function __construct($rootUrlStart = 0) {

        // set urlOffset
        $this->rootUrlStart = $rootUrlStart;

        // getPayload
        $url = $_SERVER['REQUEST_URI'];
        $this->packets = explode("/", $url);

        $this->filteredPackets = $this->getFilterPackets();

        // Set error messages
        $this->error = NULL;
        $this->errorMessage = NULL;
    }


    public function run() {
        $result = $this->determineDestination();

        if ($result == "E1") {
            $this->error = "E1";
            $this->errorMessage = "Controller file isn't found";
            return FALSE;

        } else if ($result == "E2") {
            $this->error = "E2";
            $this->errorMessage = "no Method Defined";
            return FALSE;

        } else {
            return $result;
        }
    }

    public function getFilterPackets() {
        return array_slice($this->packets, $this->rootUrlStart);
    }

    private function determineDestination() {
        $filteredPackets = $this->filteredPackets;

        // set up the name and path
        $ctrlName = array_shift($filteredPackets);
        $name = "Controller_$ctrlName";
        $path = "Controller/$name.php";

        // check if destination exists
        if (file_exists ($path) ) {
            require_once $path;
            return $this->sendToDestination($filteredPackets, $path, $name);

        } else {
            return "E1";
        }
    }

    public function sendToDestination($packets, $path, $name) {
        // split the packets into params and methods
        $method = array_shift($packets);
        $params = $packets;

    /**
     * this method is used to send the request to a the controller given in the parameter
     * and send the given info to it
     *
     * @param  string $ctrlName  a controllerName
     * @param  string $method    a methodName
     * @param  array  $params    a array with params inside it
     * @return string            a return to be given back to index.php
     */
        //setup the params and run the controller
        if (isset($method) && $method) {
            if (isset($params[0]) && $params[0]) {
                $controller = new $name($method, $params);
            } else {
                $controller = new $name($method);
            }
        } else {
            return "E2";
        }

        return $controller->runController();
    }
}
?>
