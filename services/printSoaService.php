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



            $query = "select a.*,(select concat(lname,', ',fname,' ',mdname) from clientprofile where clientid=a.clientid) as clientname from treatmentsoa a where a.soaid=:a";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $soaid);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '
           <div class="row align-items-center">
            <div class="col-lg-6 d-flex align-items-center" style="text-align:left;">
                    <img src="img/white_logo_final.jpg" alt="Company Logo" style="height: 40px; margin-right: 10px;">
                    <strong>Smiles & More</strong>
                </div>
                <div class="col-lg-6" style="text-align:right;">
                    Bringing you, your best smile!
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    Stall B Josefa St. Josefaville 1 Subd Brgy Malabanias Angeles City Pampanga PH 2009
                </div>
                <div class="col-lg-12">
                    0927-605-8418 / 0960-437-5938
                </div>
            </div>

                <hr>
                <div class="col-lg-12" style="text-align:center;"><strong>Electronic Statement of Account - ESOA</strong></div>
            </div>
            <hr>
            <!-- USE THIS SPACE FOR YOUR ADDITIONAL CODE SNIPPET --> 
            <div class="row">
                    <div class="col-md-6">
                    Dentist :<strong>' . $row["dentist"] . '</strong>
                           
                    </div>
                    <div class="col-md-6">
                            Date :<strong>' . date("m/d/Y", strtotime($row["date"])) . '</strong>
                           
                           
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                            Client Name: <strong>' . $row["clientname"] . '</strong>
                           
                           
                    </div>
                    <div class="col-md-6">
                    Time :<strong>' . $row["time"] . '</strong>
                           
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                            HMO Accredited : <strong>';

                    if ($row["hmoaccredited"] != "") {
                        echo $row["hmoaccredited"];
                    } else {
                        echo 'N/A';
                    }



                    echo '</strong></div>
                 

                </div>
       
            <div class="row">
                

                <div class="col-lg-12">
                <table class="table" width="100%" cellspacing="0" style="font-size:12px;">
<thead>
<tr>
<th width="20%">Treatment</th>
<th style="text-align:center;">Price</th>
<th style="text-align:center;">HMO</th>
<th style="text-align:center;">Payment</th>
<th style="text-align:center;">Payment Type</th>
<th style="text-align:center;">Payment Date</th>
<th style="text-align:center;">Balance</th>
</tr>
</thead>

<tbody id="treatmentList">
';
                    $query2 = "select * from treatmentsub where soaid=:a";
                    $stmt2 = $this->conn->prepare($query2);
                    $stmt2->bindParam(':a', $soaid);
                    $stmt2->execute();
                    $totalBalance = 0;
                    $totalPaymentSoa = 0;
                    if ($stmt2->rowCount() > 0) {
                        $total = 0;
                        $totalPayments = 0;
                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                            $total += $row2["price"];

                            echo '
                            <tr>
                            <td>' . $row2["treatment"] . '</td>
                           
                           
                            <td style="text-align:right;" >' . number_format($row2["price"], 2) . '</td>
                            <td style="text-align:center;">' . (!empty($row2["hmo"]) ? $row2["hmo"] : '-') . '</td>

                            ';

                            $tsubid = $row2["tsubid"];
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

                                if ($stmt4->rowCount() > 0) {

                                    while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                        if ($paymentrow > 0) {
                                            echo '<br>';
                                        }


                                        $totalPayments = $totalPayments + $row4["amount"];
                                        echo '<a href="#" class="underline-on-hover" style=" text-decoration: none;" onclick="deletePayment(\'' . $row4["tsubpayid"] . '\',\'' . $row4["amount"] . '\');" class="text-dark">' . number_format($row4["amount"], 2) . '</a>';

                                        $paymentrow++;

                                    }
                                }
                                $totalPaymentSoa += $totalPayments;
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

                                $remainingBalance = $row2["price"] - $totalPayments;
                                $totalBalance += $remainingBalance;
                                echo '
                              <td style="text-align:right;"> <a href="#" class="underline-on-hover"  onclick="showPaymentModal(' . $row2["tsubid"] . ',\'' . $row2["hmo"] . '\',' . $remainingBalance . ');">' . number_format($remainingBalance, 2) . '</a></td>
                            </tr>
                            
                            ';

                            } else {
                                if ($row2["price"] == 0) {
                                    echo '
                                    <td  style="text-align:right;">' . number_format(0, 2) . '</td>
                                    <td></td>
                                    <td></td>
                                    
                                   <td   style="text-align:right;"> <a href="#" class="underline-on-hover"  onclick="showPaymentModal(' . $row2["tsubid"] . ',\'' . $row2["hmo"] . '\',0);">' . number_format(0, 2) . '</a></td>';
                                } else {
                                    echo '<td colspan="3" style="text-align:center;" >No Payment Yet</td>
                                     <td style="text-align:right;"> <a href="#" class="underline-on-hover"  onclick="showPaymentModal(' . $row2["tsubid"] . ',\'' . $row2["hmo"] . '\',' . $row2["price"] . ');">' . number_format($row2["price"], 2) . '</a></td>
                                    ';
                                }
                            }







                        }
                        echo '
                                            <strong>
                                            <tr>
                                            <td colspan="1">Total</td>
                                            <td style="text-align:right;">' . number_format($row["total"], 2) . '</td>
                                            <td></td>
                                              <td style="text-align:right;">' . number_format($totalPaymentSoa, 2) . '</td>
                                                <td></td>
                                                  <td></td>
                                                    <td style="text-align:right;">' . number_format($row["total"] - $totalPaymentSoa, 2) . '</td>
                                            </tr>
                                            </strong>
                                            ';
                    }


                    echo '

