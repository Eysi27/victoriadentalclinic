<?php
//Service for Registration

require_once('databaseService.php');
$treatmentId = urldecode($_POST['treatmentId']);
$treatment = urldecode($_POST['treatment']);
$description = urldecode($_POST['description']);
//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->addTreatment($treatment,$description,$treatmentId);
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
	public function addTreatment($treatment,$description,$treatmentId)
	{
		//:a,:b parameter
		try{

		$query = "update treatmentlist set treatment=:a,description=:b where treatmentid=:c";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':a', $treatment);
		$stmt->bindParam(':b', $description);
        $stmt->bindParam(':c', $treatmentId);
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