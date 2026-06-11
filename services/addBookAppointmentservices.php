<?php
//Service for Registration

require_once('databaseService.php');
$Name = urldecode($_POST['Name']);
$Mobile = urldecode($_POST['Mobile']);
$Email = urldecode($_POST['Email']);
$Status = 'Booked';

//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->Bookinfo($Name,$Mobile,$Email,$Status);
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
	public function Bookinfo($Name,$Mobile,$Email,$Status)
	{
		//:a,:b parameter
		try{

		$query = "Insert into bookappointmentinfo (Name,Mobile,Email,Status) values (:Name,:Mobile,:Email,:Status)";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':Name', $Name);
		$stmt->bindParam(':Mobile', $Mobile);
		$stmt->bindParam(':Email', $Email);
		$stmt->bindParam(':Status', $Status);
		
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