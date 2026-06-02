<?php
require_once('databaseService.php');
$service = new ServiceClass();
$fromdate = urldecode($_POST['from']);
$todate = urldecode($_POST['to']);
$group = urldecode($_POST['group']);

$result = $service->loadClientTreatment($fromdate, $todate, $group);

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
    public function loadClientTreatment($fromdate, $todate, $group)
    {
        $key = 'tsubpay.paymenttype';
        if ($group == 'Dentist') {
            $key = 'tsoa.dentist';
        } else if ($group == 'Patient') {
            $key = 'concat (cp.lname, ", ", cp.fname, " ", cp.mdname)';
        }

        $grandAccumulatedPayments = 0;
        $grandSubcharge = 0;
        $grandccpayment = 0;

        //MAIN
        $dateToday = date("Y-m-d");
        if (!empty($fromdate) && !empty($todate)) {
            // If both dates are provided
            $query0 = "SELECT DISTINCT $key as 'result' FROM clientprofile cp 
                      INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid 
                      INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid
                      INNER JOIN treatmentsubpayment tsubpay ON tsubpay.tsubid = tsub.tsubid
                      WHERE (tsubpay.paymentdate BETWEEN :a AND :b) order by  $key";

            $stmt0 = $this->conn->prepare($query0);
            $stmt0->bindParam(':a', $fromdate);
            $stmt0->bindParam(':b', $todate);

        } elseif (empty($fromdate) && !empty($todate)) {
            // If only todate is provided
            $query0 = "SELECT DISTINCT $key as 'result' FROM clientprofile cp 
                      INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid 
                      INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid
                      INNER JOIN treatmentsubpayment tsubpay ON tsubpay.tsubid = tsub.tsubid
                      WHERE (tsubpay.paymentdate <= :b) order by  $key";

            $stmt0 = $this->conn->prepare($query0);
            $stmt0->bindParam(':b', $todate);

        } elseif (!empty($fromdate) && empty($todate)) {
            // If only todate is provided
            $query0 = "SELECT DISTINCT $key  as 'result' FROM clientprofile cp 
                      INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid 
                      INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid
                      INNER JOIN treatmentsubpayment tsubpay ON tsubpay.tsubid = tsub.tsubid
                      WHERE tsubpay.paymentdate >= :b order by  $key";

            $stmt0 = $this->conn->prepare($query0);
            $stmt0->bindParam(':b', $fromdate);



        } else {
            // No filtering if both dates are empty
            $query0 = "SELECT DISTINCT $key  as 'result' FROM clientprofile cp 
                      INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid 
                      INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid
                      INNER JOIN treatmentsubpayment tsubpay ON tsubpay.tsubid = tsub.tsubid
                     ";

            $stmt0 = $this->conn->prepare($query0);
        }


        $stmt0->execute();
        $paymentType = '';
        $totalIncome = 0;


        if ($stmt0->rowCount() > 0) {
            while ($row0 = $stmt0->fetch(PDO::FETCH_ASSOC)) {
                $ccpayment = 0;
                $sortkey = $row0["result"];
                echo '<div class="row-"><h4>' . $group . ': ' . $sortkey . '</h4></div>';

                if (!empty($fromdate) && !empty($todate)) {
                    // If both dates are provided
                    $query = "SELECT tsoa.soaid, cp.clientid,tsub.hmo, cp.lname, cp.fname, cp.mdname, tsoa.dentist, tsub.treatment, tsubpay.amount, tsubpay.paymentdate, tsubpay.paymenttype 
                      FROM clientprofile cp 
                      INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid 
                      INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid
                      INNER JOIN treatmentsubpayment tsubpay ON tsubpay.tsubid = tsub.tsubid
                      WHERE (tsubpay.paymentdate BETWEEN :a AND :b) and $key = :c";

                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':a', $fromdate);
                    $stmt->bindParam(':b', $todate);
                    $stmt->bindParam(':c', $sortkey);

                } elseif (empty($fromdate) && !empty($todate)) {
                    // If only todate is provided
                    $query = "SELECT tsoa.soaid, cp.clientid,tsub.hmo, cp.lname, cp.fname, cp.mdname, tsoa.dentist, tsub.treatment, tsubpay.amount, tsubpay.paymentdate, tsubpay.paymenttype 
                      FROM clientprofile cp 
                      INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid 
                      INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid
                      INNER JOIN treatmentsubpayment tsubpay ON tsubpay.tsubid = tsub.tsubid
                      WHERE (tsubpay.paymentdate <= :b) and $key = :c";

                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':b', $todate);
                    $stmt->bindParam(':c', $sortkey);

                } elseif (!empty($fromdate) && empty($todate)) {
                    // If only todate is provided
                    $query = "SELECT tsoa.soaid, cp.clientid,tsub.hmo, cp.lname, cp.fname, cp.mdname, tsoa.dentist, tsub.treatment, tsubpay.amount, tsubpay.paymentdate, tsubpay.paymenttype 
                      FROM clientprofile cp 
                      INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid 
                      INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid
                      INNER JOIN treatmentsubpayment tsubpay ON tsubpay.tsubid = tsub.tsubid
                      WHERE (tsubpay.paymentdate >= :b) and $key = :c";

                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':b', $fromdate);
                    $stmt->bindParam(':c', $sortkey);



                } else {
                    // No filtering if both dates are empty
                    $query = "SELECT tsoa.soaid, cp.clientid,tsub.hmo, cp.lname, cp.fname, cp.mdname, tsoa.dentist, tsub.treatment, tsubpay.amount, tsubpay.paymentdate, tsubpay.paymenttype 
                      FROM clientprofile cp 
                      INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid 
                      INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid
                      INNER JOIN treatmentsubpayment tsubpay ON tsubpay.tsubid = tsub.tsubid where $key = :c
                     ";

                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':c', $sortkey);
                }


                $stmt->execute();
                $total = 0;

                echo '
        
           <div class="table-responsive">
                                    <table class="table text-dark" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>SOA ID</th>
                                                <th>Full Name</th>
                                                <th>HMO</th>
                                                <th>Dentist</th>
                                                <th>Treatment</th>
                                                <th>Payment</th>
                                                <th>PaymentType</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="resultResponsez">
                                      ';
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $total += $row["amount"];
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
                <td style="text-align:right;">' . number_format($row["amount"], 2) . '</td>
                <td>' . $row["paymenttype"] . '</td>
               <td>' . date("Y/m/d", strtotime($row["paymentdate"])) . '</td>
            </tr>';

                        if ($row["paymenttype"] == "Credit Card") {
                            $ccpayment += $row["amount"];
                            $grandccpayment += $row["amount"];
                        }
                    }
                }
                echo '
