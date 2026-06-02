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
	//DO NOT INCLUDE THIS CODE
	public function loadTreatmentList()
	{



		$query = "select * from treatmentlist where status='Active'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

				echo '
                <tr style="color: black;">
                <td style="display:none;">' . $row["treatmentid"] . '</td>
                <td>' . $row["treatment"] . '</td>
                <td>' . $row["description"] . '</td>
                
               
                <td align="center">
                <a href="updateTreatment.php?treatmentid=' . $row["treatmentid"] . '" class="btn btn-warning btn-circle" title="Update treatment"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-circle" onclick="deleteTreatment(\'' . $row["treatmentid"] . '\')" title="Delete treatment"><i class="fas fa-trash"></i></a>
                
                
                </td>
            </tr>';
			}

		} else {
			echo '
<tr>
                <td style="display:none;">-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              
            </tr>




';

		}
	}

}







?>