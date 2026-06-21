<?php
require_once('databaseService.php');
$service = new ServiceClass();
$fromdate = urldecode($_POST['from']);
$todate = urldecode($_POST['to']);
$dentist = urldecode($_POST['dentist']);
$result = $service->loadDentistPayroll($fromdate, $todate, $dentist);

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

    public function loadDentistPayroll($fromdate, $todate, $dentist)
    {
        $parameters = [];
        $conditions = [];

        if (!empty($dentist)) {
            $conditions[] = 'tsoa.dentist = :dentist';
            $parameters[':dentist'] = $dentist;
        }

        if (!empty($fromdate) && !empty($todate)) {
            $conditions[] = 'tsp.paymentdate BETWEEN :fromdate AND :todate';
            $parameters[':fromdate'] = $fromdate;
            $parameters[':todate'] = $todate;
        } elseif (!empty($fromdate)) {
            $conditions[] = 'tsp.paymentdate >= :fromdate';
            $parameters[':fromdate'] = $fromdate;
        } elseif (!empty($todate)) {
            $conditions[] = 'tsp.paymentdate <= :todate';
            $parameters[':todate'] = $todate;
        }

        $whereClause = '';
        if (count($conditions) > 0) {
            $whereClause = 'WHERE ' . implode(' AND ', $conditions);
        }

        $query = "SELECT tsp.paymentdate, tsp.paymenttype, tsp.amount, tsub.treatment, tsub.soaid, tsub.tsubid, CONCAT(cp.lname, ', ', cp.fname, ' ', cp.mdname) AS fullname, tsoa.dentist
                  FROM treatmentsubpayment tsp
                  INNER JOIN treatmentsub tsub ON tsp.tsubid = tsub.tsubid
                  INNER JOIN treatmentsoa tsoa ON tsub.soaid = tsoa.soaid
                  INNER JOIN clientprofile cp ON tsub.clientid = cp.clientid
                  $whereClause
                  ORDER BY tsp.paymentdate ASC, tsp.tsubpayid ASC";

        $stmt = $this->conn->prepare($query);
        foreach ($parameters as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            echo '<div class="alert alert-info">No payment records found for the selected dentist and date range.</div>';
            return;
        }

        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered text-dark" width="100%" cellspacing="0">';
        echo '<thead><tr>';
        echo '<th>Commission</th>';
        echo '<th>SOA ID</th>';
        echo '<th>Patient</th>';
        echo '<th>Payment Date</th>';
        echo '<th>Payment Type</th>';
        echo '<th>Payment Amount</th>';
        echo '<th>Disbursement</th>';
        echo '<th>Treatment</th>';
        echo '<th>Dentist</th>';
        echo '</tr></thead><tbody>';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $amount = number_format($row['amount'], 2, '.', '');
            echo '<tr data-amount="' . $amount . '">';
            echo '<td class="text-center"><input type="checkbox" class="commission-checkbox" /></td>';
            echo '<td>' . htmlspecialchars($row['soaid']) . '</td>';
            echo '<td>' . htmlspecialchars($row['fullname']) . '</td>';
            echo '<td>' . htmlspecialchars(date('Y/m/d', strtotime($row['paymentdate']))) . '</td>';
            echo '<td>' . htmlspecialchars($row['paymenttype']) . '</td>';
            echo '<td class="text-right">' . number_format($row['amount'], 2) . '</td>';
            echo '<td class="text-right disbursement-amount">' . number_format($row['amount'], 2) . '</td>';
            echo '<td>' . htmlspecialchars($row['treatment']) . '</td>';
            echo '<td>' . htmlspecialchars($row['dentist']) . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table></div>';
    }
}
