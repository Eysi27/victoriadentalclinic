<?php
require_once('databaseService.php');
$service = new ServiceClass();
$asOf = urldecode($_POST['asOf']);
$group = urldecode($_POST['group']);
$result = $service->loadLastTreatment3Months($asOf, $group);

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

    public function loadLastTreatment3Months($asOf, $group)
    {
        $key = 'tsoa.soaid';
        if ($group == 'Dentist') {
            $key = 'tsoa.dentist';
        } else if ($group == 'Patient') {
            $key = 'concat(cp.lname, ", ", cp.fname, " ", cp.mdname)';
        }

        $query0 = "SELECT DISTINCT $key AS result
            FROM clientprofile cp
            INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid
            INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid
            WHERE tsoa.date <= DATE_SUB(:a, INTERVAL 3 MONTH)
              AND LOWER(tsub.treatment) LIKE '%oral prophylaxis%'
              AND tsub.tsubid = (
                  SELECT tsub2.tsubid
                  FROM treatmentsub tsub2
                  INNER JOIN treatmentsoa tsoa2 ON tsoa2.soaid = tsub2.soaid
                  WHERE tsub2.clientid = cp.clientid
                  ORDER BY tsoa2.date DESC, tsub2.tsubid DESC
                  LIMIT 1
              )
            ORDER BY result";

        $stmt0 = $this->conn->prepare($query0);
        $stmt0->bindParam(':a', $asOf);
        $stmt0->execute();

        $totalPatients = 0;
        $oldestDate = null;
        $groupedCount = 0;

        if ($stmt0->rowCount() > 0) {
            while ($row0 = $stmt0->fetch(PDO::FETCH_ASSOC)) {
                $sortkey = $row0['result'];
                $groupedCount++;

                echo '<div class="row"><h4>' . $group . ': ' . htmlspecialchars($sortkey) . '</h4></div>';
                echo '<div class="table-responsive">
                        <table class="table text-dark" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Client ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Mobile#</th>
                                    <th>Dentist</th>
                                    <th>Last Treatment</th>
                                    <th>SOA ID</th>
                                    <th>SOA Date</th>
                                    <th>Total Fee</th>
                                    <th>Days Since Treatment</th>
                                </tr>
                            </thead>
                            <tbody>';

                $query = "SELECT cp.clientid, cp.lname, cp.fname, cp.mdname, cp.emailAddress, cp.mobileNumber, tsub.treatment, tsub.price, tsoa.soaid, tsoa.dentist, tsoa.date AS last_treatment_date
                    FROM clientprofile cp
                    INNER JOIN treatmentsub tsub ON tsub.clientid = cp.clientid
                    INNER JOIN treatmentsoa tsoa ON tsoa.soaid = tsub.soaid
                    WHERE tsoa.date <= DATE_SUB(:a, INTERVAL 5 MONTH)
                      AND LOWER(tsub.treatment) LIKE '%oral prophylaxis%'
                      AND tsub.tsubid = (
                          SELECT tsub2.tsubid
                          FROM treatmentsub tsub2
                          INNER JOIN treatmentsoa tsoa2 ON tsoa2.soaid = tsub2.soaid
                          WHERE tsub2.clientid = cp.clientid
                          ORDER BY tsoa2.date DESC, tsub2.tsubid DESC
                          LIMIT 1
                      )
                      AND $key = :c
                    ORDER BY cp.lname, cp.fname";

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':a', $asOf);
                $stmt->bindParam(':c', $sortkey);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $totalPatients++;
                        $fullName = $row['lname'] . ', ' . $row['fname'] . ' ' . $row['mdname'];
                        $lastDate = $row['last_treatment_date'];

                        if ($oldestDate === null || $lastDate < $oldestDate) {
                            $oldestDate = $lastDate;
                        }

                        $asOfDate = new DateTime($asOf);
                        $treatmentDate = new DateTime($lastDate);
                        $daysSince = $treatmentDate->diff($asOfDate)->days;

                        $mobileDisplay = empty($row['mobileNumber']) ? '-' : htmlspecialchars($row['mobileNumber']);

                        echo '<tr style="color: black;">
                            <td>' . htmlspecialchars($row['clientid']) . '</td>
                            <td>' . htmlspecialchars($fullName) . '</td>
                            <td>' . htmlspecialchars($row['emailAddress']) . '</td>
                            <td>' . $mobileDisplay . '</td>
                            <td>' . htmlspecialchars($row['dentist']) . '</td>
                            <td>' . htmlspecialchars($row['treatment']) . '</td>
                            <td>' . htmlspecialchars($row['soaid']) . '</td>
                            <td>' . date('Y/m/d', strtotime($lastDate)) . '</td>
                            <td style="text-align:right;">' . number_format($row['price'], 2) . '</td>
                            <td style="text-align:right;">' . $daysSince . '</td>
                        </tr>';
                    }
                }

                echo '</tbody>
                        </table>
                    </div>';
            }
        } else {
            echo '<div class="alert alert-info">No patients found with last treatment more than 5 months before the selected date.</div>';
        }

        echo '<div style="margin-top: 20px; padding: 15px; border: 1px solid #ccc; background-color: #f9f9f9; border-radius: 8px;">
                <h5 style="margin-bottom: 15px; text-align: center;"><strong>Summary Report</strong></h5>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span><strong>As of Date:</strong></span>
                    <span>' . htmlspecialchars(date('Y/m/d', strtotime($asOf))) . '</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span><strong>Threshold Date:</strong></span>
                    <span>' . htmlspecialchars(date('Y/m/d', strtotime("-5 months", strtotime($asOf)))) . '</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span><strong>Total Patients:</strong></span>
                    <span>' . number_format($totalPatients) . '</span>
                </div>
            </div>';
    }
}
