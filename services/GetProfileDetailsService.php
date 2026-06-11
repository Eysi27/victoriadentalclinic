<?php
require_once('databaseService.php');
session_start();
$service = new ServiceClass();

$result = $service->process();

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
  public function process()
{
    if (isset($_POST['fullname'])) {
        $fullname = $_POST['fullname'];

        // Expecting format: "Lastname, Firstname Middlename"
        $query = "SELECT age, sex, homeAddress 
                  FROM clientprofile 
                  WHERE CONCAT(lname, ', ', fname, ' ', mdname) = :fullname";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data = [
                "age" => $row["age"],
                "gender" => ucfirst(strtolower($row["sex"])), // MALE/FEMALE → Male/Female
                "address" => $row["homeAddress"]
            ];
            echo json_encode($data);
        }
    }
}

}
