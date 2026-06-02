<?php
require_once('databaseService.php');
$service = new ServiceClass();
$soaid = urldecode($_POST['soaid']);
$date = urldecode($_POST['date']);
$time = urldecode($_POST['time']);
$dentist = urldecode($_POST['dentist']);

$result = $service->process($soaid, $date, $time, $dentist);

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
    public function process($soaid, $date, $time, $dentist)
    {

        $query = "update treatmentsoa set date=:a, time=:b, dentist=:c where soaid=:d";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $date);
        $stmt->bindParam(':b', $time);
        $stmt->bindParam(':c', $dentist);
        $stmt->bindParam(':d', $soaid);
        $stmt->execute();

    }
}
