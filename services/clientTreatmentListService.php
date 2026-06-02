<?php
require_once('databaseService.php');
$service = new ServiceClass();
$result = $service->loadClientTreatment();

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
    public function loadClientTreatment()
    {



        $query = "select a.*,IfNull((select b.date from treatmentsoa b where b.clientid=a.clientid order by date desc limit 1),'-') as 'latest'  from clientprofile a";
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
               
                <td>' . $fullname . '</td>
                <td>' . $row["nickname"] . '</td>
                <td>' . $age . '</td>
                <td>' . $row["sex"] . '</td>
                <td>' . $row["latest"] . '</td>
               
                <td>';



                echo '
                <a href="addTreatmentHistory.php?company=' . $row["company"] . '&cardnumber=' . $row["cardnumber"] . '&hmo=' . $row["hmo"] . '&clientid=' . $row["clientid"] . '&birthDate=' . $row["birthDate"] . '&clientname=' . $fullname . '&age=' . $row["age"] . '&address=' . $row["homeAddress"] . '"
                 class="btn btn-warning btn-circle" title="Add Treatment History - SOA"><i class="fas fa-plus"></i></a>
                <a class="btn btn-success btn-circle" href="soaList.php?clientid=' . $row["clientid"] . '&name=' . $fullname . '" title="View SOA"><i class="fas fa-eye"></i></a>
                
                
                </td>
            </tr>';
            }
        }
    }
}
