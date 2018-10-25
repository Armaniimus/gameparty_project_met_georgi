<?php

    /**
     *
     */
    class SessionContextModel
    {

        private $permissions = NULL;
        private $gebruikersNaam = NULL;
        private $gebruikersRol = NULL;
        private $passwordHash = NULL;
        private $password = NULL;

        private $DataHandler;
        private $SessionModel;
        function __construct($dbName, $username, $pass, $serverAdress, $dbType) {
            $this->DataHandler = new DataHandler($dbName, $username, $pass, $serverAdress, $dbType);
            $this->SessionModel = new SessionModel();
        }

        /**
         * Deze methode calt een methode voor het creëren van de session
         * daarnaast zorgt hij dat de 4 basis waarden aanwezig zijn
         * ook calt hij een methode die de login afhandeling verzorgt
         * algeheel is hij verantwoordelijk voor het grootste deel flowlogic in deze class
         */
        public function sessionSupport() {
            $this->SessionModel->sessionSupport();

            if (!isset($_SESSION["gebruikersNaam"]) ) {
                $_SESSION["gebruikersNaam"] = NULL;
            }

            if (!isset($_SESSION["gebruikersRol"]) ) {
                $_SESSION["gebruikersRol"] = NULL;
            }

            if (!isset($_SESSION["loginBool"]) ) {
                $_SESSION["loginBool"] = NULL;
            }

            if (!isset($_SESSION["permissions"]) ) {
                $_SESSION["permissions"] = NULL;
            }

            $this->login();
        }

        /**
         * deze methode spreekt een methode aan die de post data ophaalt
         * als er post data verstuurd is haalt hij van de database de gerelateerde informatie op
         * daarna stuurd hij deze door naar een methode die dit in de session zet
         */
        public function login() {
            $this->getPostData();

            // check if there is post data related to login
            if (isset($_POST['password']) && isset($_POST['username'])) {
                // check if its possible to use the post data to get databack
                $this->getDatabaseData();
            }

            $loginInfo = $this->SessionModel->Login($this->gebruikersNaam, $this->password, $this->passwordHash);
            if ($loginInfo[0] === 2) {
                $this->setSessionData();
            }

            // echo "<br>";
            // echo $this->SessionModel->HashPassword($this->password);
            // echo "<br>";
        }

        /**
         * deze methode calt een methode die de loguit verzorgt
         */
        public function logout() {
            $this->SessionModel->logout();
        }

        /**
         * deze methode is zet de $_POST Data in de class parameters
         */
        private function getPostData() {
            if (!isset($_POST['password']) ) {
                $_POST['password'] = "";
            }
            $this->password = $_POST['password'];

            if (!isset($_POST['username']) ) {
                $_POST['username'] = "";
            }
            $this->gebruikersNaam = $_POST['username'];
        }

        /**
         * deze methode haalt data op vanuit de database op basis van de gebruikersnaam in de class
         * hierna zet hij de opgehaalde data in de class properties
         */
        private function getDatabaseData() {
            $gebruikersNaam = $this->gebruikersNaam;

            $sql = "SELECT `gebruikersNaam`, `passwordHash`, `rolType`, `perm_bios_toevoegen`, `perm_bios_wijzigen`, `perm_bios_verwijderen`, `perm_content_toevoegen`, `perm_content_wijzigen`, `perm_content_verwijderen`
            FROM gebruikers
            INNER JOIN gebruikers_rollen ON gebruikers.gebruikers_rollen_id = gebruikers_rollen.id
            WHERE gebruikersNaam = '$gebruikersNaam'";

            $data = $this->DataHandler->readSingleData($sql);

            if ($data) {
                $this->permissions = [];
                foreach ($data as $key => $value) {
                    switch ($key) {
                        case 'gebruikersNaam':
                            break;
                        case 'passwordHash':
                            $this->passwordHash = $value;
                            break;
                        case 'rolType':
                            $this->gebruikersRol = $value;
                            break;
                        default:
                            array_push($this->permissions, [$key => $value]);
                            break;
                    }
                }
            }
        }

        /**
         * deze methode zet de data uit de class in de session
         */
        private function setSessionData() {
            $_SESSION["loginBool"] = 1;
            $_SESSION["gebruikersNaam"] = $this->gebruikersNaam;
            $_SESSION["gebruikersRol"] = $this->gebruikersRol;
            $_SESSION["permissions"] = $this->permissions;
        }
    }
 ?>
