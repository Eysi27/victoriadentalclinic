<?php
require_once('databaseService.php');
$service = new ServiceClass();
$soaid = $_POST['soaid'];
$tsubid = $_POST['tsubid'];
$result = $service->process($soaid, $tsubid);

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
    public function process($soaid, $tsubid)
    {

        $query = "delete from treatmentsub where soaid=:f and tsubid=:g";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':f', $soaid);
        $stmt->bindParam(':g', $tsubid);
        $stmt->execute();

        $query = "delete from treatmentsubpayment where tsubid=:g";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':g', $tsubid);
        $stmt->execute();



        //check if soa still contains treatmentsub
        $query = "select tsubid from treatmentsub where soaid=:a";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $soaid);
        $stmt->execute();
        $shouldDelete = true;
        if ($stmt->rowCount() > 0) {
            $shouldDelete = false;
        }


        if ($shouldDelete == "Yes") {
            $query = "delete from treatmentsoa where soaid=:a";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $soaid);
            $stmt->execute();
        } else {

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
}
