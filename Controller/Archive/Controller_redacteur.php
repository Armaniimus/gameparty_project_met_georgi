<?php
    /**
     *
     */
    class Controller_redacteur
    {
        private $templatingSystem;
        private $method;
        private $params;

        function __construct($method, $params = FALSE) {
            $this->method = $method;
            if ($params != FALSE) {
                $this->params = $params;
            }
            $this->TemplatingSystem = new TemplatingSystem("view/default.tpl");
    		$this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
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
                    case 'logout':
                        return $this->logout();
                        break;

                default:
                    return $this->login();
                    break;
            }
        }

        public function inhoud_toe() {
            if ($_SESSION["loginBool"] === 1) {
                $main = file_get_contents("view/partials/bios_toevoegen.html");

                $this->TemplatingSystem->setTemplateData("main-content", $main);
                $this->TemplatingSystem->setTemplateData("page", APP_DIR . 'redacteur/bios_toe');
                $this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
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
            if ($_SESSION["loginBool"] === 1) {
                $main = file_get_contents("view/partials/bios_toevoegen.html");

                $this->TemplatingSystem->setTemplateData("main-content", $main);
                $this->TemplatingSystem->setTemplateData("page",  APP_DIR . '/redacteur/bios_toe');
                $this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
                return $this->TemplatingSystem->GetParsedTemplate();
            } else {
                echo "uitgelogd<br>";
            }

            return $this->ModelRedacteur->bios_toe();
        }

        public function overzicht() {

            // check login Info
            if ($_SESSION["loginBool"] === 1) {
                $main = file_get_contents("view/partials/redacteur_overzicht.html");
                $this->TemplatingSystem->setTemplateData("main-content", $main);
                $this->TemplatingSystem->setTemplateData("appdir", APP_DIR);

                $return = $this->TemplatingSystem->GetParsedTemplate();

            // moet naar de catalogus
            } else {
                echo "permission denied";
                $return = '';
            }

            return $return;
        }

        public function login() {
            $loginMsg="";
            $loginBool = $_SESSION["loginBool"];

            $gebruikersNaam = $_SESSION["gebruikersNaam"];
            if (!$gebruikersNaam) {
                if (isset($_POST["username"]) ) {
                    $gebruikersNaam = $_POST["username"];
                }
            }

            $loginInfo = $_SESSION["loginBool"];
            $loginInfo = '<br>$loginInfo = ' . $loginInfo;

            if ($loginBool == 1) {
                $loginMsg = "<h4>U bent ingelogd als rol: ".$_SESSION["gebruikersRol"]."</h4> ";

            } else if($loginBool == 0) {
                $loginMsg = "U bent nu niet ingelogd";
            }
            //control view

            $main = file_get_contents("view/partials/basicLoginForm.html");
            if ($loginBool == 1) {
                $main = file_get_contents("view/partials/loguitPagina.html");
                $this->TemplatingSystem->setTemplateData("main-content", $main);
                $this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
                $this->TemplatingSystem->setTemplateData("loginText", $loginMsg);
            } else {
                $this->TemplatingSystem->setTemplateData("main-content", $main);
            }

            $loginButtonText = "Login";
            if ($loginBool == 1) {
            	$loginButtonText = "Loguit";
            }

            $this->TemplatingSystem->setTemplateData("loginButtonText", $loginButtonText);
            $this->TemplatingSystem->setTemplateData("page", APP_DIR . '/redacteur/login');
            $this->TemplatingSystem->setTemplateData("gebruiker", $gebruikersNaam);
            $this->TemplatingSystem->setTemplateData("info", $loginInfo);
            $this->TemplatingSystem->setTemplateData("loginText", $loginMsg);

            $return = $this->TemplatingSystem->GetParsedTemplate();

            return $return;
        }
        private function logout() {
            session_destroy();
            header("Location: ".APP_DIR."/redacteur/login ");
        }
    }
?>
