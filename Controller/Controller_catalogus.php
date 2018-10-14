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

            default:
                return $this->catalogus();
                break;
        }
    }

	public function catalogus(){
		$sample = $this->connection->QueryRead("SELECT * FROM bioscoop");
	}

	public function contact() {
		//control view

		$main = file_get_contents("view/partials/contact_form.html");
		$this->TemplatingSystem->setTemplateData("main", $main);
		$this->TemplatingSystem->setTemplateData("page", APP_DIR . '/catalogus/contact');

		$return = $this->TemplatingSystem->GetParsedTemplate();
		return $return;
	}

	public function home() {
		$main = file_get_contents("view/partials/homePage.html");
		$content = $this->connection->QueryRead("SELECT content_inhoud FROM content WHERE id='overons' ");
		$result = implode($content[0]);
		$this->TemplatingSystem->setTemplateData("main", $main);
		$this->TemplatingSystem->setTemplateData("content", $result);

		$return = $this->TemplatingSystem->GetParsedTemplate();
		return $return;
	}
}

?>
