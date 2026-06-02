<?php
require_once('databaseService.php');
session_start();
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
        $superuser = "nikesarmiento";


        $query = "select a.soaid,tsubid,hmo,price,date,dentist,treatment,remarks,details,diagnosis,hmoaccredited from treatmentsoa a inner join treatmentsub b on a.soaid=b.soaid where a.clientid=:a order by Date";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $clientid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                echo '
                <tr style="color: black;">
                <td>' . date("Y/m/d", strtotime($row["date"])) . '</td>
                <td>' . $row["dentist"] . '</td>
                <td>' . $row["treatment"] . '</td>
                 <td>' . $row["diagnosis"] . '</td>
                <td>' . $row["remarks"] . '</td>
                <td>' . $row["details"] . '</td>';
                $hmo = $row["hmoaccredited"];
                $hmo = $row["hmo"];
                $hmoDisplay = '';

                if (empty($hmo)) {
                    $hmoDisplay = '-';
                } else {
                    $hmoDisplay = $hmo;
                }
                echo '  <td>' . $hmoDisplay . '</td>';


                echo '
          <td>' . number_format($row["price"], 2) . '</td>';

                $tsubid = $row["tsubid"];
                $query3 = "select * from treatmentsubpayment where tsubid=:a order by paymentdate asc";
                $stmt3 = $this->conn->prepare($query3);
                $stmt3->bindParam(':a', $tsubid);
                $totalPayments = 0;
                $totalBalance = 0;
                $stmt3->execute();
                echo '';
                if ($stmt3->rowCount() > 0) {
                    //paymentamount

                    $paymentrow = 0;
                    echo '<td style="text-align:right;">';

                    $stmt4 = $this->conn->prepare($query3);
                    $stmt4->bindParam(':a', $tsubid);
                    $stmt4->execute();
                    echo '';
                    if ($stmt4->rowCount() > 0) {

                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                            if ($paymentrow > 0) {
                                echo '<br>';
                            }


                            $totalPayments = $totalPayments + $row4["amount"];
                            echo number_format($row4["amount"], 2);

                            $paymentrow++;

                        }
                    }

                    echo '</td>';
                    //paymenttype
                    echo '<td style="text-align:center;">';
                    $paymentrow = 0;
                    $stmt5 = $this->conn->prepare($query3);
                    $stmt5->bindParam(':a', $tsubid);
                    $stmt5->execute();
                    echo '';
                    if ($stmt5->rowCount() > 0) {
                        while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                            if ($paymentrow > 0) {
                                echo '<br>';
                            }

                            echo $row5["paymenttype"];


                            $paymentrow++;
                        }
                    }
                    echo '</td>';

                    //paymentdate
                    echo '<td style="text-align:center;">';
                    $paymentrow = 0;
                    $stmt6 = $this->conn->prepare($query3);
                    $stmt6->bindParam(':a', $tsubid);
                    $stmt6->execute();
                    echo '';
                    if ($stmt6->rowCount() > 0) {
                        while ($row6 = $stmt6->fetch(PDO::FETCH_ASSOC)) {

                            if ($paymentrow > 0) {
                                echo '<br>';
                            }
                            echo $row6["paymentdate"];


                            $paymentrow++;
                        }
                    }
                    echo '</td>';

                    $remainingBalance = $row["price"] - $totalPayments;
                    $totalBalance += $remainingBalance;
                    echo '
                              <td style="text-align:right;">' . number_format($remainingBalance, 2) . '</td>';
                } else {
                    if ($row["price"] == 0) {
                        echo '
                                    <td  style="text-align:right;">' . number_format(0, 2) . '</td>
                                    <td></td>
                                    <td></td>
                                    
                                   <td style="text-align:right;">' . number_format(0, 2) . '</td>';
                    } else {
                        echo '<td colspan="3" style="text-align:center;" >No Payment Yet</td>
                                    <td style="text-align:right;" >' . number_format($row["price"], 2) . '</td>
                                    ';
                    }
                }
                echo '
          
          <td align="center">
  <button class="btn btn-success edit-btn"
    data-soaid="' . $row["soaid"] . '"
     data-tsubid="' . $row["tsubid"] . '"
    data-treatment="' . htmlspecialchars($row["treatment"], ENT_QUOTES) . '"
    data-diagnosis="' . htmlspecialchars($row["diagnosis"], ENT_QUOTES) . '"
    data-remarks="' . htmlspecialchars($row["remarks"], ENT_QUOTES) . '"
    data-details="' . htmlspecialchars($row["details"], ENT_QUOTES) . '"
    data-price="' . $row["price"] . '"
    data-hmo="' . $row["hmo"] . '"
    data-toggle="modal" data-target="#editModal">
    <i class="fas fa-edit"></i>
  </button>
';

                if ($_SESSION["username"] == $superuser) {
                    echo '<button class="btn btn-danger" onclick="deleteTreatment(' . $row["soaid"] . ',' . $row["tsubid"] . ')">
    <i class="fas fa-trash"></i>
  </button>';
                }
                echo '
</td>

                
            </tr>';
            }
        }
    }
}
