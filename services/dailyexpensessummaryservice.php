<?php
require_once('databaseService.php');
$service = new ServiceClass();
$fromdate = urldecode($_POST['from']);
$group = urldecode($_POST['group']);
$result = $service->loadClientTreatment($fromdate, $group);

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
    public function loadClientTreatment($fromdate, $group)
    {
        $key = 'tsoa.soaid';
        if ($group == 'Dentist') {
            $key = 'tsoa.dentist';
        } else if ($group == 'Patient') {
            $key = 'concat (cp.lname, ", ", cp.fname, " ", cp.mdname)';
        }
        $grandTotal = 0;
        $grandAccumulatedPayments = 0;
        $grandTotalBalance = 0;
        $grandtotalOtherPayments = 0;
        //START GROUPING 

        // If both dates are provided
        $query0 = "SELECT result FROM (SELECT DISTINCT $key AS result FROM clientprofile cp INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid WHERE tsoa.date = :a 
        UNION 
        SELECT DISTINCT $key AS result FROM clientprofile cp INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN treatmentsubpayment tsp ON tsp.tsubid = tsub.tsubid WHERE (tsoa.date < :a) AND tsp.paymentDate = :a) AS combined_results ORDER BY  result";

        $stmt0 = $this->conn->prepare($query0);
        $stmt0->bindParam(':a', $fromdate);


        $stmt0->execute();

        if ($stmt0->rowCount() > 0) {
            while ($row0 = $stmt0->fetch(PDO::FETCH_ASSOC)) {
                $sortkey = $row0["result"];
                echo '<div class="row-"><h4>' . $group . ': ' . $sortkey . '</h4></div>';

                $dateToday = date("Y-m-d");

                // If both dates are provided
                $query = "SELECT tsoa.soaid, cp.clientid,tsoa.hmoaccredited,tsub.hmo, cp.lname, cp.fname, cp.mdname, tsoa.dentist,tsub.tsubid, tsub.treatment, tsub.price, tsoa.date 
                      FROM clientprofile cp 
                      INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid 
                      INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid 
                      WHERE (tsoa.date=:a) and $key = :c ";

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':a', $fromdate);
                $stmt->bindParam(':c', $sortkey);


                $stmt->execute();
                $total = 0;
                $AccumulatedPayments = 0;

                $totalOtherPayments = 0;
                echo '    <div class="table-responsive">
                                    <table class="table text-dark" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>SOA ID</th>
                                                <th>Full Name</th>
                                                <th>HMO</th>
                                                <th>Dentist</th>
                                                <th>Treatment</th>
                                                <th>Total Fee</th>
                                                <th>SOA Date</th>
                                                <th>Payment</th>
                                                 <th>Payment Type</th>
                                                  <th>Payment Date</th>
                                                  <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody id="resultResponsez">
                                     ';
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $total += $row["price"];
                        $fullname = $row["lname"] . ', ' . $row["fname"] . ' ' . $row["mdname"];
                        echo '
                <tr style="color: black;">
                <td>' . $row["soaid"] . '</td>

                <td>' . $fullname . '</td>';
                        $hmo = $row["hmo"];
                        $hmoDisplay = '';

                        if (empty($hmo)) {
                            $hmoDisplay = '-';
                        } else {
                            $hmoDisplay = $hmo;
                        }

                        echo '  <td>' . $hmoDisplay . '</td>';


                        echo '
                <td>' . $row["dentist"] . '</td>
                <td>' . $row["treatment"] . '</td>
                <td style="text-align:right;">' . number_format($row["price"], 2) . '</td>
               <td>' . date("Y/m/d", strtotime($row["date"])) . '</td>';
                        $tsubid = $row["tsubid"];
                        $query3 = "select * from treatmentsubpayment where tsubid=:a and paymentdate <= :b order by paymentdate asc";
                        $stmt3 = $this->conn->prepare($query3);
                        $stmt3->bindParam(':a', $tsubid);
                        $stmt3->bindParam(':b', $fromdate);
                        $totalPayments = 0;
                        $stmt3->execute();
                        echo '';
                        if ($stmt3->rowCount() > 0) {
                            //paymentamount

                            $paymentrow = 0;
                            echo '<td style="text-align:right;">';

                            $stmt4 = $this->conn->prepare($query3);
                            $stmt4->bindParam(':a', $tsubid);
                            $stmt4->bindParam(':b', $fromdate);
                            $stmt4->execute();
                            echo '';
                            if ($stmt4->rowCount() > 0) {

                                while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                    if ($paymentrow > 0) {
                                        echo '<br>';
                                    }


                                    $totalPayments = $totalPayments + $row4["amount"];
                                    echo number_format($row4["amount"], 2);
                                    $AccumulatedPayments += $row4["amount"];
                                    $paymentrow++;

                                }
                            }

                            echo '</td>';
                            //paymenttype
                            echo '<td style="text-align:center;">';
                            $paymentrow = 0;
                            $stmt5 = $this->conn->prepare($query3);
                            $stmt5->bindParam(':a', $tsubid);
                            $stmt5->bindParam(':b', $fromdate);
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
                            echo '<td style="text-align:right;">';
                            $paymentrow = 0;
                            $stmt6 = $this->conn->prepare($query3);
                            $stmt6->bindParam(':a', $tsubid);
                            $stmt6->bindParam(':b', $fromdate);
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
                        } else {
                            echo '<td style="text-align:right;">0.00</td>';
                            echo '<td style="text-align:center;">-</td>';
                            echo '<td style="text-align:right;">-</td>';

                        }

                        echo '<td style="text-align:right;">' . number_format(($row["price"] - $totalPayments), 2) . '</td>';
                        echo '

            </tr>';

                    }
                }

                //PAYMENT SOA NOT TODAY
                $query12 = "SELECT tsoa.soaid, cp.clientid,tsoa.hmoaccredited,tsub.hmo, cp.lname, cp.fname, cp.mdname, tsoa.dentist,tsub.tsubid, tsub.treatment, tsub.price, tsoa.date ,tsoa.dentist
                      FROM clientprofile cp INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN treatmentsubpayment tsp ON tsp.tsubid = tsub.tsubid WHERE (tsoa.date < :a) AND tsp.paymentDate = :a and $key = :c ";

                $stmt12 = $this->conn->prepare($query12);
                $stmt12->bindParam(':a', $fromdate);
                $stmt12->bindParam(':c', $sortkey);
                $stmt12->execute();
                if ($stmt12->rowCount() > 0) {
                    while ($row12 = $stmt12->fetch(PDO::FETCH_ASSOC)) {

                        $fullname = $row12["lname"] . ', ' . $row12["fname"] . ' ' . $row12["mdname"];
                        echo '
                <tr style="color: black;">
                <td>' . $row12["soaid"] . '</td>

                <td>' . $fullname . '</td>';
                        $hmo = $row12["hmo"];
                        $hmoDisplay = '';

                        if (empty($hmo)) {
                            $hmoDisplay = '-';
                        } else {
                            $hmoDisplay = $hmo;
                        }

                        echo '  <td>' . $hmoDisplay . '</td>';


                        echo '
                <td>' . $row12["dentist"] . '</td>
                <td>' . $row12["treatment"] . '</td>
                <td style="text-align:right;">-</td>
               <td>' . date("Y/m/d", strtotime($row12["date"])) . '</td>';
                        $tsubid = $row12["tsubid"];
                        $query13 = "select * from treatmentsubpayment where tsubid=:a and paymentDate=:b order by paymentdate asc";
                        $stmt13 = $this->conn->prepare($query13);
                        $stmt13->bindParam(':a', $tsubid);
                        $stmt13->bindParam(':b', $fromdate);
                        $totalPayments = 0;
                        $stmt13->execute();
                        echo '';
                        if ($stmt13->rowCount() > 0) {
                            //paymentamount

                            $paymentrow = 0;
                            echo '<td style="text-align:right;">';

                            $stmt14 = $this->conn->prepare($query13);
                            $stmt14->bindParam(':a', $tsubid);
                            $stmt14->bindParam(':b', $fromdate);
                            $stmt14->execute();
                            echo '';
                            if ($stmt14->rowCount() > 0) {

                                while ($row14 = $stmt14->fetch(PDO::FETCH_ASSOC)) {
                                    if ($paymentrow > 0) {
                                        echo '<br>';
                                    }


                                    $totalPayments = $totalPayments + $row14["amount"];
                                    echo number_format($row14["amount"], 2);
                                    $AccumulatedPayments += $row14["amount"];
                                    $totalOtherPayments += $row14["amount"];
                                    $grandtotalOtherPayments += $row14["amount"];
                                    $paymentrow++;

                                }
                            }

                            echo '</td>';
                            //paymenttype
                            echo '<td style="text-align:center;">';
                            $paymentrow = 0;
                            $stmt15 = $this->conn->prepare($query13);
                            $stmt15->bindParam(':a', $tsubid);
                            $stmt15->bindParam(':b', $fromdate);
                            $stmt15->execute();
                            echo '';
                            if ($stmt15->rowCount() > 0) {
                                while ($row15 = $stmt15->fetch(PDO::FETCH_ASSOC)) {
                                    if ($paymentrow > 0) {
                                        echo '<br>';
                                    }

                                    echo $row15["paymenttype"];


                                    $paymentrow++;
                                }
                            }
                            echo '</td>';

                            //paymentdate
                            echo '<td style="text-align:right;">';
                            $paymentrow = 0;
                            $stmt16 = $this->conn->prepare($query13);
                            $stmt16->bindParam(':a', $tsubid);
                            $stmt16->bindParam(':b', $fromdate);
                            $stmt16->execute();
                            echo '';
                            if ($stmt16->rowCount() > 0) {
                                while ($row16 = $stmt16->fetch(PDO::FETCH_ASSOC)) {

                                    if ($paymentrow > 0) {
                                        echo '<br>';
                                    }
                                    echo $row16["paymentdate"];


                                    $paymentrow++;
                                }
                            }
                            echo '</td>';
                        } else {
                            echo '<td style="text-align:right;">0.00</td>';
                            echo '<td style="text-align:center;">-</td>';
                            echo '<td style="text-align:right;">-</td>';

                        }

                        echo '<td style="text-align:right;">-</td>';
                        echo '

            </tr>';

                    }
                }
                //END PAYMENT SOA NOT TODAY


                echo '
