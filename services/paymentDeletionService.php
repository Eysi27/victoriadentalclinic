<?php
//Service for Registration

require_once('databaseService.php');
$ref = urldecode($_POST['ref']);
$service = new ServiceClass();
$result = $service->process($ref);

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
    public function process($ref)
    {
        try {

            $query = "delete from treatmentsubpayment where tsubpayid=:a";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $ref);
            $stmt->execute();

            echo 'Success';


        } catch (Exception $e) {
            return "Error:" . $e->getMessage();
        }
    }
    //UNTIL THIS CODE

}
//UNTIL HERE COPY
