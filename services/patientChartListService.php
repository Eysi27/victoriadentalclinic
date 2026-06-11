<?php
require_once('databaseService.php');
$service = new ServiceClass();

$clientid = urldecode($_POST['id']);
$result = $service->process($clientid);

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
    public function process($clientid)
    {



        $query = "select date,dentist,treatment,remarks,details from treatmentsoa a inner join treatmentsub b on a.soaid=b.soaid where a.clientid=:a order by Date";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $clientid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                echo '
                <tr>
                <td>' . $row["date"] . '</td>
                <td>' . $row["dentist"] . '</td>
                <td>' . $row["treatment"] . '</td>
                <td>' . $row["remarks"] . '</td>
                <td>' . $row["details"] . '</td>
          
                
            </tr>';
            }
        }
    }
}
