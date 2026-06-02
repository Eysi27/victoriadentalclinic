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

        $expenseid = $data['modal-expenseid'];
        $particular = $data['modal-particular'];
        $description = $data['modal-description'];
        $amount = $data['modal-amount'];
        $date = $data['modal-date'];
        $query = "";

        if ($expenseid != '') {
            $query = "update expenses set particular=:particular,description=:description,amount=:amount,date=:date where expenseid=:expenseid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':expenseid', $expenseid, PDO::PARAM_INT);
        } else {
            $query = "INSERT INTO expenses (particular,description,amount,date) VALUES (:particular,:description,:amount,:date)";
            $stmt = $this->conn->prepare($query);
        }
        $stmt->bindParam(':particular', $particular);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':date', $date);
        $stmt->execute();
        echo 'success';



    }

}










?>