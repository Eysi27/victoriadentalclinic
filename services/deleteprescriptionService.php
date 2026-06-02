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

        $rxid = $data['id'];

        $query = "delete from prescription where rxid=:id";
        $stmt = $this->conn->prepare(query: $query);
        $stmt->bindParam(':id', $rxid, PDO::PARAM_INT);

        $stmt->execute();

        $query = "delete from prescriptionsub where rxid=:id";
        $stmt = $this->conn->prepare(query: $query);
        $stmt->bindParam(':id', $rxid, PDO::PARAM_INT);

        $stmt->execute();
        echo 'success';



    }

}










?>