<?php

    /**
     *
     */
    class AuthenticationModel
    {
        private $password;
        private $gebruikersNaam;

        private $DataHandler;
        private $SessionModel;
        function __construct($dbName, $username, $pass, $serverAdress, $dbType) {
            $this->DataHandler = new DataHandler($dbName, $username, $pass, $serverAdress, $dbType);
            $this->SessionModel = new SessionModel();
        }

        public function SessionSupport() {
            $this->SessionModel->SessionSupport();
            $this->login();

            if (!isset($_SESSION["gebruikersNaam"]) ) {
                $_SESSION["gebruikersNaam"] = NULL;
            }

            if (!isset($_SESSION["loginBool"]) ) {
                $_SESSION["gebruikerRol"] = NULL;
            }

            if (!isset($_SESSION["loginBool"]) ) {
                $_SESSION["loginBool"] = NULL;
            }
        }

        private function getData() {
            if (!isset($_POST['password']) ) {
                $_POST['password'] = "";
            }
            $this->password = $_POST['password'];

            if (!isset($_POST['username']) ) {
                $_POST['username'] = "";
            }
            $this->gebruikersNaam = $_POST['username'];
        }

        private function getPasswordHash() {
            $gebruikersNaam = $this->gebruikersNaam;

            $sql = "SELECT * FROM gebruikers WHERE gebruikersnaam = '$gebruikersNaam'";
            $gebruikersData = $this->DataHandler->readSingleData($sql);
            if ($gebruikersData) {
                $this->passwordHash = $gebruikersData['passwordHash'];
            } else {
                $this->passwordHash = "";
            }
        }

        public function login() {
            $this->getData();
            $this->getPasswordHash();

            // echo "<br>";
            // echo $this->SessionModel->HashPassword($this->password);
            // echo "<br>";
            $loginInfo = $this->SessionModel->Login($this->gebruikersNaam, $this->password, $this->passwordHash);

            return [$this->gebruikersNaam, $loginInfo[0]];
        }
    }
 ?>
