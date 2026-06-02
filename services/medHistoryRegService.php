<?php
//Service for Registration

require_once('databaseService.php');

$clientId = urldecode($_POST['clientId']);
$q1 = urldecode($_POST['q1']);
$q2 = urldecode($_POST['q2']);
$q3 = urldecode($_POST['q3']);
$q4 = urldecode($_POST['q4']);
$q5 = urldecode($_POST['q5']);
$q6 = urldecode($_POST['q6']);
$q7 = urldecode($_POST['q7']);
$q8 = urldecode($_POST['q8']);
$q9 = urldecode($_POST['q9']);
$q10 = urldecode($_POST['q10']);
$q11 = urldecode($_POST['q11']);
$q12 = urldecode($_POST['q12']);
$q13 = urldecode($_POST['q13']);
$q14 = urldecode($_POST['q14']);
$q15 = urldecode($_POST['q15']);
$q16 = urldecode($_POST['q16']);
$q17 = urldecode($_POST['q17']);
$q18 = urldecode($_POST['q18']);
$q19 = urldecode($_POST['q19']);
$q20 = urldecode($_POST['q20']);
$q21 = urldecode($_POST['q21']);
$q22 = urldecode($_POST['q22']);
$q23 = urldecode($_POST['q23']);
$q24 = urldecode($_POST['q24']);
$q25 = urldecode($_POST['q25']);
$q26 = urldecode($_POST['q26']);
$q27 = urldecode($_POST['q27']);
//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->addMedHistory($clientId, $q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $q13, $q14, $q15, $q16, $q17, $q18, $q19, $q20, $q21, $q22, $q23, $q24, $q25, $q26, $q27);
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
	public function addMedHistory($clientId, $q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10, $q11, $q12, $q13, $q14, $q15, $q16, $q17, $q18, $q19, $q20, $q21, $q22, $q23, $q24, $q25, $q26, $q27)
	{
		//:a,:b parameter
		try {

			$query = "Insert into medhistory (clientid,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13,q14,q15,q16,q17,q18,q19,q20,q21,q22,q23,q24,q25,q26,q27) values(:clientid,:q1,:q2,:q3,:q4,:q5,:q6,:q7,:q8,:q9,:q10,:q11,:q12,:q13,:q14,:q15,:q16,:q17,:q18,:q19,:q20,:q21,:q22,:q23,:q24,:q25,:q26,:q27)";
			//$query = "Insert intoclientprofile(q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13,q14,q15,q16,q17,q18,q19,q20,q21,q22) values (:q1,:q2,:q3,:q4,:q5,:q6,:q7,:q8,:q9,:q10,:q11,:q12,:q13,:q14,:q15,:q16,:q17,:q18,:q19,:q20,:q21,:q22)";
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':clientid', $clientId);
			$stmt->bindParam(':q1', $q1);
			$stmt->bindParam(':q2', $q2);
			$stmt->bindParam(':q3', $q3);
			$stmt->bindParam(':q4', $q4);
			$stmt->bindParam(':q5', $q5);
			$stmt->bindParam(':q6', $q6);
			$stmt->bindParam(':q7', $q7);
			$stmt->bindParam(':q8', $q8);
			$stmt->bindParam(':q9', $q9);
			$stmt->bindParam(':q10', $q10);
			$stmt->bindParam(':q11', $q11);
			$stmt->bindParam(':q12', $q12);
			$stmt->bindParam(':q13', $q13);
			$stmt->bindParam(':q14', $q14);
			$stmt->bindParam(':q15', $q15);
			$stmt->bindParam(':q16', $q16);
			$stmt->bindParam(':q17', $q17);
			$stmt->bindParam(':q18', $q18);
			$stmt->bindParam(':q19', $q19);
			$stmt->bindParam(':q20', $q20);
			$stmt->bindParam(':q21', $q21);
			$stmt->bindParam(':q22', $q22);
			$stmt->bindParam(':q23', $q23);
			$stmt->bindParam(':q24', $q24);
			$stmt->bindParam(':q25', $q25);
			$stmt->bindParam(':q26', $q26);
			$stmt->bindParam(':q27', $q27);

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