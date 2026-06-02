<?php
require_once('databaseService.php');
$service = new ServiceClass();
$result = $service->loadClientProfile();

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
    public function loadClientProfile(){
        $query = "select * from medhistory";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
            echo'
            <tr>
                            <td>'.$row["clientid"].'</td>
                            <td>'.$row["q1"].'</td>
                            <td>'.$row["q2"].'</td>'
 
 
 
        }
    }
}