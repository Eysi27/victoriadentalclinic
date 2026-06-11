<?php
require_once('databaseService.php');
$treatmentId = urldecode($_POST['treatmentId']);
$service = new ServiceClass();
$result = $service->deleteTreatment($treatmentId);
echo $result;

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
    public function deleteTreatment($treatmentId){

        try{
        $query = "update treatmentlist set status='Deleted' where treatmentid=:a";
		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $treatmentId);
		$stmt->execute();
        return 'success';
        }catch(Exception $e){
            return 'error';
        }

    }

	


}


?>