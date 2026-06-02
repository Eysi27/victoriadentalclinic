<?php
//Service for Registration

require_once('databaseService.php');
$treatment = urldecode($_POST['treatment']);

$diagnosis = urldecode($_POST['diagnosis']);
$details = urldecode($_POST['details']);
$remarks = urldecode($_POST['remarks']);
$price = urldecode($_POST['price']);
$clientid = urldecode($_POST['clientid']);
$esoaid = urldecode($_POST['soaid']);
$hmo = urldecode($_POST['hmo']);

$service = new ServiceClass();
$result = $service->submitEsoaSub($treatment, $diagnosis, $details, $remarks, $price, $clientid, $esoaid, $hmo);
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
	public function submitEsoaSub($treatment, $diagnosis, $details, $remarks, $price, $clientid, $esoaid, $hmo)
	{
		try {
			$query = "Insert into treatmentsub(treatment,remarks,details,price,clientid,soaid,diagnosis,hmo) values (:a,:b,:c,:d,:e,:f,:g,:h)";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':a', $treatment);
			$stmt->bindParam(':b', $remarks);
			$stmt->bindParam(':c', $details);
			$stmt->bindParam(':d', $price);
			$stmt->bindParam(':e', $clientid);
			$stmt->bindParam(':f', $esoaid);

			$stmt->bindParam(':g', $diagnosis);
			$stmt->bindParam(':h', $hmo);
			$stmt->execute();
			return "success";
		} catch (Exception $e) {
			return "Error:" . $e->getMessage();
		}



	}
	//UNTIL THIS CODE

}
//UNTIL HERE COPY



?>