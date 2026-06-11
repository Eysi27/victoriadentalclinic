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
$patientName = urldecode($_POST['patientName']);
$clientId = urldecode($_POST['clientId']);

//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$service->process($dentistSignature, $patientSignature, $dateSigned, $dentistName, $patientName, $clientId);

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
    public function process($dentistSignature, $patientSignature, $dateSigned, $dentistName, $patientName, $clientId)
    {
        //:a,:b parameter
        try {

            $query = "select clientid from orthowaiver where clientid=:a";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $clientId);

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                echo "Patient already has a signed waiver";

            } else {

                $query2 = "Insert into orthowaiver (clientId,patient,dentist,date,signature,dentistSignature) values (:g,:f,:e,:d,:b,:c)";
                $stmt2 = $this->conn->prepare($query2);
                $stmt2->bindParam(':b', $patientSignature);
                $stmt2->bindParam(':c', $dentistSignature);
                $stmt2->bindParam(':d', $dateSigned);
                $stmt2->bindParam(':e', $dentistName);
                $stmt2->bindParam(':f', $patientName);
                $stmt2->bindParam(':g', $clientId);

                $stmt2->execute();

                echo "success";
            }






        } catch (Exception $e) {
            return "Error:" . $e->getMessage();
        }



    }
    //UNTIL THIS CODE

}
//UNTIL HERE COPY



?>