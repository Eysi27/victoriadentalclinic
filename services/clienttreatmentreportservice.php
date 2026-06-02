<?php
require_once('databaseService.php');
$service = new ServiceClass();
$fromdate = urldecode($_POST['from']);
$todate = urldecode($_POST['to']);
$group = urldecode($_POST['group']);
$dentist = urldecode($_POST['dentist']);
$result = $service->loadClientTreatment($fromdate, $todate, $group, $dentist);


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
    public function loadClientTreatment($fromdate, $todate, $group, $dentist)
    {

        $key = 'tsoa.soaid';
        if ($group == 'Dentist') {
            $key = 'dentist';
        } else if ($group == 'Treatment') {
            $key = 'tsub.treatment';
        }
        $grandTotal = 0;
        $grandAccumulatedPayments = 0;
        $grandTotalBalance = 0;
        $dateToday = date("Y-m-d");
        //GROUPING
        if ($dentist == 'All') {
            if (!empty($fromdate) && !empty($todate)) {
                // If both dates are provided
                $query0 = "SELECT DISTINCT $key as 'result' FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid WHERE (tsoa.date BETWEEN :a AND :b) order by  $key";
                $stmt0 = $this->conn->prepare($query0);
                $stmt0->bindParam(':a', $fromdate);
                $stmt0->bindParam(':b', $todate);

            } elseif (empty($fromdate) && !empty($todate)) {
                // If only todate is provided
                $query0 = "SELECT DISTINCT $key  as 'result' FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid  INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid WHERE (tsoa.date <= :b) order by  $key";
                $stmt0 = $this->conn->prepare($query0);
                $stmt0->bindParam(':b', $todate);

            } elseif (!empty($fromdate) && empty($todate)) {
                // If only todate is provided
                $query0 = "SELECT DISTINCT $key  as 'result' FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid  INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid WHERE tsoa.date >= :b order by  $key";

                $stmt0 = $this->conn->prepare($query0);
                $stmt0->bindParam(':b', $fromdate);

            } else {
                // No filtering if both dates are empty
                $query0 = "SELECT DISTINCT $key  as 'result' FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid order by  $key";

                $stmt0 = $this->conn->prepare($query0);
            }
        } else {
            if (!empty($fromdate) && !empty($todate)) {
                // If both dates are provided
                $query0 = "SELECT DISTINCT $key as 'result' FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid WHERE (tsoa.date BETWEEN :a AND :b) and dentist=:x order by  $key";
                $stmt0 = $this->conn->prepare($query0);
                $stmt0->bindParam(':a', $fromdate);
                $stmt0->bindParam(':b', $todate);

            } elseif (empty($fromdate) && !empty($todate)) {
                // If only todate is provided
                $query0 = "SELECT DISTINCT $key  as 'result' FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid  INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid WHERE (tsoa.date <= :b) and dentist=:x order by  $key";
                $stmt0 = $this->conn->prepare($query0);
                $stmt0->bindParam(':b', $todate);

            } elseif (!empty($fromdate) && empty($todate)) {
                // If only todate is provided
                $query0 = "SELECT DISTINCT $key  as 'result' FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid  INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid WHERE tsoa.date >= :b and dentist=:x order by  $key";

                $stmt0 = $this->conn->prepare($query0);
                $stmt0->bindParam(':b', $fromdate);

            } else {
                // No filtering if both dates are empty
                $query0 = "SELECT DISTINCT $key  as 'result' FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid where dentist=:x order by  $key";

                $stmt0 = $this->conn->prepare($query0);
            }
            $stmt0->bindParam(':x', $dentist);
        }
        $gcash = 0;
        $cash = 0;
        $creditcard = 0;
        $bankTransfer = 0;


        $stmt0->execute();
        if ($stmt0->rowCount() > 0) {
            while ($row0 = $stmt0->fetch(PDO::FETCH_ASSOC)) {

                $sortkey = $row0["result"];
                echo '<div class="row-"><h4>' . $group . ': ' . $sortkey . '</h4></div>';

                if ($dentist == 'All') {
                    if (!empty($fromdate) && !empty($todate)) {
                        // If both dates are provided
                        $query = "SELECT  cp.lname,cp.fname,cp.mdname,tsub.treatment, tsub.price,tsub.hmo, tsub.remarks, tsub.details, tsoa.date, tsub.tsubid,tsoa.time, tsoa.soaid, tsoa.dentist FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid WHERE (tsoa.date BETWEEN :a AND :b) and $key = :c";
                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':a', $fromdate);
                        $stmt->bindParam(':b', $todate);
                        $stmt->bindParam(':c', $sortkey);
                    } elseif (empty($fromdate) && !empty($todate)) {
                        // If only todate is provided
                        $query = "SELECT  cp.lname,cp.fname,cp.mdname,tsub.treatment, tsub.price,tsub.hmo, tsub.remarks, tsub.details, tsoa.date,tsub.tsubid, tsoa.time, tsoa.soaid, tsoa.dentist FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid WHERE (tsoa.date <= :b) and $key = :c";
                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':b', $todate);
                        $stmt->bindParam(':c', $sortkey);
                    } elseif (!empty($fromdate) && empty($todate)) {
                        // If only todate is provided
                        $query = "SELECT cp.lname,cp.fname,cp.mdname, tsub.treatment, tsub.price,tsub.hmo, tsub.remarks, tsub.details, tsoa.date, tsub.tsubid,tsoa.time, tsoa.soaid, tsoa.dentist FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid WHERE (tsoa.date  >= :b) and $key = :c";

                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':b', $fromdate);
                        $stmt->bindParam(':c', $sortkey);


                    } else {
                        // No filtering if both dates are empty
                        $query = "SELECT  cp.lname,cp.fname,cp.mdname,tsub.treatment, tsub.price,tsub.hmo, tsub.remarks, tsub.details, tsoa.date,tsub.tsubid, tsoa.time, tsoa.soaid, tsoa.dentist FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid where $key = :c";

                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':c', $sortkey);
                    }


                } else {
                    if (!empty($fromdate) && !empty($todate)) {
                        // If both dates are provided
                        $query = "SELECT  cp.lname,cp.fname,cp.mdname,tsub.treatment, tsub.price,tsub.hmo, tsub.remarks, tsub.details, tsoa.date, tsub.tsubid,tsoa.time, tsoa.soaid, tsoa.dentist FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid WHERE (tsoa.date BETWEEN :a AND :b) and $key = :c and dentist=:x";
                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':a', $fromdate);
                        $stmt->bindParam(':b', $todate);
                        $stmt->bindParam(':c', $sortkey);
                    } elseif (empty($fromdate) && !empty($todate)) {
                        // If only todate is provided
                        $query = "SELECT  cp.lname,cp.fname,cp.mdname,tsub.treatment, tsub.price,tsub.hmo, tsub.remarks, tsub.details, tsoa.date,tsub.tsubid, tsoa.time, tsoa.soaid, tsoa.dentist FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid WHERE (tsoa.date <= :b) and $key = :c and dentist=:x";
                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':b', $todate);
                        $stmt->bindParam(':c', $sortkey);
                    } elseif (!empty($fromdate) && empty($todate)) {
                        // If only todate is provided
                        $query = "SELECT  cp.lname,cp.fname,cp.mdname,tsub.treatment, tsub.price,tsub.hmo, tsub.remarks, tsub.details, tsoa.date, tsub.tsubid,tsoa.time, tsoa.soaid, tsoa.dentist FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid WHERE (tsoa.date  >= :b) and $key = :c and dentist=:x";

                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':b', $fromdate);
                        $stmt->bindParam(':c', $sortkey);


                    } else {
                        // No filtering if both dates are empty
                        $query = "SELECT  cp.lname,cp.fname,cp.mdname,tsub.treatment, tsub.price,tsub.hmo, tsub.remarks, tsub.details, tsoa.date,tsub.tsubid, tsoa.time, tsoa.soaid, tsoa.dentist FROM treatmentsub tsub INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid INNER JOIN clientprofile cp ON tsub.clientId=cp.clientid where $key = :c and dentist=:x";

                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':c', $sortkey);
                    }
                    $stmt->bindParam(':x', $dentist);
                }


                $stmt->execute();
                $total = 0;
                echo '
        <div class="table-responsive">
                                    <table class="table text-dark" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>SOA ID</th>
                                                  <th>Patient</th>
                                                <th>Dentist</th>
                                               
                                                <th>HMO</th>
                                                <th>Treatment</th>
                                                <th>Details</th>
                                                <th>Remarks</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Price</th>
                                                 <th>Payment</th>
                                                 <th>Payment Type</th>
                                                  <th>Payment Date</th>
                                                  <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody id="resultResponsez">
                                     
        ';
                $AccumulatedPayments = 0;
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $fullname = $row["lname"] . ', ' . $row["fname"] . ' ' . $row["mdname"];
                        $total += $row["price"];
                        echo '
                <tr style="color: black;">
                <td>' . $row["soaid"] . '</td>
                <td>' . $fullname . '</td>
                <td>' . $row["dentist"] . '</td>';
                        $hmo = $row["hmo"];
                        $hmoDisplay = '';

                        if (empty($hmo)) {
                            $hmoDisplay = '-';
                        } else {
                            $hmoDisplay = $hmo;
                        }


                        echo '  <td>' . $hmoDisplay . '</td>';


                        echo '
                <td>' . $row["treatment"] . '</td>
                <td>' . $row["details"] . '</td>
                <td>' . $row["remarks"] . '</td>
               <td>' . date("Y/m/d", strtotime($row["date"])) . '</td>
                
                <td>' . $row["time"] . '</td>
                <td style="text-align:right;">' . number_format($row["price"], 2) . '</td>

                ';
                        //PAYMENT

                        $tsubid = $row["tsubid"];
                        $query3 = "select * from treatmentsubpayment where tsubid=:a order by paymentdate asc";
                        $stmt3 = $this->conn->prepare($query3);
                        $stmt3->bindParam(':a', $tsubid);
                        $totalPayments = 0;
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


                                    if ($row4["paymenttype"] == 'GCash') {
                                        $gcash += $row4["amount"];
                                    } else if ($row4["paymenttype"] == 'Credit Card') {
                                        $creditcard += $row4["amount"];
                                    } else if ($row4["paymenttype"] == "Bank Transfer") {
                                        $bankTransfer += $row4["amount"];
                                    } else {
                                        $cash += $row4["amount"];
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
                        //END PAYMENT
                        echo '<td style="text-align:right;">' . number_format(($row["price"] - $totalPayments), 2) . '</td>';

                        echo '
                
            </tr>';
                    }
                }
                echo '
