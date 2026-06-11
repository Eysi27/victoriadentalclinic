<?php
//Service for Registration

require_once('databaseService.php');
$id = urldecode($_POST['id']);
$name = urldecode($_POST['name']);
$accountnumber = urldecode($_POST['accountnumber']);
$birthdate = urldecode($_POST['birthdate']);
$company = urldecode($_POST['company']);
$contact = urldecode($_POST['contact']);
$hmo = urldecode($_POST['hmo']);

$validity = urldecode($_POST['validity']);
$benefit = urldecode($_POST['benefit']);
$remarks = urldecode($_POST['remarks']);

$verification = urldecode($_POST['verification']);
$agent = urldecode($_POST['agent']);
$service = new ServiceClass();
$result = $service->process($id, $name, $accountnumber, $birthdate, $company, $contact, $hmo, $validity, $benefit, $remarks, $verification, $agent);
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
    public function process($id, $name, $accountnumber, $birthdate, $company, $contact, $hmo, $validity, $benefit, $remarks, $verification, $agent)
    {

        try {

            $query = "update hmo set verificationStatus=:k,agent=:l,accountnumber=:a, hmo=:b, name=:c, dob=:d, company=:e, contact=:f,validity=:h,dentalbenefits=:i,remarks=:j where id=:g";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $accountnumber);
            $stmt->bindParam(':b', $hmo);
            $stmt->bindParam(':c', $name);
            $stmt->bindParam(':d', $birthdate);
            $stmt->bindParam(':e', $company);
            $stmt->bindParam(':f', $contact);
            $stmt->bindParam(':g', $id);

            $stmt->bindParam(':h', $validity);
            $stmt->bindParam(':i', $benefit);
            $stmt->bindParam(':j', $remarks);
            $stmt->bindParam(':k', $verification);
            $stmt->bindParam(':l', $agent);
            $stmt->execute();
            return "success";
        } catch (Exception $e) {
            return "Error:" . $e->getMessage();
        }



    }
    //UNTIL THIS CODE

}
//UNTIL HERE COPY



?>