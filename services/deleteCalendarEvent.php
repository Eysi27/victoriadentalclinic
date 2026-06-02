
<?php
//Service for login

require_once('databaseService.php');
$id = urldecode($_POST['id']);
$service = new ServiceClass();
$result = $service->deleteEvent($id);
if($result){
	echo 'success';
}
else{
	echo'failed';
}

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
	public function deleteEvent($id)
	{
		$query = "delete from calendar_event_master where event_id=:a";
		$stmt = $this->conn->prepare($query);
		//setting of parameter
		$stmt->bindParam(':a', $id);
		//trigger
		$stmt->execute();
		return true;
	}
	//UNTIL THIS CODE

}
//UNTIL HERE COPY



?>