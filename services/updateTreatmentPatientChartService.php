<?php
require_once('databaseService.php');
$service = new ServiceClass();
$soaid = $_POST['soaid'];
$tsubid = $_POST['tsubid'];
$treatment = $_POST['treatment'];
$diagnosis = $_POST['diagnosis'];
$remarks = $_POST['remarks'];
$details = $_POST['details'];
$price = $_POST['price'];
$hmo = $_POST['hmo'];
$result = $service->process($soaid, $tsubid, $treatment, $diagnosis, $remarks, $details, $price, $hmo);

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
    public function process($soaid, $tsubid, $treatment, $diagnosis, $remarks, $details, $price, $hmo)
    {

        $query = "update treatmentsub set treatment=:a,diagnosis=:b,remarks=:c,details=:d,price=:e,hmo=:h where soaid=:f and tsubid=:g";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $treatment);
        $stmt->bindParam(':b', $diagnosis);
        $stmt->bindParam(':c', $remarks);
        $stmt->bindParam(':d', $details);
        $stmt->bindParam(':e', $price);
        $stmt->bindParam(':f', $soaid);
        $stmt->bindParam(':g', $tsubid);
        $stmt->bindParam(':h', $hmo);
        $stmt->execute();

        $totalFee = 0;
        $query = "select sum(price) as fee from treatmentsub where soaid=:a";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $soaid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $totalFee = $row["fee"];
            }
        }

        $query = "update treatmentsoa  set total=:a where soaid=:b";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $totalFee);
        $stmt->bindParam(':b', $soaid);

        $stmt->execute();




    }
}
