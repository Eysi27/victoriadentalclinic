<?php
require_once('databaseService.php');
$service = new ServiceClass();
$result = $service->loadClientSoa();

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
    public function loadClientSoa()
    {

        $query = "select date,time,soaid,dentist,total from treatmentsoa";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $payment = 0;
                $soaid = $row["soaid"];
                $query2 = "SELECT amount FROM payments WHERE soaid = :x";
                $stmt2 = $this->conn->prepare($query2);
                $stmt2->bindParam(':x', $soaid);
                $stmt2->execute();
                if ($stmt2->rowCount() > 0) {
                    echo 'hey1';
                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        $payment += $row2["amount"];
                    }
                } else {
                    echo 'hey2';
                }
                echo '
                    <tr>
                    <td>' . $row["date"] . '</td>

                    <td>' . $row["time"] . '</td>
                    <td>' . $row["dentist"] . '</td>
                    <td>' . $row["total"] . '</td>
                    <td>' . ($row["total"] - $payment) . '</td>
                    <td style="text-align:center;">';
                echo '<a class="btn btn-success btn-circle" href="soaViewing.php?soaid=' . $row["soaid"] . '" title="View SOA"><i class="fas fa-eye"></i></a>
                      <a class="btn btn-primary btn-circle" href="attachment.php?soaid=' . $row["soaid"] . ' title="View Attachment"><i class="fas fa-paperclip"></i></a>
                   </td>
                </tr>';
            }
        }
    }
}
