<?php
require_once('databaseService.php');
$service = new ServiceClass();
$d = urldecode($_POST['date']);
$result = $service->loadClientSoa($d);

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
    public function loadClientSoa($d)
    {



        $query = "select * from treatmentsoa where date=:a";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $d);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '
                <tr>
                <td>' . date("Y/m/d", strtotime($row["date"])) . '</td>
         
                <td>' . $row["time"] . '</td>
                <td>' . $row["dentist"] . '</td>
                <td>' . $row["total"] . '</td>
                <td style="text-align:center;">
               
               </td>
            </tr>';
            }
        } else {
            echo '
<tr>
<td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>




';
        }
    }
}
