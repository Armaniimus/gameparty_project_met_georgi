<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Controller_catalogus {
	private $method;
	private $params;
	private $connection;
	private $templatingSystem;


	function __construct($method = FALSE, $params = FALSE) {
		$this->connection = new dbhandler(DB_NAME, DB_USERNAME, DB_PASS);

		// $this->method = $method;
		// if ($params != FALSE) {
		// 	$this->params = $params;
		// }
		$this->TemplatingSystem = new TemplatingSystem("view/default.tpl");
		$this->TemplatingSystem->setTemplateData("appdir", APP_DIR);
	}

	// public function runController() {
    //     switch ($this->method) {
    //         case 'contact':
    //             return $this->contact();
    //             break;
	//
	// 		case 'home':
	// 			return $this->home();
	// 			break;
	//
	// 		case 'bedankt':
	// 			return $this->bedankt();
	// 			break;
	//
	// 		case 'reserveer':
	// 			return $this->reserveer();
	// 			break;
	//
    //         default:
    //             return $this->catalogus();
    //             break;
    //     }
    // }

	public function default() {
		$this->catalogus();
	}

    public function reserveer() {
		// setID
		$id = $this->params[0];

    	if($_SESSION["loginBool"] == 1){
    		$loginButtonText = "Loguit";
    	}
		// set button text
		$loginButtonText = "Login";
    	$this->TemplatingSystem->setTemplateData("loginButtonText", $loginButtonText);

		// get bioscoop Data
    	$sql = "SELECT * FROM bioscopen WHERE bioscoopID = $id";
    	$result = $this->connection->queryRead($sql);
    	$bioscoopnaam = $result[0]['bioscoop_naam'];

		// get tarieven data
		$sqltarief = "SELECT tariefID, naam, prijsPerPersoon FROM tarieven INNER JOIN bioscopen ON bioscopen_id = bioscopen.bioscoopID WHERE bioscopen.bioscoopID = $id";
    	$tarieven = $this->connection->queryRead($sqltarief);
    	$tariefSelect = "";

    	foreach ($tarieven as $key => $tariefwaarde) {
    		$naam = $tariefwaarde['naam'];
    		$prijs = $tariefwaarde['prijsPerPersoon'];
    		$ID = $tariefwaarde['tariefID'];
    		$tariefSelect .= "<option value='$ID'>$prijs euro PP [$naam]</option>";
    	}


    	$sqlTijden = "SELECT beschikbaarheid_bioscopen.beschikbaarheid_bioscopenID,beginDatum,eindDatum,zaal FROM zalen
		INNER JOIN beschikbaarheid_bioscopen ON zaalID = beschikbaarheid_bioscopen.zalen_zaalID
		INNER JOIN bioscopen ON zalen.bioscoop_id = bioscopen.bioscoopID
		WHERE zalen.bioscoop_id = $id";

    	$tijden = $this->connection->queryRead($sqlTijden);

    	$tijdselect = "";

    	foreach ($tijden as $key => $value) {
    		$beschickbaarID = $value['beschikbaarheid_bioscopenID'];
    		$datum = "";
    		$naamdag = "";
    		$begin_tijd = "";
    		$eind_tijd = "";
    		$zaal = $value['zaal'];

			$datum = date('F j',strtotime($value['beginDatum']));
			$naamdag = date('D', strtotime($datum));
			$begin_tijd = date('H:i',strtotime($value['beginDatum']));
			$eind_tijd = date('H:i',strtotime($value['eindDatum']));

    		$tijdselect .= 	"<option value='$beschickbaarID'>$naamdag $datum om $begin_tijd tot $eind_tijd zaal: $zaal</option>";
    	}


    	$sqlToeslagen = "SELECT toeslagenID, bioscopen_id, naam ,prijs FROM toeslagen INNER JOIN bioscopen ON toeslagen.bioscopen_id = bioscopen.bioscoopID WHERE bioscopen.bioscoopID = 1;";
    	$toeslagen = $this->connection->queryRead($sqlToeslagen);
    	$toeslagSelect  = "";

    	foreach ($toeslagen as $key => $value) {
    		$toeslagid 			= $value['toeslagenID'];
    		$bioscopen_id 		= $value['bioscopen_id'];
    		$naam 				= $value['naam'];
    		$prijs 				= $value['prijs'];

    		$toeslagSelect .= 	"<option value='$toeslagid'>$prijs | $naam</option>";
    	}

    	if (isset($_POST['reserveerstap-1'])) {
    		$gekozen_toeslag				= "";
    		$gekozen_tijd 					= "";
    		$gekozen_personen_jong 			= "";
    		$gekozen_personen_puber			= "";
    		$gekozen_personen_volwassenen 	= "";


    		foreach ($_POST as $key => $value) {
    			switch ($key) {
    				case 'select-tijd':
    					$gekozen_tijd = $_POST['select-tijd'];
    					break;

    				case 'tot-11':
    					$gekozen_personen_jong = $_POST['tot-11'];
    					break;

    				case 'tot-17':
    					$gekozen_personen_puber = $_POST['tot-17'];
    					break;

    				case 'na-18':
    					$gekozen_personen_volwassenen = $_POST['na-18'];
    					break;

    				case 'toeslagenSelect':
    					$gekozen_toeslag = $_POST['toeslagenSelect'];
    					break;

    				default:
    					break;
    			}
    		}

			$_SESSION['formdataReservation'] = $_POST;
    		$main = file_get_contents("view/partials/persoonsgegevens.html");
			$this->TemplatingSystem->setTemplateData("main-content", $main);
		}

    	if (isset($_POST['klanten-gegevens'])) {
    		$time = date("Y-n-j");
    		$_POST['timestamp'] = $time;
    		$klantnaam 						= "";
    		$klantadres 					= "";
    		$postcode 						= "";
    		$plaats 						= "";
    		$provincie 						= "";
    		$telefoonnummer 				= "";
    		$factuurDatum 					= "";
    		$_SESSION['formdataCustomer'] = $_POST;

    		foreach ($_POST as $key => $value) {
    			switch ($key) {
    				case 'naam':
    					$klantnaam =  $_POST['naam'];
    					break;

    				case 'straat':
    					$klantadres = $_POST['straat'];
    					break;

    				case 'postcode':
    					$postcode = $_POST['postcode'];
    					break;

    				case 'plaats':
    					$plaats = $_POST['plaats'];
    					break;

    				case 'provincie':
    					$provincie = $_POST['provincie'];
    					break;

    				case 'telefoonnummer':
    					$gekozen_toeslag = $_POST['telefoonnummer'];
    					break;

    				case 'timestamp':
    					$factuurDatum = $_POST['timestamp'];
    					break;

    				default:
    					break;
    			}
    		}

    		$main = file_get_contents("view/partials/betaalmethode.html");
			$this->TemplatingSystem->setTemplateData("main-content", $main);
    	}

    	if (isset($_POST['bestelling-plaatsen'])) {
    		$_SESSION['betaalmethode'] = $_POST;

    		$naam 					= $_SESSION['formdataCustomer']['naam'];
    		$straat					= $_SESSION['formdataCustomer']['straat'];
    		$postcode				= $_SESSION['formdataCustomer']['postcode'];
    		$plaats 				= $_SESSION['formdataCustomer']['plaats'];
    		$provincie 				= $_SESSION['formdataCustomer']['provincie'];
    		$telefoonnummer 		= $_SESSION['formdataCustomer']['telefoonnummer'];
    		$timestamp 				= $_SESSION['formdataCustomer']['timestamp'];

    		$sql = "INSERT INTO facturen (klantnaam, klantadres , postcode, plaats, provincie, telefoonnummer, factuurDatum) VALUES ('$naam', '$straat', '$postcode','$plaats','$provincie', '$telefoonnummer', '$timestamp'); ";

    		$result = $this->connection->createData($sql);

    		$betaalbedrag;


    		$sql = "SELECT tariefID,naam,prijsPerPersoon,bioscopen_id FROM tarieven INNER JOIN bioscopen ON bioscopen_id = bioscopen.bioscoopID WHERE bioscopen_id = $id";

    		$result = $this->connection->queryRead($sql);


    		foreach ($result as $key => $value) {

    			switch ($value['naam']) {
    				case 'normaal':
    					$betaalbedrag = $value['prijsPerPersoon'] * $_SESSION['formdataReservation']['na-18'];
    					break;

    				case 'kinderen t/m 11 jaar':
    					$betaalbedrag = $betaalbedrag + $value['prijsPerPersoon'] * $_SESSION['formdataReservation']['tot-11'];
    					break;

    				case '65+':
    					// $betaalbedrag = $betaalbedrag + $value['prijsPerPersoon'] * $_SESSION['formdataReservation']['tot-11'];
    					break;
    				case 'studenten. Cjp & bankgiro':
    					$betaalbedrag = $betaalbedrag + $value['prijsPerPersoon'] * $_SESSION['formdataReservation']['tot-17'];
    					break;

    				default:
    					# code...
    					break;
    			}
    		}

    		$sql = "SELECT toeslagenID,bioscopen_id, naam, prijs FROM toeslagen INNER JOIN bioscopen ON bioscopen_id = bioscopen.bioscoopID WHERE bioscopen.bioscoopID = $id";

    		$result = $this->connection->queryRead($sql);


    		foreach ($result as $key => $value) {
    			switch ($value['naam']) {
    				case '3d-toeslag excl bril':
    					$totaalmensen = $_SESSION['formdataReservation']['tot-11'] + $_SESSION['formdataReservation']['tot-17'] + $_SESSION['formdataReservation']['na-18'];
    					$betaalbedrag = $betaalbedrag + ($value['prijs'] * $totaalmensen);
    					break;

    				case '3d-toeslag incl bril':
    					$totaalmensen = $_SESSION['formdataReservation']['tot-11'] + $_SESSION['formdataReservation']['tot-17'] + $_SESSION['formdataReservation']['na-18'];
    					$betaalbedrag = $betaalbedrag + ($value['prijs'] * $totaalmensen);
    					break;


    				case 'dolby atmos':
						$totaalmensen = $_SESSION['formdataReservation']['tot-11'] + $_SESSION['formdataReservation']['tot-17'] + $_SESSION['formdataReservation']['na-18'];
	    				$betaalbedrag = $betaalbedrag + ($value['prijs'] * $totaalmensen);
    				case 'laser ultra':
	    				$totaalmensen = $_SESSION['formdataReservation']['tot-11'] + $_SESSION['formdataReservation']['tot-17'] + $_SESSION['formdataReservation']['na-18'];
	    				$betaalbedrag = $betaalbedrag + ($value['prijs'] * $totaalmensen);
    					break;

    				default:
    					break;
    			}
    		}

    		$timestamp =  $_SESSION['formdataCustomer']['timestamp'];
    		$betaalmethode = $_SESSION['betaalmethode']['betaalmethode'];

    		$sql = "INSERT INTO betalingen (betalingenID, BetaaldBedrag, BetaalDatum, BetalingsMethode) VALUES (NULL, '$betaalbedrag', '$timestamp', '$betaalmethode');";

    		$result = $this->connection->createData($sql);

    		$reservering_id = $result;
    		$geselecteerde_tijd = $_SESSION['formdataReservation']['select-tijd'];

    		$sql = "INSERT INTO reserveringen (reserveringenID, Beschikbaarheid_bioscopenID, betalingen_betalingenID, TotaalVerschuldigd ) VALUES(NULL, $geselecteerde_tijd,$reservering_id , '$betaalbedrag');";

    		$result = $this->connection->createData($sql);

	    	$main = file_get_contents("view/partials/succesvol.html");
			$this->TemplatingSystem->setTemplateData("main-content", $main);

    	}

    	$main = file_get_contents("view/partials/reserveer.html");
		$this->TemplatingSystem->setTemplateData("main-content", $main);
		$this->TemplatingSystem->setTemplateData("toeslagen", $toeslagSelect);
		$this->TemplatingSystem->setTemplateData("tijden", $tijdselect);
		$this->TemplatingSystem->setTemplateData("bioscoopnaam", $bioscoopnaam);
		$this->TemplatingSystem->setTemplateData("tarieven", $tariefSelect);
		$result = $this->TemplatingSystem->getParsedTemplate();

		return $result;

    }

	public function catalogus(){
		$sample = $this->connection->queryRead("SELECT * FROM bioscopen");
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
			    $mail->Body    = "Naam: ".$naam."<br>"."Email: ".$email."<br>"."Telefoonnummer: ".$telefoon."<br><br>"."Onderwerp: ".$onderwerp."<br><br>".$bericht;
			    $mail->AltBody = $bericht;

			    if ($mail->send()) {
			    	unset($_POST);
			    	header("Location: http://localhost/shelter/gameparty_project_met_georgi/catalogus/bedankt");
			    }
			} catch (Exception $e) {
			    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			}

		} else {
			$main = file_get_contents("view/partials/contact_form.html");
			$this->TemplatingSystem->setTemplateData("main-content", $main);

			$loginButtonText = "Login";
			if($_SESSION["loginBool"] == 1){
				$loginButtonText = "Loguit";
			}

			$this->TemplatingSystem->setTemplateData("loginButtonText", $loginButtonText);

			$this->TemplatingSystem->setTemplateData("page", APP_DIR . '/catalogus/contact');
			$return = $this->TemplatingSystem->getParsedTemplate();
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
		$content = $this->connection->queryRead($selectQuery);

		if (count($content) == 0) {
			$tab_titel = "";
			$pagina_titel= "";
			$content_naam= "";
			$content0= "";
			$pagina_beschrijving= "";
			$steekwoorden= "";

		} else {
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
		$return = $this->TemplatingSystem->getParsedTemplate();
		return $return;
	}
}

?>
