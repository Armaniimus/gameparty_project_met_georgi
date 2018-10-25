<?php

class Controller_content {
	private $method;
	private $params;
	private $connection;
	private $templatingSystem;
	private $contentId;
	private $contentText;


	function __construct($method = FALSE, $params = FALSE) {
		$this->connection = new dbhandler(DB_NAME, DB_USERNAME, DB_PASS);

		// $this->method = $method;
		// if ($params != FALSE) {
		// 	$this->params = $params;
		// }

		$loginBool = $_SESSION["loginBool"];
		$this->TemplatingSystem = new TemplatingSystem("view/default.tpl");
		$this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
		$loginButtonText = "Login";
		if ($loginBool == 1) {
				$loginButtonText = "Loguit";
		}

		$this->TemplatingSystem->setTemplateData("loginButtonText", $loginButtonText);
	}

	// public function runController() {
    //     switch ($this->method) {
    //         case 'overons':
    //             return $this->overons();
    //             break;
	//
	// 		case 'sendData':
    //             return $this->sendData();
    //             break;
	//
    //         default:
    //             return header("Location: ".APP_DIR." ");
    //             break;
    //     }
    // }

	public function default() {
		return header("Location: ".APP_DIR." ");
	}

	private function overons() {
		$selectQuery = "SELECT tab_titel,pagina_titel,content_naam,content,pagina_beschrijving,steekwoorden FROM content WHERE contentID='1' ";

		$main = file_get_contents("view/partials/content.html");
		$content = $this->connection->QueryRead($selectQuery);

		$tab_titel = $content[0]["tab_titel"];
		$pagina_titel = $content[0]["pagina_titel"];
		$content_naam = $content[0]["content_naam"];
		$content0 = $content[0]["content"];
		$pagina_beschrijving = $content[0]["pagina_beschrijving"];
		$steekwoorden = $content[0]["steekwoorden"];

		$this->TemplatingSystem->setTemplateData("main-content", $main);
		$this->TemplatingSystem->setTemplateData("page-title", "over ons");

		$this->TemplatingSystem->setTemplateData("tab_titel", $tab_titel);
		$this->TemplatingSystem->setTemplateData("pagina_titel", $pagina_titel);
		$this->TemplatingSystem->setTemplateData("content_naam", $content_naam);
		$this->TemplatingSystem->setTemplateData("content0", $content0);
		$this->TemplatingSystem->setTemplateData("pagina_beschrijving", $pagina_beschrijving);
		$this->TemplatingSystem->setTemplateData("steekwoorden", $steekwoorden);

		$this->TemplatingSystem->setTemplateData("content-id", "overons");
		$this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
		$return = $this->TemplatingSystem->GetParsedTemplate();

		return $return;
	}

	private function sendData() {
		if (isset($_POST["contentId"])) {
			$this->contentId = $_POST["contentId"];
		} else {
			header("Location: ".APP_DIR." ");
		}

		if (isset($_POST["tab_titel"])) {
			$this->tab_titel = $_POST["tab_titel"];
		} else {
			header("Location: ".APP_DIR." ");
		}

		if (isset($_POST["pagina_titel"])) {
			$this->pagina_titel = $_POST["pagina_titel"];
		} else{
			header("Location: ".APP_DIR." ");
		}

		if (isset($_POST["content_naam"])) {
			$this->content_naam = $_POST["content_naam"];
		} else {
			header("Location: ".APP_DIR." ");
		}

		if (isset($_POST["content0"])) {
			$this->content0 = $_POST["content0"];
		} else {
			header("Location: ".APP_DIR." ");
		}

		if (isset($_POST["pagina_beschrijving"])) {
			$this->pagina_beschrijving = $_POST["pagina_beschrijving"];
		} else {
			header("Location: ".APP_DIR." ");
		}

		if (isset($_POST["steekwoorden"])) {
			$this->steekwoorden = $_POST["steekwoorden"];
		} else {
			header("Location: ".APP_DIR." ");
		}

		$qry= "UPDATE `content` SET
		`tab_titel`='$this->tab_titel',
		`pagina_titel`='$this->pagina_titel',
		`content_naam`='$this->content_naam',
		`content`='$this->content0',
		`pagina_beschrijving`='$this->pagina_beschrijving',
		`steekwoorden`='$this->steekwoorden' WHERE `contentID`='1' ";

		$contentSend = $this->connection->UpdateData($qry);
		var_dump($contentSend);
		header("Location: ".APP_DIR." ");
	}
}

 ?>