<tr>
              
                <td colspan="8">Total </td>
              
                <td style="text-align:right;"><strong>' . number_format($total, 2) . '</strong></td>
                    <td style="text-align:right;"><strong>' . number_format($AccumulatedPayments, 2) . '</strong></td>
                    <td colspan="3" style="text-align:right;"><strong>' . number_format(($total - $AccumulatedPayments), 2) . '</strong></td>
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
  
 <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
        <span><strong>Cash:</strong></span>
        <span>₱' . number_format($cash, 2) . '</span>
    </div>
    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
        <span><strong>GCash:</strong></span>
        <span>₱' . number_format($gcash, 2) . '</span>
    </div>
       <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
        <span><strong>Credit Card:</strong></span>
        <span>₱' . number_format($creditcard, 2) . '</span>
    </div>
          <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
        <span><strong>Bank Transfer:</strong></span>
        <span>₱' . number_format($bankTransfer, 2) . '</span>
    </div>

   <hr>
    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
        <span><strong>Total Payments:</strong></span>
        <span>₱' . number_format($grandAccumulatedPayments, 2) . '</span>
    </div>
    
    <div style="display: flex; justify-content: space-between;">
        <span><strong>Outstanding Balance:</strong></span>
        <span>₱' . number_format($grandTotalBalance, 2) . '</span>
    </div>
</div>
';



    }
}
