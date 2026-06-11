<?php
//Service for Registration

require_once('databaseService.php');

$fname = urldecode($_POST['fname']);
$mname = urldecode($_POST['mname']);
$lname = urldecode($_POST['lname']);
$mobile = urldecode($_POST['mobile']);
$email = urldecode($_POST['email']);

//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->bookAppintment($fname,$mname,$lname,$mobile,$email);
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
	public function bookAppintment($fname,$mname,$lname,$mobile,$email)
	{
		//:a,:b parameter
		try{
            $status='Pending';
            $date=date('Y-m-d');
		$query = "Insert into bookappointmentinfo (fName,Mobile,Email,Status,lName,mName,ipaddress,dateBooked)values(:a,:b,:c,:d,:e,:f,:g,:h)";
			$stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $fname);
		$stmt->bindParam(':b', $mobile);
		$stmt->bindParam(':c', $email);
		$stmt->bindParam(':d', $status);
        $stmt->bindParam(':e', $lname);
        $stmt->bindParam(':f', $mname);
        $stmt->bindParam(':g', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $stmt->bindParam(':h',$date );
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