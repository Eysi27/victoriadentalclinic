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
                <div class="col-lg-6"><strong>KBF Dental Care Clinic</strong></div>
                <div class="col-lg-6" style="text-align:right;">Bringing you, your best smile!</div>
            </div>
            <div class="row">
                <div class="col-lg-12">Stall B Josefa St. Josefaville 1 Subd Brgy Malabanias
                                        Angeles City Pampanga PH 2009</div>
                <div class="col-lg-12">0927-605-8418 / 0960-437-5938</div>
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
          <hr>
            <div class="row">
                

                <div class="col-lg-12">
                <table class="table text-dark" width="100%" cellspacing="0" style="font-size:12px;">
<thead>
<tr style="color: black;">
<th>Treatment</th>
<th>Details</th>
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
        <tr style="color: black;">
        <td>' . $row2["treatment"] . '</td>
        <td>' . $row2["details"] . '</td>
        <td>' . $row2["remarks"] . '</td>
        <td>' . $row2["price"] . '</td>
        </tr>
        
        ';
                        }
                        echo '
                        <strong>
                        <tr style="color: black;">
                        <td colspan="3">Total</td>
                        <td>' . $total . '</td>
                        
                        </tr>
                        </strong>
                        ';
                    }


                    echo '

</tbody>
</table>

                </div>
                
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
