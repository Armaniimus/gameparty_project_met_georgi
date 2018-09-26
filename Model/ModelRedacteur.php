<?php
    /**
     *
     */
    class ModelRedacteur {
        private $DateHandler;
        private $DataValidator;
        private $SessionModel;
        private $Authentication;
        public $loggedInBool;

        public function __construct($dbName, $username, $pass, $serverAdress, $dbType) {
            $this->DataHandler = new DataHandler($dbName, $username, $pass, $serverAdress, $dbType);
            $this->AuthenticationModel = new AuthenticationModel($dbName, $username, $pass, $serverAdress, $dbType);
            $this->DataValidator = new DataValidator();
            $this->SessionModel = new SessionModel($this->DataHandler);


            // starts or continues the session
            $this->SessionModel->SessionSupport();

            $login = $this->SessionModel->Login();
            $this->loggedInBool = $login[0];
        }


        public function inhoud_toe() {
            return "The method inhoud toevoegen is called";
        }

        public function inhoud_aan() {
            return "The method inhoud aanpassen is called";
        }

        public function inhoud_del() {
            return "The method inhoud deleten is called";
        }

        public function bios_toe() {
            return "The method bioscoop toevoegen is called";
        }

        public function overzicht() {
            // return $this->loggedInBool;
        }
    }
