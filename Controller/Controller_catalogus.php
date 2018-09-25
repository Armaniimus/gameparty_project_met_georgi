<?php 

require_once('Model/ModelCatalogus.php');

class Controller_catalogus{


	private $connection;
	
	function __construct(){
		$this->connection = new dbhandler("Gameplayparties", "root", "");

		
	}
	public function runController(){
		$sample = $this->connection->QueryRead("SELECT * FROM bioscopen");

	}
}



 ?>