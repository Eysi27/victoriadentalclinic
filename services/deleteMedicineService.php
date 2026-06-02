<?php
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


        $medid = $data['medid'];



        $query = "delete from medicine where medicineid=:x";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':x', $medid);


        $stmt->execute();

        echo 'success';



    }

}







?>