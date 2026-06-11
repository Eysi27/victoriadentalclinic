<?php
require_once('databaseService.php');
$soaid = urldecode($_POST['soaid']);
$date = urldecode($_POST['date']);
$amount = urldecode($_POST['amount']);
$paymentType = urldecode($_POST['paymentType']);
$service = new ServiceClass();
$result = $service->process($soaid, $date, $amount, $paymentType);
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
    public function process($soaid, $date, $amount, $paymentType)
    {

        try {
            $query = "insert into payments (date,paymenttype,amount,soaid) values (:a,:b,:c,:d)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $date);
            $stmt->bindParam(':b', $paymentType);
            $stmt->bindParam(':c', $amount);
            $stmt->bindParam(':d', $soaid);

            $stmt->execute();
            return 'success';
        } catch (Exception $e) {
            return 'error';
        }

    }




}


?>