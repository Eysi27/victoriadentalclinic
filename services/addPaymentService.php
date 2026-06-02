<?php
require_once('databaseService.php');

$tsubid = urldecode($_POST['tsubid']);
$date = urldecode($_POST['date']);
$amount = urldecode($_POST['amount']);
$paymentType = urldecode($_POST['paymentType']);
$service = new ServiceClass();
$result = $service->process($tsubid, $date, $amount, $paymentType);
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
    public function process($tsubid, $date, $amount, $paymentType)
    {

        try {
            // $query = "insert into payments (date,paymenttype,amount,soaid) values (:a,:b,:c,:d)";
            // $query = "update treatmentsub set payment=:c, paymenttype=:b, paymentdate=:a where tsubid=:d";
            $query = "insert into treatmentsubpayment (paymentdate,paymenttype,amount,tsubid) values (:a,:b,:c,:d)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $date);
            $stmt->bindParam(':b', $paymentType);
            $stmt->bindParam(':c', $amount);
            $stmt->bindParam(':d', $tsubid);

            $stmt->execute();
            return 'success';
        } catch (Exception $e) {
            return 'error';
        }

    }




}


?>