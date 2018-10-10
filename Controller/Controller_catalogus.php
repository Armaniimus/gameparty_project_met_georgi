<?php

class Controller_catalogus {
	private $method;
	private $params;
	private $connection;
	private $templatingSystem;

	function __construct($method, $params = FALSE) {
		$this->connection = new dbhandler(DB_NAME, DB_USERNAME, DB_PASS);

		$this->method = $method;
		if ($params != FALSE) {
			$this->params = $params;
		}
		$this->TemplatingSystem = new TemplatingSystem("view/default.tpl");
		$this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
	}

	public function runController() {
        switch ($this->method) {
            case 'contact':
                return $this->contact();
                break;

			case 'home':
				return $this->home();
				break;

			case 'detail':
				# code...
				break;

            default:
                return $this->catalogus();
                break;
        }
    }

	public function catalogus(){
		$sample = $this->connection->QueryRead("SELECT * FROM bioscopen");

		require_once('View/catalogus.php');
	}

	public function contact() {
		//control view

		if (!empty($_POST['submit'])) {

			$naam = $_POST['naam'];
			$email = $_POST['email'];
			$telefoon = $_POST['telefoon'];
			$bericht = $_POST['bericht'];



			unset($_POST);
			

		}else{
			$main = file_get_contents("view/partials/contact_form.html");
			$this->TemplatingSystem->setTemplateData("main", $main);
			$this->TemplatingSystem->setTemplateData("page", APP_DIR . '/catalogus/contact');

			$return = $this->TemplatingSystem->GetParsedTemplate();
			return $return;
		}

		

	
	}

	public function home() {
		$main = file_get_contents("view/partials/homePage.html");
		$this->TemplatingSystem->setTemplateData("main", $main);

		$return = $this->TemplatingSystem->GetParsedTemplate();
		return $return;
	}
}

?>
