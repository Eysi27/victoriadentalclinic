<?php
//Service for Registration

require_once('databaseService.php');
$treatment = urldecode($_POST['treatment']);
$details = urldecode($_POST['details']);
$remarks = urldecode($_POST['remarks']);
$price = urldecode($_POST['price']);
$clientid = urldecode($_POST['clientid']);
$esoaid = urldecode($_POST['soaid']);
$service = new ServiceClass();
$result = $service->submitEsoaSub($treatment,$details,$remarks,$price,$clientid,$esoaid);
echo $result;
//USE THIS AS YOUR BASIS
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
	public function submitEsoaSub($treatment,$details,$remarks,$price,$clientid,$esoaid)
	{
		try{
		$query = "Insert into treatmentsub(treatment,remarks,details,price,clientid,soaid) values (:a,:b,:c,:d,:e,:f)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':a', $treatment);
		$stmt->bindParam(':b', $remarks);
		$stmt->bindParam(':c', $details);
		$stmt->bindParam(':d', $price);
		$stmt->bindParam(':e', $clientid);
        $stmt->bindParam(':f', $esoaid);
		$stmt->execute();
		return "success";
		}catch(Exception $e){
		return "Error:".$e->getMessage();
		}



	}
	//UNTIL THIS CODE

}
//UNTIL HERE COPY



?>