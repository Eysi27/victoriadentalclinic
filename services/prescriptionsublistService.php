<?php
require_once('databaseService.php');
session_start();
$service = new ServiceClass();

$result = $service->process($_POST);

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
    public function process($data)
    {
        $rxid = $data['rxid'];

        $query = "select a.genericname,a.dispense,a.signetur,a.medicineid from prescriptionsub b inner join medicine a on a.medicineid=b.medicineid  where b.rxid=:a";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":a", $rxid);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $desc = $row["genericname"] . "<br>" . $row["dispense"] . "<br>" . $row["signetur"];

                echo '
                <tr>
                <td>' . $row["medicineid"] . '</td>
                <td>' . $desc . '</td>
                <td><button type="buton" class="btn btn-danger btn-sm" onclick="deleteRow(this);">Delete</button></td>
                </tr>
                
                ';




            }
        }
    }
}
