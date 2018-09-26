<?php

require_once('Model/ModelCatalogus.php');

class Controller_catalogus{


	private $connection;

	function __construct(){
		$this->connection = new dbhandler(DB_NAME, DB_USERNAME, DB_PASS);


	}
	public function runController(){
		$sample = $this->connection->QueryRead("SELECT * FROM bioscopen");

	}
}



 ?>
