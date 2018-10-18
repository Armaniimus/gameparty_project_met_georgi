<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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

			case 'bedankt':
				return $this->bedankt();
				break;

			case 'reserveer':
				return $this->reserveer();
				break;

            default:
                return $this->catalogus();
                break;
        }
    }

    public function reserveer(){
    	$id = $this->params[0];

    	$sql = "SELECT * FROM bioscopen WHERE bioscoopID = $id";

    	$result = $this->connection->QueryRead($sql);
    	
    	echo "<pre>";
    	print_r($result);
    	echo "<pre>";

    	echo $id;
    }

	public function catalogus(){
		$sample = $this->connection->QueryRead("SELECT * FROM bioscopen");



		require_once('View/catalogus.php');
	}

	public function contact() {







		if (!empty($_POST['submit'])) {

			$naam = $_POST['naam'];
			$email = $_POST['email'];
			$telefoon = $_POST['telefoon'];
			$bericht = $_POST['bericht'];
			$onderwerp = $_POST['onderwerp'];

				require_once "Model/vendor/phpmailer/phpmailer/src/phpmailer.php";
				require_once "Model/vendor/phpmailer/phpmailer/src/SMTP.php";
				require_once "Model/vendor/phpmailer/phpmailer/src/Exception.php";


				//mail to customer
				$mailcustomer = new PHPMailer(true);                              // Passing `true` enables exceptions
				try {
				 //Server settings
				    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
				    $mailcustomer->isSMTP();                                      // Set mailer to use SMTP
				    $mailcustomer->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				    $mailcustomer->SMTPAuth = true;                               // Enable SMTP authentication
				    $mailcustomer->Username = 'gameplaypartyNL@gmail.com';                 // SMTP username
				    $mailcustomer->Password = 'GamePlayPartyNL';                           // SMTP password
				    $mailcustomer->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				    $mailcustomer->Port = 587;                                    // TCP port to connect to

				    //Recipients
				    $mailcustomer->setFrom('gameplaypartyNL@gmail.com' , 'Contact form GamePlayPartyNL');
				    $mailcustomer->addAddress($email);     // Add a recipient
				    $mailcustomer->addReplyTo('gameplaypartyNL@gmail.com');


				    //Content
				    $mailcustomer->isHTML(true);                                  // Set email format to HTML
				    $mailcustomer->Subject = "Bericht ontvangen.";
				    $mailcustomer->Body    = "Uw bericht is ontvangen en word zo spoedig mogelijk verwerkt!";

				    $mailcustomer->send();


				} catch (Exception $e) {
				    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
				}




				//mail to customer care
				$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
				try {
				 //Server settings
				    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
				    $mail->isSMTP();                                      // Set mailer to use SMTP
				    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				    $mail->SMTPAuth = true;                               // Enable SMTP authentication
				    $mail->Username = 'gameplaypartyNL@gmail.com';                 // SMTP username
				    $mail->Password = 'GamePlayPartyNL';                           // SMTP password
				    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				    $mail->Port = 587;                                    // TCP port to connect to

				    //Recipients
				    $mail->setFrom($email , 'Contact form GamePlayPartyNL');
				    $mail->addAddress('gameplaypartyNL@gmail.com');     // Add a recipient
				    $mail->addReplyTo($email, 'Contact');


				    //Content
				    $mail->isHTML(true);                                  // Set email format to HTML
				    $mail->Subject = $onderwerp;
				    $mail->Body    =

						"Naam: ".$naam."<br>"."Email: ".$email."<br>"."Telefoonnummer: ".$telefoon."<br><br>"."Onderwerp: ".$onderwerp."<br><br>".$bericht;


				    $mail->AltBody = $bericht;


				    if ($mail->send()) {
				    	unset($_POST);
				    	header("Location: http://localhost/shelter/gameparty_project_met_georgi/catalogus/bedankt");
				    }


				} catch (Exception $e) {
				    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
				}




		}else{
			$main = file_get_contents("view/partials/contact_form.html");
			$this->TemplatingSystem->setTemplateData("main-content", $main);



			$loginButtonText = "Login";
			if($_SESSION["loginBool"] == 1){
				$loginButtonText = "Loguit";
			}

			$this->TemplatingSystem->setTemplateData("loginButtonText", $loginButtonText);




			$this->TemplatingSystem->setTemplateData("page", APP_DIR . '/catalogus/contact');
			$return = $this->TemplatingSystem->GetParsedTemplate();
			return $return;
		}

	}

	public function bedankt(){

   		$main = file_get_contents("view/partials/bedankt.html");
		$this->TemplatingSystem->setTemplateData("main-content", $main);



		$loginButtonText = "Login";
		if($_SESSION["loginBool"] == 1){
			$loginButtonText = "Loguit";
		}

		$this->TemplatingSystem->setTemplateData("loginButtonText", $loginButtonText);




		$this->TemplatingSystem->setTemplateData("page", APP_DIR . '/catalogus/contact');
		$return = $this->TemplatingSystem->GetParsedTemplate();
		return $return;

	}


	public function home() {

		$selectQuery = "SELECT tab_titel,pagina_titel,content_naam,content,pagina_beschrijving,steekwoorden FROM content WHERE contentID='1'";



		$main = file_get_contents("view/partials/homePage.html");
		$content = $this->connection->QueryRead($selectQuery);


		if (count($content) == 0) {
			$tab_titel = "";	
			$pagina_titel= "";
			$content_naam= "";
			$content0= "";
			$pagina_beschrijving= "";
			$steekwoorden= "";
			
		}else{
			$tab_titel = $content[0]["tab_titel"];
			$pagina_titel = $content[0]["pagina_titel"];
			$content_naam = $content[0]["content_naam"];
			$content0 = $content[0]["content"];
			$pagina_beschrijving = $content[0]["pagina_beschrijving"];
			$steekwoorden = $content[0]["steekwoorden"];
	
		}





$this->TemplatingSystem->setTemplateData("main-content", $main);


$loginButtonText = "Login";
if($_SESSION["loginBool"] == 1){
	$loginButtonText = "Loguit";
}

$this->TemplatingSystem->setTemplateData("loginButtonText", $loginButtonText);




		$this->TemplatingSystem->setTemplateData("tab_titel", $tab_titel);
		$this->TemplatingSystem->setTemplateData("pagina_titel", $pagina_titel);
		$this->TemplatingSystem->setTemplateData("content_naam", $content_naam);
		$this->TemplatingSystem->setTemplateData("content0", $content0);
		$this->TemplatingSystem->setTemplateData("pagina_beschrijving", $pagina_beschrijving);
		$this->TemplatingSystem->setTemplateData("steekwoorden", $steekwoorden);


		$this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
		$return = $this->TemplatingSystem->GetParsedTemplate();
		return $return;
	}
}

?>
