<?php
//Service for Registration

require_once('databaseService.php');
$treatment = urldecode($_POST['treatment']);
$description = urldecode($_POST['description']);
//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->addTreatment($treatment,$description);
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
	public function addTreatment($treatment,$description)
	{
		//:a,:b parameter
		try{

		$query = "Insert into treatmentlist (treatment,description,status) values (:a,:b,'Active')";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':a', $treatment);
		$stmt->bindParam(':b', $description);
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