</tbody>
</table>
<hr>
<strong>Agreement:</strong>
';
                    echo !empty($row["agreement"])
                        ? '<br><p style="text-align: justify; text-indent: 2em;">' . nl2br($row["agreement"]) . '</p>'
                        : 'N/A';


                    echo '
<hr>
<strong>Patient Consent and Acknowledgment</strong><br>
<p style=" text-align: justify; text-indent: 2em;">I hereby acknowledge that the dentist has explained to me the nature of the dental procedure(s), including the potential risks, benefits, and alternative treatment options. I confirm that I have had the opportunity to ask questions and that all my concerns have been addressed to my satisfaction. By signing below, I voluntarily consent to the proposed treatment and authorize the dentist to proceed as discussed.</p>
<br><br>
';

                    if ($row && !empty($row['signature'])) {
                        $imageData = base64_encode($row['signature']);
                        $imageType = "png"; // Or "png" depending on what your DB stores
                        $img = "data:image/{$imageType};base64,{$imageData}";

                        echo '
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Patient’s/Guardian’s Signature</label>
                                    <div class="border rounded p-3 signature-box"
                                        style="height: 80px; cursor: pointer;" 
                                        id="patient-signature-box">
                                    <img src="' . $img . '" alt="Patient signature" style="width: 100%; height: 100%; object-fit: contain;">

                                                
                                        
                                    </div>
                                    <input type="hidden" name="patient_signature" id="patient-signature-input" value="' . $img . '" onchange="changeSignature()">
                                </div>
                                <div class="col-sm-6">
                                    <label for="dateSigned" id="dateSigned">Date Signed: <u>_____' . $row["dateSigned"] . '_______</u></label>
                                    
                                </div>
                            </div>

                        ';

                    } else {
                        echo '
                         <div class="row">
                                <div class="col-sm-6">
                                    <label>Patient’s/Guardian’s Signature</label>
                                    <div class="border rounded p-3 signature-box"
                                        style="height: 80px; cursor: pointer;" 
                                        id="patient-signature-box">
                                   
                                                
                                        
                                    </div>
                                    <input type="hidden" name="patient_signature" id="patient-signature-input" value="" onchange="changeSignature()">
                                </div>
                                <div class="col-sm-6">
                                    <label for="dateSigned" id="dateSigned">Date Signed: <u>________________________</u></label>
                                    
                                </div>
                            </div>
                        
                        ';

                    }



                    echo '



            </div>
            <hr>
                
                
                
                
                
                
                ';
                }
            }
        } catch (Exception $e) {
            return "Error:" . $e->getMessage();
        }
    }
    //UNTIL THIS CODE

}
//UNTIL HERE COPY
