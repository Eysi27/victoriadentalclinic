<?php
//Service for Registration

require_once('databaseService.php');
$soaid = urldecode($_POST['soaid']);
$service = new ServiceClass();
$result = $service->printSoa($soaid);
echo $result;
//USE THIS AS YOUR BASIS
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
    public function printSoa($soaid)
    {
        try {
            $soaTotal = 0;
            $totalPayment = 0;
            $query = "select * from treatmentsoa where soaid=:a";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $soaid);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $soaTotal = $row["total"];

                }

            }


            $query = "select * from payments where soaid=:a";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $soaid);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $totalPayment += $row["amount"];
                    echo '
                <tr>
                    <td>
                    ' . $row["date"] . '
                    </td>
                    <td>
                    ' . number_format($row["amount"], 2) . '
                    </td>
                    <td>
                    ' . $row["paymenttype"] . '
                    </td>
                </tr>
                
                    ';
                }
            }

            echo '
            <br>
                <tr>
                    <td colspan="2">
                    Total Payment:
                    </td>
                    <td align="right">
                    ' . number_format($totalPayment, 2) . '
                    </td>
                   
                </tr>

                <tr>
                    <td colspan="2">
                    Total Balamce:
                    </td>
                    <td align="right">
                    ' . number_format($soaTotal - $totalPayment, 2) . '
                    </td>
                   
                </tr>
            
            ';
        } catch (Exception $e) {
            return "Error:" . $e->getMessage();
        }
    }
    //UNTIL THIS CODE

}
//UNTIL HERE COPY
