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







		if (!empty($_POST['submit'])) {

			$naam = $_POST['naam'];
			$email = $_POST['email'];
			$telefoon = $_POST['telefoon'];
			$bericht = $_POST['bericht'];

				require_once "Model/vendor/phpmailer/phpmailer/src/phpmailer.php";
				require_once "Model/vendor/phpmailer/phpmailer/src/SMTP.php";
				require_once "Model/vendor/phpmailer/phpmailer/src/Exception.php";

				$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
				try {
				 //Server settings
				    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
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
				    $mail->addAddress('ellen@example.com');               // Name is optional
				    $mail->addReplyTo($email, 'Information');
				   

					   // Optional name

				    //Content
				    $mail->isHTML(true);                                  // Set email format to HTML
				    $mail->Subject = 'Here is the subject';
				    $mail->Body    = $bericht;
				    $mail->AltBody = $bericht;


				    $mail->send();
				    echo 'Message has been sent';
				} catch (Exception $e) {
				    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
				}





			unset($_POST);
			
		}else{
			$main = file_get_contents("view/partials/contact_form.html");
			$this->TemplatingSystem->setTemplateData("main-content", $main);
			$this->TemplatingSystem->setTemplateData("page", APP_DIR . '/catalogus/contact');
			$return = $this->TemplatingSystem->GetParsedTemplate();
			return $return;
		}

	}

	public function home() {
		$main = file_get_contents("view/partials/homePage.html");
		$content = $this->connection->QueryRead("SELECT content_inhoud FROM content WHERE id='overons' ");
		$result = implode($content[0]);
		$this->TemplatingSystem->setTemplateData("main-content", $main);
		$this->TemplatingSystem->setTemplateData("content", $result);

		$return = $this->TemplatingSystem->GetParsedTemplate();
		return $return;
	}
}

?>
