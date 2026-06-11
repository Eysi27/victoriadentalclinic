<?php
require_once('databaseService.php');
$service = new ServiceClass();
$consentId = urldecode($_POST['consentId']);
$role = urldecode($_POST['role']);
$result = $service->loadSignature($consentId, $role);

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
    public function loadSignature($consentId, $role)
    {

        $query = "select dentistSignature as 'signature' from consent where id=:a";
        if ($role == 'patientSignature') {
            $query = "select clientSignature as 'signature' from consent where id=:a";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $consentId);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {


                if ($row && !empty($row['signature'])) {
                    $imageData = base64_encode($row['signature']);
                    $imageType = "png"; // Or "png" depending on what your DB stores
                    echo "data:image/{$imageType};base64,{$imageData}";
                    return;
                }
            }
        }
    }
}
