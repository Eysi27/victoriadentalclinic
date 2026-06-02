<?php
require_once('databaseService.php');
$service = new ServiceClass();

$result = $service->runMethod();
echo $result;
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



        $query = "SELECT *
          FROM treatmentsubpayment 
          WHERE MONTH(paymentdate) = MONTH(CURDATE()) 
            AND YEAR(paymentdate) = YEAR(CURDATE()) and tsubid in (select tsubid from treatmentsub)";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $amount = 0;
        $creditcard = 0;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $amount += $row["amount"];
                if ($row["paymenttype"] == "Credit Card") {
                    $creditcard += $row["amount"];
                }
            }
        }

        $subcharge = $creditcard * .04;
        $grossincome = $amount - $subcharge;

        $query = "SELECT sum(amount) as amount 
          FROM expenses 
          WHERE MONTH(date) = MONTH(CURDATE()) 
            AND YEAR(date) = YEAR(CURDATE())";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $amount = 0;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $amount = $row["amount"];
            }
        }

        $netincome = $grossincome - $amount;
        return date('F') . ' - ' . number_format($netincome, 2);
    }

}
?>