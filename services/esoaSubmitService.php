<?php
//Service for Registration

require_once('databaseService.php');
$dentist = urldecode($_POST['dentist']);
$date = urldecode($_POST['date']);
$time = urldecode($_POST['time']);
$clientid = urldecode($_POST['clientid']);
$total = urldecode($_POST['total']);
$hmo = urldecode($_POST['hmo']);
$agreement = urldecode($_POST['agreement']);
$service = new ServiceClass();
$result = $service->process($dentist, $date, $time, $clientid, $total, $hmo, $agreement);
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
	public function process($dentist, $date, $time, $clientid, $total, $hmo, $agreement)
	{
		try {
			$query = "Insert into treatmentsoa(date,time,clientid,dentist,total,hmoaccredited,agreement) values (:a,:b,:c,:d,:e,:f,:g)";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':a', $date);
			$stmt->bindParam(':b', $time);
			$stmt->bindParam(':c', $clientid);
			$stmt->bindParam(':d', $dentist);
			$stmt->bindParam(':e', $total);
			$stmt->bindParam(':f', $hmo);
			$stmt->bindParam(':g', $agreement);

			$stmt->execute();


			$query = "select max(soaid) as lastsoaid from treatmentsoa";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			if ($stmt->rowCount() > 0) {
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					return $row["lastsoaid"];
				}

			}





		} catch (Exception $e) {
			return "Error:" . $e->getMessage();
		}



	}
	//UNTIL THIS CODE

}
//UNTIL HERE COPY



?>