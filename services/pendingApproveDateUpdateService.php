<?php
//Service for Registration

require_once('databaseService.php');
$clientid = urldecode($_POST['clientid']);
$approveDate = urldecode($_POST['date']);


//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->bookappointmentinfo($clientid, $approveDate);
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
	public function bookappointmentinfo($clientid, $approveDate)
	{
		//:a,:b parameter
		try {

			$query = "update bookappointmentinfo set dateassigned=:a, status='Booked' where clientid=:b";
			//$query = "Insert intoclientprofile(lname,fname,mdname,nickname,age,sex,occupation,mobileNumber,homeAddress,guardianName,gOccupation,refferedBy) values (:a,:b,:c,:d,:e,:f,:g,:i,:j,:k,:l,:m)";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':a', $approveDate);

			$stmt->bindParam(':b', $clientid);

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