<?php
require_once('databaseService.php');
$service = new ServiceClass();
$fromdate = urldecode($_POST['from']);
$todate = urldecode($_POST['to']);
$clientname = urldecode($_POST['clientname']);
$result = $service->loadClientTreatment($fromdate, $todate, $clientname);

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
    public function loadClientTreatment($fromdate, $todate, $clientname)
    {


        $dateToday = date("Y-m-d");


        if (!empty($fromdate) && !empty($todate)) {
            // If both dates are provided
            $query = "SELECT tsoa.soaid, cp.clientid,tsoa.hmoaccredited, cp.lname, cp.fname, cp.mdname, tsoa.dentist, tsub.treatment, tsub.price, tsoa.date FROM clientprofile cp INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid WHERE (tsoa.date BETWEEN :a AND :b) AND CONCAT(cp.lname,', ',cp.fname,' ' ,cp.mdname) LIKE '%" . $clientname . "%'";


            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $fromdate);
            $stmt->bindParam(':b', $todate);

        } elseif (empty($fromdate) && !empty($todate)) {
            // If only todate is provided
            $query = "SELECT tsoa.soaid, cp.clientid,tsoa.hmoaccredited, cp.lname, cp.fname, cp.mdname, tsoa.dentist, tsub.treatment, tsub.price, tsoa.date FROM clientprofile cp INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid WHERE (tsoa.date <= :b) AND CONCAT(cp.lname,', ',cp.fname,' ' ,cp.mdname) LIKE '%" . $clientname . "%'";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':b', $todate);

        } elseif (!empty($fromdate) && empty($todate)) {
            // If only todate is provided
            $query = "SELECT tsoa.soaid, cp.clientid,tsoa.hmoaccredited, cp.lname, cp.fname, cp.mdname, tsoa.dentist, tsub.treatment, tsub.price, tsoa.date FROM clientprofile cp INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid WHERE (tsoa.date >= :b) AND CONCAT(cp.lname,', ',cp.fname,' ' ,cp.mdname) LIKE '%" . $clientname . "%'";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':b', $fromdate);



        } else {
            // No filtering if both dates are empty
            $query = "SELECT tsoa.soaid, cp.clientid,tsoa.hmoaccredited, cp.lname, cp.fname, cp.mdname, tsoa.dentist, tsub.treatment, tsub.price, tsoa.date FROM clientprofile cp INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid WHERE CONCAT(cp.lname,', ',cp.fname,' ' ,cp.mdname) LIKE '%" . $clientname . "%'";
            $stmt = $this->conn->prepare($query);
        }



        $stmt->execute();
        $total = 0;
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $total += $row["price"];
                $fullname = $row["lname"] . ', ' . $row["fname"] . ' ' . $row["mdname"];
                echo '
                <tr style="color: black;">
                <td>' . $row["soaid"] . '</td>

                <td>' . $fullname . '</td>';
                $hmo = $row["hmoaccredited"];
                $hmoDisplay = '';

                if (!empty($hmo)) {
                    $parts = explode('|', $hmo);
                    $hmoDisplay = trim($parts[0]);
                }

                echo '  <td>' . $hmoDisplay . '</td>';


                echo '
                <td>' . $row["dentist"] . '</td>
                <td>' . $row["treatment"] . '</td>
                <td style="text-align:right;">' . number_format($row["price"], 2) . '</td>
                <td>' . date("Y/m/d", strtotime($row["date"])) . '</td>
            </tr>';
            }
        } else {
            echo '
<tr>
<td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>      
            </tr>
';

        }
        echo '
<tr>
              
                <td colspan="5">Total </td>
                
                <td style="text-align:right;"><strong>' . number_format($total, 2) . '</strong></td>
                <td></td>      
            </tr>
';
    }
}
