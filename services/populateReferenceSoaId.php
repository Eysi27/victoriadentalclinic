<?php
require_once('databaseService.php');
$service = new ServiceClass();
$data = $_POST;
$result = $service->process($data);

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
	public function process($data = [])
	{
		$clientId = $data['clientid'];

		$query = "select tsub.soaid,tsub.tsubid,treatmentsoa.date,dentist from treatmentsub tsub inner join treatmentsoa on tsub.soaid = treatmentsoa.soaid where tsub.clientid = :clientId and tsub.treatment ='Orthodontic Treatment'";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':clientId', $clientId);


		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

				echo '<option value="' . $row["tsubid"] . '">SOAID: ' . $row["soaid"] . ' - Orthodontic Treatment (' . $row["dentist"] . ' - ' . $row["date"] . ')</option>';

			}
		} else {
			echo '<option>No Reference SOA ID Available</option>';
		}
	}

}







?>