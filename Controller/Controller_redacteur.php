<?php
    /**
     *
     */
    class Controller_redacteur
    {
        private $AuthenticationModel;
        private $ModelRedacteur;
        private $method;
        private $params;

        function __construct($method, $params = FALSE) {
            $this->AuthenticationModel = new AuthenticationModel(DB_NAME, DB_USERNAME, DB_PASS, DB_SERVER_ADRESS, DB_TYPE);
            $this->ModelRedacteur = new ModelRedacteur(DB_NAME, DB_USERNAME, DB_PASS, DB_SERVER_ADRESS, DB_TYPE);


            $this->method = $method;
            if ($params != FALSE) {
                $this->params = $params;
            }
        }

        public function runController() {
            switch ($this->method) {
                case 'inhoud_toe':
                    return $this->inhoud_toe();
                    break;

                case 'inhoud_aan':
                    return $this->inhoud_aan();
                    break;

                case 'inhoud_del':
                    // if (isset($this->params[0]) ) {
                    //     $id = $this->params[0];
                    //     return $this->delete($id);
                    // } else {
                    return $this->inhoud_del();
                    // }
                    break;

                case 'bios_toe':
                    // if (isset($this->params[0]) ) {
                    //     $id = $this->params[0];
                    //     return $this->delete($id);
                    // } else {
                    return $this->bios_toe();
                    // }
                    break;

                case 'login':
                    return $this->login();
                    break;

                default:
                    return $this->overzicht();
                    break;
            }
        }

        public function inhoud_toe() {
            if ($this->ModelRedacteur->loggedInBool == 1) {
                $this->TemplatingSystem = new TemplatingSystem("view/default.tpl");
                $main = file_get_contents("view/partials/bios_toevoegen.html");

                $this->TemplatingSystem->setTemplateData("main", $main);
                $this->TemplatingSystem->setTemplateData("page", '../../redacteur/bios_toe');
                return $this->TemplatingSystem->GetParsedTemplate();

            } else {
                echo "uitgelogd<br>";

            }
            return $this->ModelRedacteur->inhoud_toe();
        }

        public function inhoud_aan() {
            return $this->ModelRedacteur->inhoud_aan();
        }

        public function inhoud_del() {
            return $this->ModelRedacteur->inhoud_del();
        }

        public function bios_toe() {
            if ($this->ModelRedacteur->loggedInBool == 1) {
                $this->TemplatingSystem = new TemplatingSystem("view/default.tpl");
                $main = file_get_contents("view/partials/bios_toevoegen.html");

                $this->TemplatingSystem->setTemplateData("main", $main);
                $this->TemplatingSystem->setTemplateData("page", '../../redacteur/bios_toe');
                return $this->TemplatingSystem->GetParsedTemplate();
            } else {
                echo "uitgelogd<br>";
            }

            return $this->ModelRedacteur->bios_toe();
        }

        public function overzicht() {

            // check login Info
            if ($this->ModelRedacteur->loggedInBool == 1) {
                $this->TemplatingSystem = new TemplatingSystem("view/default.tpl");

                $main = file_get_contents("view/partials/redacteur_overzicht.html");
                $this->TemplatingSystem->setTemplateData("main", $main);

                $return = $this->TemplatingSystem->GetParsedTemplate();

            // moet naar de catalogus
            } else {
                echo "permission denied";
                $return = '';
            }

            return $return;
        }

        public function login() {
            $redacteurArray = $this->AuthenticationModel->login();
            $gebruikersNaam = $redacteurArray[0];
            $loginInfo = $redacteurArray[1];
            $loginInfo = '<br>$loginInfo = ' . $loginInfo;

            //control view
            $this->TemplatingSystem = new TemplatingSystem("view/default.tpl");

            $main = file_get_contents("view/partials/basicLoginForm.html");
            $this->TemplatingSystem->setTemplateData("main", $main);
            $this->TemplatingSystem->setTemplateData("page", '../../redacteur/login');
            $this->TemplatingSystem->setTemplateData("gebruiker", $gebruikersNaam);
            $this->TemplatingSystem->setTemplateData("info", $loginInfo);

            $return = $this->TemplatingSystem->GetParsedTemplate();

            return $return;
        }
    }
?>
