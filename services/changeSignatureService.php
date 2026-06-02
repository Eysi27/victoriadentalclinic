<?php
//Service for Registration

require_once('databaseService.php');



$patientbase64 = $_POST['patientSignature'];
// Remove the metadata from base64
$patientbase64 = str_replace('data:image/png;base64,', '', $patientbase64);
$patientbase64 = str_replace(' ', '+', $patientbase64);

$patientSignature = base64_decode($patientbase64);
$soaid = urldecode($_POST['soaid']);
//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->process($soaid, $patientSignature);
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
    public function process($soaid, $patientSignature)
    {
        //:a,:b parameter
        try {
            $dateSigned = date("Y-m-d");
            $query = "update  treatmentsoa set signature=:b,dateSigned=:c where soaid=:a";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $soaid);
            $stmt->bindParam(':b', $patientSignature);
            $stmt->bindParam(':c', $dateSigned);
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