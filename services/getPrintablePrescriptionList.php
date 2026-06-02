<?php
session_start();
require_once('databaseService.php');
$service = new ServiceClass();


$result = $service->process($_POST);

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
    public function process($data)
    {
        $rxid = $data['rxid'];
        $query = "SELECT a.genericname,a.dispense,a.signetur FROM prescriptionsub b inner join medicine a on a.medicineid=b.medicineid  where rxid=:a";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $rxid);

        $stmt->execute();
        $desc = '';
        if ($stmt->rowCount() > 0) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $desc .= $row['genericname'] . ' <br> ' . $row['dispense'] . ' <br> ' . $row['signetur'] . '<br> <br>';

            }
            echo $desc;

        }
    }

}







?>