<?php
require_once('databaseService.php');
$service = new ServiceClass();
$treatmentId = urldecode($_POST['treatmentId']);
$result = $service->loadTreatmentForm($treatmentId);

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
    public function loadTreatmentForm($treatmentId){
       


        $query = "select * from treatmentlist where status='Active' and treatmentid=:a";
		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $treatmentId);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
               
                echo'
                <label for="Name">TREATMENT</label>
                <hr>
                <label for="treatment">Treatment</label>
                <input type="Text"  name="treatment" id="treatment" placeholder="Treatment" class="form-control" value="'.$row["treatment"].'">
                <label for="description">Treatment</label>
                <textarea id="description" class="form-control" name="description" placeholder="Description" >'.$row["description"].'</textarea>
               
                <div id="formResult"></div>
                <br>
                <button class="btn btn-success" onclick="updateTreatment()">Submit</button>


           ';
            }
       
		} else {
			echo'No Result Found for Treatment Id: '.$treatmentId;

		}
    }

}

	





?>