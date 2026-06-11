<?php
require_once('databaseService.php');
$service = new ServiceClass();
$result = $service->loadTreatmentList();

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

    public function loadTreatmentList(){
       
        $query = "SELECT treatmentid, treatment FROM treatmentlist WHERE status='Active' ORDER BY treatment";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
               
                echo '<option value="' . htmlspecialchars($row["treatment"]) . '" data-treatmentid="' . htmlspecialchars($row["treatmentid"]) . '">' . htmlspecialchars($row["treatment"]) . '</option>';
                
            }
       
		} else {
              echo '<option value="">No Treatment Available</option>';
		}
    }

}
?>
