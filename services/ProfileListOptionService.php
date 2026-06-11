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



        $query = "select * from clientprofile order by lname desc";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        echo '<option value="">Profile</option>';
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $fullname = $row["lname"] . ', ' . $row["fname"] . ' ' . $row["mdname"];

                echo '<option value="'.$fullname.'">'.$fullname.'</option>';


            }
        }
    }
}
