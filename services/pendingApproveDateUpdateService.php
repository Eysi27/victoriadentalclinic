<?php
//Service for Registration

require_once('databaseService.php');
$clientid = isset($_POST['clientid']) ? urldecode($_POST['clientid']) : '';
$approveDate = isset($_POST['dateassigned']) ? trim($_POST['dateassigned']) : '';
$dentist = isset($_POST['dentist']) ? urldecode($_POST['dentist']) : '';

if ($approveDate !== '') {
	$approveDate = date('Y-m-d H:i:s', strtotime(str_replace('T', ' ', $approveDate)));
}

//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->bookappointmentinfo($clientid, $approveDate, $dentist);
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
	public function bookappointmentinfo($clientid, $approveDate, $dentist)
	{
		//:a,:b parameter
		try {

			$query = "update bookappointmentinfo set dateassigned=:a, dentist=:c, status='Booked' where clientid=:b";
			//$query = "Insert intoclientprofile(lname,fname,mdname,nickname,age,sex,occupation,mobileNumber,homeAddress,guardianName,gOccupation,refferedBy) values (:a,:b,:c,:d,:e,:f,:g,:i,:j,:k,:l,:m)";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':a', $approveDate);
			$stmt->bindParam(':b', $clientid);
			$stmt->bindParam(':c', $dentist);

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