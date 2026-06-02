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
       


        $query = "select * from bookappointmentinfo";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $fullname =$row["lName"].', '.$row["fName"].' '.$row["mName"];
                echo'
<tr>
                <td>'.$row["clientid"].'</td>
				<td>'.$row["datebooked"].'</td>
                <td>'.$fullname.'</td>
                <td>'.$row["Mobile"].'</td>
                <td>'.$row["Email"].'</td>
				<td>'.$row["Status"].' '.$row["dateassigned"].'</td>
                
               
                <td>';
				if($row["Status"]=="Pending"){
				echo'
				
				<a href="#" onclick="approve(\''.$row["clientid"].'\');"   class="btn btn-primary ">Approve</a>
				<a href="#" onclick="decline(\''.$row["clientid"].'\');"   class="btn btn-danger ">Decline</a>

				'; 
			}else{
				echo'Processed';
				}
				echo '</td>';
              
            }
       
		} else {
			echo'
<tr>
<td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
				<td>-</td>
                
            </tr>




';

		}
    }

}

	





?>