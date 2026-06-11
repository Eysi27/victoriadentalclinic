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


        $dateToday = date("Y-m-d");

        $query = "SELECT tsoa.soaid, cp.clientid, cp.lname, cp.fname, cp.mdname, tsoa.dentist, tsub.treatment, tsub.price, tsoa.date FROM clientprofile cp INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid ";


        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $fullname = $row["lname"] . ', ' . $row["fname"] . ' ' . $row["mdname"];
                echo '
                <tr>
                <td>' . $row["soaid"] . '</td>

                <td>' . $fullname . '</td>
                <td>' . $row["dentist"] . '</td>
                <td>' . $row["treatment"] . '</td>
                <td>' . $row["price"] . '</td>
                <td>' . $row["date"] . '</td>
                <td align="center">';



                echo '
                
                <a class="btn btn-success btn-circle" href="soaViewing.php?soaid=' . $row["soaid"] . '&name=' . $fullname . '" title="View SOA"><i class="fas fa-eye"></i></a>
              <a class="btn btn-primary btn-circle" href="attachment.php?soaid=' . $row["soaid"] . '&name=' . $fullname . '" title="View Attachment"><i class="fas fa-paperclip"></i></a>
              
                
                
                </td>
            </tr>';
            }
        }
    }
}
