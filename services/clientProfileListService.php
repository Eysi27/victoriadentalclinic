<?php
session_start();
require_once('databaseService.php');
$service = new ServiceClass();

$search = urldecode($_POST['search']);
$searchParam = '%' . $search . '%';
$page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
$itemPerPage = isset($_POST['item']) ? (int) $_POST['item'] : 10;
$result = $service->process($searchParam, $page, $itemPerPage);

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
    public function process($search, $page, $itemPerPage)
    {
        $superuser = "nikesarmiento";

        $offset = ($page - 1) * $itemPerPage;  // Calculate the offset for pagination

        $searchFields = ['hmo', 'nickname', 'sex', 'mobilenumber', "CONCAT(lname, ', ', fname, ' ', mdname)"];
        $dynamics = '';

        if (!empty($search)) {
            $orConditions = [];
            foreach ($searchFields as $field) {
                $orConditions[] = "$field LIKE :search";
            }
            $dynamics = 'AND (' . implode(' OR ', $orConditions) . ')';
        }

        $dynamics .= 'ORDER BY CONCAT(lname, \', \', fname, \' \', mdname) ASC LIMIT :limit OFFSET :offset';
        // Using prepared statements for query to avoid SQL injection
        $query = "SELECT * FROM clientprofile a WHERE (status != 'Deleted' OR status IS NULL) $dynamics ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $itemPerPage, PDO::PARAM_INT);  // Ensure itemPerPage is treated as an integer
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);  // Ensure offset is treated as an integer
        $stmt->execute();
        if ($stmt->rowCount() > 0) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $dob = new DateTime($row["birthDate"]); // assuming dob is something like '1990-04-15'
                $today = new DateTime();
                $age = $today->diff($dob)->y;
                $fullname = $row["lname"] . ', ' . $row["fname"] . ' ' . $row["mdname"];
                echo '
                <tr style="color: black;">
                <td>' . ucwords(strtolower($fullname)) . '</td>
                <td>' . ucwords(strtolower($row["homeAddress"])) . '</td>
                <td>' . $age . '</td>
                <td>' . ucwords(strtolower($row["sex"])) . '</td>
        
                <td>' . $row["mobileNumber"] . '</td>
               
               
                <td>' . ucwords($row["emailAddress"]) . '</td>
     
               
                <td align="center">
                 <a href="updateClient.php?civilStatus=' . $row["civilstatus"] . '&company=' . $row["company"] . '&cardNumber=' . $row["cardnumber"] . '&hmo=' . $row["hmo"] . '&religion=' . $row["religion"] . '&clientid=' . $row["clientid"] . '&lname=' . $row["lname"] . '&fname=' . $row["fname"] . '&mname=' . $row["mdname"] . '&nick=' . $row["nickname"] . '&age=' . $age . '&sex=' . $row["sex"] . '&occupation=' . $row["occupation"] . '&birthDate=' . $row["birthDate"] . '&mobileNumber=' . $row["mobileNumber"] . '&homeAddress=' . $row["homeAddress"] . '&guardianName=' . $row["guardianName"] . '&gOccupation=' . $row["gOccupation"] . '&refferedBy=' . $row["refferedBy"] . '&emailAddress=' . $row["emailAddress"] . '
                " class="btn btn-warning btn-circle" title="Update Client Profile"><i class="fas fa-edit"></i></a>';

                //medhistory checker

                // $query2 = "select * from medhistory where clientid=:a";
                // $stmt2 = $this->conn->prepare($query2);
                // $stmt2->bindParam(':a', $row["clientid"]);
                // $stmt2->execute();
                // if ($stmt2->rowCount() > 0) {

                echo '
                       <a href="medHistoryView.php?clientid=' . $row["clientid"] . '&clientname=' . $fullname . '" title="View Medical History"  class="btn btn-secondary  btn-circle"><i class="fas fa-history"></i></a>
                ';

                $query2 = "select b.*,concat(b.lname,', ',b.fname, ' ', b.mdname) as fullname,a.id,a.dentist,a.date from consent a inner join clientprofile b on a.clientid=b.clientid where a.status='Active' and a.clientid=:a order by a.id desc limit 1";
                $stmt2 = $this->conn->prepare($query2);
                $stmt2->bindParam(':a', $row["clientid"]);
                $stmt2->execute();
                if ($stmt2->rowCount() > 0) {

                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        echo '<a href="viewConsent.php?dentist=' . $row2["dentist"] . '&date=' . $row2["date"] . '&consentid=' . $row2["id"] . '&civilStatus=' . $row2["civilstatus"] . '&company=' . $row2["company"] . '&cardNumber=' . $row2["cardnumber"] . '&hmo=' . $row2["hmo"] . '&religion=' . $row2["religion"] . '&clientid=' . $row["clientid"] . '&lname=' . $row["lname"] . '&fname=' . $row2["fname"] . '&mname=' . $row2["mdname"] . '&nick=' . $row2["nickname"] . '&age=' . $row2["age"] . '&sex=' . $row["sex"] . '&occupation=' . $row["occupation"] . '&birthDate=' . $row2["birthDate"] . '&mobileNumber=' . $row2["mobileNumber"] . '&homeAddress=' . $row2["homeAddress"] . '&guardianName=' . $row2["guardianName"] . '&gOccupation=' . $row2["gOccupation"] . '&refferedBy=' . $row2["refferedBy"] . '" class="btn btn-primary btn-circle" title="View Client Consent"><i class="fas fa-file"></i></a>
                        ';
                    }

                }

                $query2 = "select clientId from orthowaiver where clientid=:a limit 1";
                $stmt2 = $this->conn->prepare($query2);
                $stmt2->bindParam(':a', $row["clientid"]);
                $stmt2->execute();
                if ($stmt2->rowCount() > 0) {

                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        echo '<a href="viewOrthoWaiver.php?clientId=' . $row2["clientId"] . '" class="btn bg-purple btn-circle" title="View Orthodontics Waiver"><i class="fas fa-sign"></i></a>
                        ';
                    }

                }
                if ($_SESSION["account_type"] != 200) {
                    echo ' <a href="addTreatmentHistory.php?company=' . $row["company"] . '&cardnumber=' . $row["cardnumber"] . '&hmo=' . $row["hmo"] . '&clientid=' . $row["clientid"] . '&birthDate=' . $row["birthDate"] . '&clientname=' . $fullname . '&age=' . $age . '&address=' . $row["homeAddress"] . '" class="btn btn-warning btn-circle" title="Add Treatment"target="_blank" rel="noopener noreferrer"><i class="fas fa-plus"></i></a>';

                }


                echo '
               


                  <a href="patientChartList.php?id=' . $row["clientid"] . '&clientname=' . $fullname . '"
                 class="btn btn-success btn-circle" title="View Patient Chart"><i class="fas fa-chart-bar"></i></a>

                      
                       ';

                // } else {
                //     echo ' <a href="medHistory.php?clientid=' . $row["clientid"] . '&clientname=' . $fullname . '" title="Add Medical History" class="btn btn-success btn-circle"><i class="fas fa-history"></i></a>
                //     ';

                // }

                if ($_SESSION["username"] == $superuser) {
                    echo '
               
                    <a href="#" class="btn btn-danger btn-circle" onclick="deleteClient(\'' . $row["clientid"] . '\')" title="Delete Client Profile"><i class="fas fa-trash"></i></a>
                    
    
                    ';
                }




                echo '
                
                
                </td>
            </tr>';
            }

        }
    }

}







?>