<tr style="background-color: #f9f9f9">
              
                <td colspan="5"><strong>Gross Income: </strong></td>
                
                <td style="text-align:right;"><strong>' . number_format($total, 2) . '</strong></td>
                <td colspan="2"></td>      
            </tr>
';

                $ccsubcharge = $ccpayment * .04;
                echo '
<tr style="background-color: #f9f9f9">
              
                <td colspan="5" style="border: none;"><strong>Subcharge (CC)):</strong></td>
                
                <td style="text-align:right;border:none;"><strong>' . number_format($ccsubcharge, 2) . '</strong></td>
                <td colspan="2" style="border: none;"></td>      
            </tr>
';


                echo '
<tr style="background-color: #f9f9f9">
              
                <td colspan="5"><strong>Net Income :</strong></td>
                
                <td style="text-align:right;"><strong>' . number_format($total - $ccsubcharge, 2) . '</strong></td>
                <td colspan="2"></td>      
            </tr>
';

                $grandAccumulatedPayments += $total;
                $grandSubcharge += $ccsubcharge;


                echo '  </tbody>
                                    </table>
                                </div> <hr>';
                $totalIncome += $total;
            }

        }

        echo '
<div style="margin-top: 20px; padding: 15px; border: 1px solid #ccc; background-color: #f9f9f9; border-radius: 8px;">
    <h5 style="margin-bottom: 15px; text-align: center;"> <strong> Summary Report</strong></h5>
    
    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
        <span><strong>Total Gross Income:</strong></span>
        <span>₱' . number_format($grandAccumulatedPayments, 2) . '</span>
    </div>
    
        <hr>
     <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
    
        <span><strong>Total Credit Card Payments:</strong></span>
        <span>₱' . number_format($grandccpayment, 2) . '</span>
    </div>
      <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
    
        <span><strong>Total Subcharge (CC):</strong></span>
        <span>₱' . number_format($grandSubcharge, 2) . '</span>
    </div>
    <hr>
        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
    
        <span><strong>Total Net Income:</strong></span>
        <span>₱' . number_format($grandAccumulatedPayments - $grandSubcharge, 2) . '</span>
    </div>
   
</div>
';

        //ENDMAIN



    }
}
