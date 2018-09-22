<?php
    /**
     *
     */
    class ModelRedacteur {
        private $DateHandler;
        private $DataValidator;
        private $SessionModel;

        public function __construct() {
            $this->DataHandler = new DataHandler("Gameplayparties", "root", "", "localhost", "mysql");
            $this->DataValidator = new DataValidator();
            $this->SessionModel = new SessionModel();

            // starts or continues the session
            $this->SessionModel->SessionSupport();
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
            return "The method overzicht is called";
        }
    }
