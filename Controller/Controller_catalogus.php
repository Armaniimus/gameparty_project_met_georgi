<?php

class Controller_catalogus {
	private $method;
	private $params;
	private $connection;

	function __construct($method, $params = FALSE) {
		$this->connection = new dbhandler(DB_NAME, DB_USERNAME, DB_PASS);

		$this->method = $method;
		if ($params != FALSE) {
			$this->params = $params;
		}
	}

	public function runController() {
        switch ($this->method) {
            case 'contact':
                return $this->contact();
                break;
			case 'home':
				echo 'homepage';
				break;

            default:
                return $this->catalogus();
                break;
        }
    }

	public function catalogus(){
		$sample = $this->connection->QueryRead("SELECT * FROM bioscopen");
	}

	public function contact() {
		//control view
		$this->TemplatingSystem = new TemplatingSystem("view/default.tpl");

		$main = file_get_contents("view/partials/contact_form.html");
		$this->TemplatingSystem->setTemplateData("main", $main);
		$this->TemplatingSystem->setTemplateData("page", '../../catalogus/contact');

		$return = $this->TemplatingSystem->GetParsedTemplate();

		return $return;
	}
}



 ?>