<tr>
              
                <td colspan="5">Total </td>
                
                <td style="text-align:right;"><strong>' . number_format($total, 2) . '</strong></td>
                <td></td>
                <td style="text-align:right;"><strong>' . number_format($AccumulatedPayments, 2) . '</strong></td>  
                <td></td>      
                <td></td>
                <td style="text-align:right;"><strong>' . number_format(($total - ($AccumulatedPayments - $totalOtherPayments)), 2) . '</strong></td>
            </tr>
';
                $grandTotal += $total;
                $grandAccumulatedPayments += $AccumulatedPayments;
                $grandTotalBalance += ($total - $AccumulatedPayments);





                echo '   </tbody>
                                    </table>
                                </div>';
            }

        }

        //END GROUPING
        echo '
<div style="margin-top: 20px; padding: 15px; border: 1px solid #ccc; background-color: #f9f9f9; border-radius: 8px;">
    <h5 style="margin-bottom: 15px; text-align: center;"> <strong> Summary Report</strong></h5>
    
    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
        <span><strong>Grand Total:</strong></span>
        <span>₱' . number_format($grandTotal, 2) . '</span>
    </div>
     <strong>Mode of Payment:</strong>
   ';
        $query0 = "select DISTINCT(paymenttype) from treatmentsubpayment where paymentdate = :a";

        $stmt0 = $this->conn->prepare($query0);
        $stmt0->bindParam(':a', $fromdate);


        $stmt0->execute();

        if ($stmt0->rowCount() > 0) {
            while ($row0 = $stmt0->fetch(PDO::FETCH_ASSOC)) {
                $paymentType = $row0["paymenttype"];

                $query1 = "select sum(amount) as 'total' from treatmentsubpayment where paymentdate = :a and paymenttype = :b";

                $stmt1 = $this->conn->prepare($query1);
                $stmt1->bindParam(':a', $fromdate);
                $stmt1->bindParam(':b', $paymentType);


                $stmt1->execute();

                if ($stmt1->rowCount() > 0) {
                    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        echo '
  <div style="display: flex; justify-content: space-between;">
        <span><strong>' . $paymentType . ':</strong></span>
        <span>₱' . number_format($row1["total"], 2) . '</span>
    </div>
';
                    }
                }

            }
        }

        echo '
        <hr>
     <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
    
        <span><strong>Total Payments:</strong></span>
        <span>₱' . number_format($grandAccumulatedPayments, 2) . '</span>
    </div>
    <div style="display: flex; justify-content: space-between;">
        <span><strong>Outstanding Balance:</strong></span>
        <span>₱' . number_format($grandTotalBalance + $grandtotalOtherPayments, 2) . '</span>
    </div>
</div>
';
    }
}
