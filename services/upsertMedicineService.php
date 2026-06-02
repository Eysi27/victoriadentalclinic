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
        $genericname = $data['genericname'];
        $dispense = $data['dispense'];
        $signetur = $data['signetur'];
        $query = '';
        if ($medid != '') {

            $query = "update medicine set genericname=:a,dispense=:b,signetur=:c where medicineid=:x";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':x', $medid);
        } else {

            $query = "insert into medicine (genericname,dispense,signetur)values(:a,:b,:c)";
            $stmt = $this->conn->prepare($query);

        }

        $stmt->bindParam(':a', $genericname);
        $stmt->bindParam(':b', $dispense);
        $stmt->bindParam(':c', $signetur);
        $stmt->execute();

        echo 'success';



    }

}







?>