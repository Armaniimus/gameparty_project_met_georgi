<?php

class dbhandler
{

	private $serverName;
	private $databaseName;
	private $userName;
	private $password;
	private $connection;

	function __construct($databaseName,$userName,$password,$servername = 'localhost') {
		$this->databaseName   = $databaseName;
		$this->userName       = $userName;
		$this->password       = $password;

		try {
		  	$this->connection = new PDO("mysql:host=$servername;dbname=$databaseName", $userName, $password);
		  	$conn = $this->connection;
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (PDOException $e) {
		    echo "Connection failed: " . $e->getMessage();
		}
	}

	function queryRead($query) {
		$stmt = $this->connection->query($query);
		$array = $stmt->fetchAll(PDO::FETCH_ASSOC );

		return $array;
	}

	function createData($query) {
		$stmt = $this->connection;
		$stmt->query($query);

		return $stmt->lastInsertId();
	}

	function updateData($query) {
		$stmt = $this->connection;
		$stmt->query($query);

		return $stmt->lastInsertId();
	}

	function deleteData($query) {
		$stmt = $this->connection;
		$stmt->query($query);
	}
}
