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
                <div class="row">
                <div class="col-lg-6"><strong>SSmiles And More</strong></div>
                <div class="col-lg-6" style="text-align:right;">Bringing you, your best smile!</div>
            </div>
            <div class="row">
                <div class="col-lg-12">2/F Mondo Bambini Commercial Strip Bldg.,
                                    Brgy. Zapote, Binan City, Laguna</div>
                <div class="col-lg-12">Contact us: 0919-009-3099</div>
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
                            Date :<strong>' . $row["date"] . '</strong>
                           
                           
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
<th>Treatment</th>
<th>Remarks</th>
<th>Price</th>

</tr>
</thead>

<tbody id="treatmentList">
';
                    $query2 = "select * from treatmentsub where soaid=:a";
                    $stmt2 = $this->conn->prepare($query2);
                    $stmt2->bindParam(':a', $soaid);
                    $stmt2->execute();

                    if ($stmt2->rowCount() > 0) {
                        $total = 0;
                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                            $total += $row2["price"];
                            echo '
                            <tr>
                            <td onclick="createTicket(\'' . $row2["tsubid"] . '\',\'' . $row2["treatment"] . '\',\'treatment\',\'treatmentsub\',\'tsubid\');" style="white-space: nowrap; width: 1%;">' . $row2["treatment"] . '</td>
                           
                            <td onclick="createTicket(\'' . $row2["tsubid"] . '\',\'' . $row2["remarks"] . '\',\'remarks\',\'treatmentsub\',\'tsubid\');">' . $row2["remarks"] . '</td>
                            <td onclick="createTicket(\'' . $row2["tsubid"] . '\',\'' . $row2["price"] . '\',\'price\',\'treatmentsub\',\'tsubid\');">' . $row2["price"] . '</td>
                            </tr>
                            
                            ';
                        }
                        echo '
                                            <strong>
                                            <tr>
                                            <td colspan="2">Total</td>
                                            <td onclick="createTicket(\'' . $soaid . '\',\'' . $row["total"] . '\',\'total\',\'treatmentsoa\',\'soaid\');">' . $row["total"] . '</td>
                                            
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
                    echo !empty($row["agreement"]) ? '<br>' . $row["agreement"] : 'N/A';

                    echo '
<hr>
<strong>Patient Consent and Acknowledgment</strong><br>
I hereby acknowledge that the dentist has explained to me the nature of the dental procedure(s), including the potential risks, benefits, and alternative treatment options. I confirm that I have had the opportunity to ask questions and that all my concerns have been addressed to my satisfaction.
By signing below, I voluntarily consent to the proposed treatment and authorize the dentist to proceed as discussed.
<br><br>
';

                    if ($row && !empty($row['signature'])) {
                        $imageData = base64_encode($row['signature']);
                        $imageType = "png"; // Or "png" depending on what your DB stores
                        $img = "data:image/{$imageType};base64,{$imageData}";

                        echo '
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Patient Signature</label>
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
                                    <label>Patient Signature</label>
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
