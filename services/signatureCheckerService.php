<?php
require_once('databaseService.php');
$service = new ServiceClass();


$soaid = urldecode($_POST['soaid']);
$result = $service->process($soaid);

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
    public function process($soaid)
    {



        $query = "select * from treatmentsoa where soaid=:a";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $soaid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo is_null($row["signature"]) ? 'true' : 'false';
            }

        }
    }

}







?>