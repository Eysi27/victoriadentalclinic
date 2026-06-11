<?php
//Service for Registration

require_once('databaseService.php');

$base64Image = $_POST['profilePhoto'];

// Remove the metadata from base64
$base64Image = str_replace('data:image/png;base64,', '', $base64Image);
$base64Image = str_replace(' ', '+', $base64Image);

$imageData = base64_decode($base64Image);
$clientId = urldecode($_POST['clientId']);
$lastName = urldecode($_POST['lastName']);
$firstName = urldecode($_POST['firstName']);
$middleName = urldecode($_POST['middleName']);
$nickName = urldecode($_POST['nickName']);
$gender = urldecode($_POST['gender']);
$age = urldecode($_POST['age']);
$birthday = urldecode($_POST['birthday']);
$homeAddress = urldecode($_POST['homeAddress']);
$occupation = urldecode($_POST['occupation']);
$contactNumber = urldecode($_POST['contactNumber']);
$guardianName = urldecode($_POST['guardianName']);
$guardianOccupation = urldecode($_POST['guardianOccupation']);
$referredBy = urldecode($_POST['referredBy']);

$religion = urldecode($_POST['religion']);
$civilStatus = urldecode($_POST['civilStatus']);
$hmo = urldecode($_POST['hmo']);
$cardNumber = urldecode($_POST['cardNumber']);

$company = urldecode($_POST['company']);
//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->updatePatientProfile($clientId, $lastName, $firstName, $middleName, $nickName, $age, $gender, $birthday, $homeAddress, $occupation, $contactNumber, $guardianName, $guardianOccupation, $referredBy, $religion, $civilStatus, $imageData, $hmo, $cardNumber, $company);
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
	public function updatePatientProfile($clientId, $lastName, $firstName, $middleName, $nickName, $age, $gender, $birthday, $homeAddress, $occupation, $contactNumber, $guardianName, $guardianOccupation, $referredBy, $religion, $civilStatus, $imageData, $hmo, $cardNumber, $company)
	{
		//:a,:b parameter
		try {

			$query = "update clientprofile set religion=:o,civilstatus=:p,photo=:q,hmo=:r,cardnumber=:s,company=:t,lname=:a,fname=:b,mdname=:c,nickname=:d,age=:e,sex=:f,occupation=:g,birthDate=:h,mobileNumber=:i,homeAddress=:j,guardianName=:k,gOccupation=:l,refferedBy=:m where clientid=:n";
			//$query = "Insert intoclientprofile(lname,fname,mdname,nickname,age,sex,occupation,mobileNumber,homeAddress,guardianName,gOccupation,refferedBy) values (:a,:b,:c,:d,:e,:f,:g,:i,:j,:k,:l,:m,:o)";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':a', $lastName);
			$stmt->bindParam(':b', $firstName);
			$stmt->bindParam(':c', $middleName);
			$stmt->bindParam(':d', $nickName);
			$stmt->bindParam(':e', $age);
			$stmt->bindParam(':f', $gender);
			$stmt->bindParam(':g', $occupation);
			$stmt->bindParam(':h', $birthday);
			$stmt->bindParam(':i', $contactNumber);
			$stmt->bindParam(':j', $homeAddress);
			$stmt->bindParam(':k', $guardianName);
			$stmt->bindParam(':l', $guardianOccupation);
			$stmt->bindParam(':m', $referredBy);
			$stmt->bindParam(':n', $clientId);
			$stmt->bindParam(':o', $religion);
			$stmt->bindParam(':p', $civilStatus);
			$stmt->bindParam(':q', $imageData, PDO::PARAM_LOB);
			$stmt->bindParam(':r', $hmo);
			$stmt->bindParam(':s', $cardNumber);
			$stmt->bindParam(':t', $company);
			$stmt->execute();
			return "success";
		} catch (Exception $e) {
			return "Error:" . $e->getMessage();
		}



	}
	//UNTIL THIS CODE

}
//UNTIL HERE COPY



?>