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



            // temp testing data
            if ($loginInfo[0]) {
                echo "You are Logged in";
            } else {
                echo "You are Logged off";
            }
            $this->SessionModel->Logout();

            return [$this->gebruikersNaam, $loginInfo[0]];
        }
    }
 ?>
