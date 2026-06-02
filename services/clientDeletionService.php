<?php
require_once('databaseService.php');
$clientId = urldecode($_POST['clientId']);
$service = new ServiceClass();
$result = $service->deleteClientProfile($clientId);
echo $result;

class ServiceClass
{

	private $conn;
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
	}

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	//DO NOT INCLUDE THIS CODE
	public function deleteClientProfile($clientId)
	{

		try {
			$query = "delete from clientprofile where clientid =:a";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':a', $clientId);
			$stmt->execute();
			return 'success';
		} catch (Exception $e) {
			return 'error';
		}

	}




}


?>