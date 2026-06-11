<?php
require_once('databaseService.php');
$service = new ServiceClass();
$result = $service->loadTreatmentList();

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
    public function loadTreatmentList()
    {



        $query = "select b.*,concat(b.lname,', ',b.fname, ' ', b.mdname) as fullname,a.id,a.dentist,a.date from consent a inner join clientprofile b on a.clientid=b.clientid where a.status='Active'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                echo '
                <tr>
                <td>' . $row["fullname"] . '</td>
                <td>' . $row["dentist"] . '</td>
                <td>' . $row["date"] . '</td>
               
                <td align="center">
                
                ';
                echo '
                <a href="viewConsent.php?dentist=' . $row["dentist"] . '&date=' . $row["date"] . '&consentid=' . $row["id"] . '&civilStatus=' . $row["civilstatus"] . '&company=' . $row["company"] . '&cardNumber=' . $row["cardnumber"] . '&hmo=' . $row["hmo"] . '&religion=' . $row["religion"] . '&clientid=' . $row["clientid"] . '&lname=' . $row["lname"] . '&fname=' . $row["fname"] . '&mname=' . $row["mdname"] . '&nick=' . $row["nickname"] . '&age=' . $row["age"] . '&sex=' . $row["sex"] . '&occupation=' . $row["occupation"] . '
                &birthDate=' . $row["birthDate"] . '&mobileNumber=' . $row["mobileNumber"] . '&homeAddress=' . $row["homeAddress"] . '
                &guardianName=' . $row["guardianName"] . '&gOccupation=' . $row["gOccupation"] . '&refferedBy=' . $row["refferedBy"] . '
                " class="btn btn-secondary btn-circle" title="View Client Consent"><i class="fas fa-eye"></i></a>
                ';
                echo '
                
                </td>
            </tr>';
            }

        }
    }

}







?>