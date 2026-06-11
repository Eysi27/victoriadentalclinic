<?php
require_once('databaseService.php');
$service = new ServiceClass();
$result = $service->loadClientProfile();

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
    public function loadClientProfile()
    {



        $query = "SELECT * FROM clientprofile WHERE status != 'Deleted' OR status IS NULL";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $dob = new DateTime($row["birthDate"]); // assuming dob is something like '1990-04-15'
                $today = new DateTime();
                $age = $today->diff($dob)->y;
                $fullname = $row["lname"] . ', ' . $row["fname"] . ' ' . $row["mdname"];
                echo '
                <tr>
                <td>' . ucfirst(strtolower($fullname)) . '</td>
                <td>' . ucfirst(strtolower($row["nickname"])) . '</td>
                <td>' . $age . '</td>
                <td>' . ucfirst(strtolower($row["sex"])) . '</td>
        
                <td>' . $row["mobileNumber"] . '</td>
               
               
                <td>' . $row["hmo"] . '</td>
     
               
                <td align="center">';

                //medhistory checker

                $query2 = "select * from medhistory where clientid=:a";
                $stmt2 = $this->conn->prepare($query2);
                $stmt2->bindParam(':a', $row["clientid"]);
                $stmt2->execute();
                if ($stmt2->rowCount() > 0) {

                    echo '
                       <a href="medHistoryView.php?clientid=' . $row["clientid"] . '&clientname=' . $fullname . '" title="View Medical History"  class="btn btn-primary  btn-circle"><i class="fas fa-history"></i></a>
                       ';

                } else {
                    echo ' <a href="medHistory.php?clientid=' . $row["clientid"] . '&clientname=' . $fullname . '" title="Add Medical History" class="btn btn-success btn-circle"><i class="fas fa-history"></i></a>
                    ';

                }


                echo '
                <a href="updateClient.php?civilStatus=' . $row["civilstatus"] . '&company=' . $row["company"] . '&cardNumber=' . $row["cardnumber"] . '&hmo=' . $row["hmo"] . '&religion=' . $row["religion"] . '&clientid=' . $row["clientid"] . '&lname=' . $row["lname"] . '&fname=' . $row["fname"] . '&mname=' . $row["mdname"] . '&nick=' . $row["nickname"] . '&age=' . $row["age"] . '&sex=' . $row["sex"] . '&occupation=' . $row["occupation"] . '
                &birthDate=' . $row["birthDate"] . '&mobileNumber=' . $row["mobileNumber"] . '&homeAddress=' . $row["homeAddress"] . '
                &guardianName=' . $row["guardianName"] . '&gOccupation=' . $row["gOccupation"] . '&refferedBy=' . $row["refferedBy"] . '
                " class="btn btn-warning btn-circle" title="Update Client Profile"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-circle" onclick="deleteClient(\'' . $row["clientid"] . '\')" title="Delete Client Profile"><i class="fas fa-trash"></i></a>
                

                ';
                //View Photo
// $imgBase64 = base64_encode($row["photo"]);
//                 if ($row["photo"] != null) {
//                     echo '<a href="#" class="btn btn-primary btn-circle" 
//    data-toggle="modal" 
//    data-target="#ViewModal" 
//    data-img="data:image/jpeg;base64,' . $imgBase64 . '" 
//    onclick="showProfilePhoto(this)" 
//    title="View Client Profile">
//    <i class="fas fa-eye"></i>
// </a>';
//                }

                echo '
                <a href="addConsent.php?civilStatus=' . $row["civilstatus"] . '&company=' . $row["company"] . '&cardNumber=' . $row["cardnumber"] . '&hmo=' . $row["hmo"] . '&religion=' . $row["religion"] . '&clientid=' . $row["clientid"] . '&lname=' . $row["lname"] . '&fname=' . $row["fname"] . '&mname=' . $row["mdname"] . '&nick=' . $row["nickname"] . '&age=' . $row["age"] . '&sex=' . $row["sex"] . '&occupation=' . $row["occupation"] . '
                &birthDate=' . $row["birthDate"] . '&mobileNumber=' . $row["mobileNumber"] . '&homeAddress=' . $row["homeAddress"] . '
                &guardianName=' . $row["guardianName"] . '&gOccupation=' . $row["gOccupation"] . '&refferedBy=' . $row["refferedBy"] . '
                " class="btn btn-secondary btn-circle" title="Add Client Consent"><i class="fas fa-file"></i></a>
                <a href="addTreatmentHistory.php?company=' . $row["company"] . '&cardnumber=' . $row["cardnumber"] . '&hmo=' . $row["hmo"] . '&clientid=' . $row["clientid"] . '&birthDate=' . $row["birthDate"] . '&clientname=' . $fullname . '&age=' . $row["age"] . '&address=' . $row["homeAddress"] . '"
                 class="btn btn-warning btn-circle" title="Add Treatment"><i class="fas fa-plus"></i></a>
                 
    
                 <a href="patientChartList.php?id=' . $row["clientid"] . '&clientname=' . $fullname . '"
                 class="btn btn-success btn-circle" title="View Patient Chart"><i class="fas fa-chart-bar"></i></a>

                ';
                echo '
                
                
                </td>
            </tr>';
            }

        }
    }

}







?>