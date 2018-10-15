<?php

class Controller_content {
	private $method;
	private $params;
	private $connection;
	private $templatingSystem;
	private $contentId;
	private $contentText;


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
            case 'overons':
                return $this->overons();
                break;

								case 'sendData':
		                return $this->sendData();
		                break;


            default:
                return header("Location: ".APP_DIR." ");
                break;
        }
    }

private function overons()
{

$contentEdit = $this->connection->QueryRead("SELECT content_inhoud FROM content WHERE id='overons' ");
$main = file_get_contents("view/partials/content.html");
$result = implode($contentEdit[0]);

$this->TemplatingSystem->setTemplateData("main-content", $main);
$this->TemplatingSystem->setTemplateData("page-title", "over ons");
$this->TemplatingSystem->setTemplateData("content-edit", $result);
$this->TemplatingSystem->setTemplateData("content-id", "overons");
$this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
$return = $this->TemplatingSystem->GetParsedTemplate();

return $return;
}

private function sendData()
{
	if (isset($_POST["contentId"])) {
		$this->contentId = $_POST["contentId"];
	}else{
		header("Location: ".APP_DIR." ");
	}
	if (isset($_POST["contentText"]) ) {
		$this->contentText = $_POST["contentText"];
	}else{
		header("Location: ".APP_DIR." ");
	}

	$qry= "UPDATE `content` SET `content_inhoud`='$this->contentText' WHERE `content`.`id`='$this->contentId' ";

$contentSend = $this->connection->UpdateData($qry);

header("Location: ".APP_DIR." ");

}


}

 ?>
