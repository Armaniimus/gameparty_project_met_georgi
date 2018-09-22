<?php

    /**
     *
     */
    class AuthenticationModel
    {
        private $password;
        private $gebruikersNaam;

        private $DateHandler;
        private $SessionModel;
        function __construct($dbName, $username, $pass, $serverAdress, $dbType) {
            $this->DataHandler = new DataHandler($dbName, $username, $pass, $serverAdress, $dbType);
            $this->SessionModel = new SessionModel($this->DataHandler);
        }


        private function GetData() {
            if (!isset($_POST['password']) ) {
                $_POST['password'] = "";
            }
            $this->password = $_POST['password'];

            if (!isset($_POST['username']) ) {
                $_POST['username'] = "";
            }
            $this->gebruikerNaam = $_POST['username'];
        }

        private function getPasswordHash() {
            $gebruikersNaam = $this->gebruikerNaam;

            $sql = "SELECT * FROM gebruikers WHERE gebruikersnaam = '$gebruikersNaam'";
            $gebruikerData = $this->DataHandler->readSingleData($sql);
            if ($gebruikerData) {
                $this->passwordHash = $gebruikerData['passwordHash'];
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
            $loginInfo = $this->SessionModel->Login($this->gebruikerNaam, $this->password, $this->passwordHash);
            return $loginInfo[0];
        }
    }
 ?>
