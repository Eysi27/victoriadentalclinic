<?php
require_once('databaseService.php');
$id = urldecode($_POST['id']);
$service = new ServiceClass();
$result = $service->deleteTreatment($id);
echo $result;

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
    public function deleteTreatment($id)
    {

        try {
            $query = "update hmo set status='Deleted' where id=:a";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $id);
            $stmt->execute();
            return 'success';
        } catch (Exception $e) {
            return 'error';
        }

    }




}


?>