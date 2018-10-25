<?php
/**
 *
 */
class Controller_login {
    private $templatingSystem;
    private $method;
    private $params;
    private $SessionModel;

    function __construct($method = FALSE, $params = FALSE) {
        $this->SessionModel = new SessionModel;
        // $this->method = $method;
        // if ($params != FALSE) {
        //     $this->params = $params;
        // }
        $this->TemplatingSystem = new TemplatingSystem("view/default.tpl");
        $this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
    }

    // public function runController() {
    //     switch ($this->method) {
    //         case 'login':
    //             return $this->login();
    //             break;
    //         case 'logout':
    //             return $this->logout();
    //             break;
    //
    //         default:
    //             return $this->login();
    //             break;
    //     }
    // }

    public function default() {
        return $this->login();
    }

    /**
     * this method constructs a webform for the login
     * @return string the constructed webpage
     */
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

        if($loginBool == 1){
            $loginMsg = "<h4>Welkom: ".$_SESSION["gebruikersRol"]."</h4> ";

        } else if($loginBool == 0){
            $loginMsg = "U bent nu niet ingelogd";
        }
        //control view

        $main = file_get_contents("view/partials/basicLoginForm.html");
        if ($loginBool == 1) {
            $main = file_get_contents("view/partials/admin.html");
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
        $this->TemplatingSystem->setTemplateData("page", APP_DIR . '/login/login');
        $this->TemplatingSystem->setTemplateData("gebruiker", $gebruikersNaam);
        $this->TemplatingSystem->setTemplateData("info", $loginInfo);
        $this->TemplatingSystem->setTemplateData("loginText", $loginMsg);

        $return = $this->TemplatingSystem->getParsedTemplate();

        return $return;
    }

    /**
     * this method calls the sessionModel to handle the logout
     */
    public function logout() {
        $this->SessionModel->logout();
        header("Location: ".APP_DIR."/login/login ");
    }
}
?>
