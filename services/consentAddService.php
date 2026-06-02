<?php
//Service for Registration

require_once('databaseService.php');

$dentistbase64 = $_POST['dentistSignature'];
// Remove the metadata from base64
$dentistbase64 = str_replace('data:image/png;base64,', '', $dentistbase64);
$dentistbase64 = str_replace(' ', '+', $dentistbase64);

$dentistSignature = base64_decode($dentistbase64);


$patientbase64 = $_POST['patientSignature'];
// Remove the metadata from base64
$patientbase64 = str_replace('data:image/png;base64,', '', $patientbase64);
$patientbase64 = str_replace(' ', '+', $patientbase64);

$patientSignature = base64_decode($patientbase64);
$dateSigned = urldecode($_POST['dateSigned']);
$dentistName = urldecode($_POST['dentistName']);
$clientId = urldecode($_POST['clientId']);
//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->addTreatment($dentistSignature, $patientSignature, $dateSigned, $dentistName, $clientId);
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
    public function addTreatment($dentistSignature, $patientSignature, $dateSigned, $dentistName, $clientId)
    {
        //:a,:b parameter
        try {

            $query = "Insert into consent (clientId,clientSignature,dentistSignature,date,dentist,status) values (:a,:b,:c,:d,:e,'Active')";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $clientId);
            $stmt->bindParam(':b', $patientSignature);
            $stmt->bindParam(':c', $dentistSignature);
            $stmt->bindParam(':d', $dateSigned);
            $stmt->bindParam(':e', $dentistName);

            $stmt->execute();

            $consentId = 0;
            $query = "select * from consent order by id desc limit 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $consentId = $row["id"];
                }
            }


            // Step 3: Insert medhistory into consentmedhistory
            $query = "INSERT INTO consentmedhistory (
  clientid, consentid, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10,
  q11, q12, q13, q14, q15, q16, q17, q18, q19, q20, q21, q22, q23, q24, q25, q26, q27
)
SELECT 
  clientid, :consentid, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10,
  q11, q12, q13, q14, q15, q16, q17, q18, q19, q20, q21, q22, q23, q24, q25, q26, q27
FROM 
  medhistory
WHERE 
  clientid = :clientid;
";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':consentid', $consentId);
            $stmt->bindParam(':clientid', $clientId);
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