<?php
require_once('databaseService.php');
$service = new ServiceClass();

$service->runMethod();

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
    public function runMethod()
    {


        $arrayLabel = array();
        $query = "select distinct(year(date)) as 'yd' from treatmentsoa order by year(date) asc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($arrayLabel,$row["yd"]);
            }
        }

        $arrayData = array();
        foreach ($arrayLabel as $year) {
            $query = "SELECT sum(total) as 'earning' FROM treatmentsoa where year(date)=:a";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $year);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($arrayData,$row["earning"]);
                }
            }
        }
        $data['datas'] =$arrayData;
        $data['label'] = $arrayLabel;
        echo json_encode($data);
    }

}
?>