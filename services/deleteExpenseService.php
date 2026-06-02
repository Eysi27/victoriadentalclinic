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

        $expenseid = $data['modal-deleteexpenseid'];

        $query = "delete from expenses where expenseid=:expenseid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':expenseid', $expenseid, PDO::PARAM_INT);

        $stmt->execute();
        echo 'success';



    }

}










?>