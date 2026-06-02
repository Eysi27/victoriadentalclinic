<?php
require_once('databaseService.php');
$service = new ServiceClass();
$clientid = urldecode($_POST['clientId']);
$result = $service->loadPhoto($clientid);

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
    public function loadPhoto($clientid)
    {



        $query = "select photo from clientprofile where clientid=:a";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $clientid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($row && !empty($row['photo'])) {
                    $imageData = base64_encode($row['photo']);
                    $imageType = "png"; // Or "png" depending on what your DB stores
                    echo "data:image/{$imageType};base64,{$imageData}";
                    return;
                }
            }
        } else {
            echo '';
        }
    }
}
