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
        $superuser = "nikesarmiento";


        $query = "select * from medicine order by genericname asc";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        echo '<option value="">Select Medicine</option>';
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $desc = $row["genericname"] . "\n" . $row["dispense"] . "\n" . $row["signetur"];
                $value = htmlspecialchars($row["medicineid"]);
                $text = htmlspecialchars($row["genericname"]);
                $descAttr = htmlspecialchars($desc); // escape for safe HTML in attribute

                echo '<option value="' . $value . '" data-desc="' . $descAttr . '">' . $text . '</option>';


            }
        }
    }
}
