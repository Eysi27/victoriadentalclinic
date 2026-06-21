<?php
session_start();
error_reporting(0);
require_once('services/databaseService.php');
$database = new Database();
$db = $database->dbConnection();
$dentistList = [];
try {
    $stmt = $db->prepare("SELECT DISTINCT dentist FROM treatmentsoa WHERE dentist <> '' ORDER BY dentist");
    $stmt->execute();
    $dentistList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $dentistList = [];
}
$today = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dentist Payroll Report | Victoria Advanced Dental Care</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .table th,
        .table td {
            font-size: 0.82rem;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #daterange,
            #daterange * {
                visibility: visible;
            }

            #daterange {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }

            .no-print,
            .no-print * {
                display: none !important;
            }

            @page {
                margin: 8mm;
                size: auto;
            }

            body {
                margin: 0;
                padding: 0;
            }

            #daterange {
                padding: 4mm;
            }

            .card,
            .card-body {
                box-shadow: none !important;
            }

            .table {
                width: 100% !important;
                border-collapse: collapse !important;
            }

            .table th,
            .table td {
                border: 1px solid #dee2e6 !important;
                padding: 0.3rem !important;
                font-size: 0.78rem !important;
            }
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include_once('bars/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include_once('bars/topbar.php'); ?>
                <div class="container-fluid" id="content-table">
                    <div class="card shadow mb-12">
                        <div class="card-header py-3 <?php echo isset($cards) ? $cards : ''; ?>">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div>
                                    <h6 class="m-0 font-weight-bold">DENTIST PAYROLL REPORT</h6>
                                    <small><?php echo date('Y-m-d'); ?></small>
                                </div>
                                <div class="form-inline no-print">
                                    <select id="dentist" class="form-control form-control-sm mr-2 mb-2"
                                        onchange="loadPayrollReport();">
                                        <option value="">Select dentist</option>
                                        <?php foreach ($dentistList as $row) {
                                            $dentist = htmlspecialchars($row['dentist']);
                                            echo '<option value="' . $dentist . '">' . $dentist . '</option>';
                                        } ?>
                                    </select>
                                    <input type="date" id="from" class="form-control form-control-sm mr-2 mb-2"
                                        value="<?php echo $today; ?>" onchange="loadPayrollReport();">
                                    <input type="date" id="to" class="form-control form-control-sm mr-2 mb-2"
                                        value="<?php echo $today; ?>" onchange="loadPayrollReport();">
                                    <input type="number" id="commissionPercentage"
                                        class="form-control form-control-sm mr-2 mb-2" placeholder="Commission %"
                                        value="10" min="0" max="100" step="0.01" onchange="updateDisbursements();"
                                        oninput="updateDisbursements();">
                                    <button class="btn btn-primary btn-sm mr-2 mb-2"
                                        onclick="loadPayrollReport();">Load</button>
                                    <button class="btn btn-success btn-sm mr-2 mb-2"
                                        onclick="recalculateTotal();">Calculate</button>
                                    <button class="btn btn-secondary btn-sm mb-2"
                                        onclick="printDiv('daterange');">Print</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="daterange">
                            <div class="border rounded p-3 mb-3" style="background:#f8f9f9;">
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-between align-items-md-start">
                                    <div>
                                        <h2 class="h5 font-weight-bold mb-1">Victoria Advanced Dental Care</h2>
                                        <div class="small text-secondary mb-1">101 Iriga, Iriga City, Camarines Sur
                                        </div>
                                        <div class="small font-weight-bold text-primary">Dentist Payroll Payslip</div>
                                    </div>
                                    <div class="text-md-right mt-3 mt-md-0">
                                        <div class="small text-uppercase text-muted">Generated</div>
                                        <div class="font-weight-bold"><?php echo date('Y-m-d'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 mb-2">
                                    <div class="small text-uppercase text-muted mb-1">Dentist</div>
                                    <div class="font-weight-bold" id="payslipDentist">-</div>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <div class="small text-uppercase text-muted mb-1">Period</div>
                                    <div class="font-weight-bold" id="payslipPeriod">-</div>
                                </div>
                                <div class="col-sm-4 mb-2">
                                    <div class="small text-uppercase text-muted mb-1">Commission</div>
                                    <div class="font-weight-bold text-primary" id="payslipCommission">12%</div>
                                </div>
                            </div>
                            <div id="loading"
                                style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.8); backdrop-filter: blur(3px); z-index:9999;">
                                <div class="d-flex flex-column align-items-center justify-content-center"
                                    style="height: 100%;">
                                    <div class="spinner-grow text-primary mb-3" role="status"
                                        style="width: 3rem; height: 3rem;"><span class="sr-only">Loading...</span></div>
                                    <div class="h5 font-weight-bold text-primary">Loading, please wait...</div>
                                </div>
                            </div>
                            <div id="responseBody"></div>
                            <div id="payrollTotals" class="mt-4" style="display:none;">
                                <div class="card border-secondary shadow-sm">
                                    <div class="card-body py-3 px-4">
                                        <div class="row align-items-end">
                                            <div class="col-md-8">
                                                <div class="form-row">
                                                    <div class="col-3 mb-3">
                                                        <label for="attendanceCount"
                                                            class="small text-uppercase text-muted">Attendance</label>
                                                        <input type="number" step="1" min="0" id="attendanceCount"
                                                            class="form-control form-control-sm" value="0"
                                                            onchange="recalculateTotal();"
                                                            oninput="recalculateTotal();">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label for="dailyRate"
                                                            class="small text-uppercase text-muted">Daily Rate</label>
                                                        <input type="number" step="0.01" min="0" id="dailyRate"
                                                            class="form-control form-control-sm" value="0.00"
                                                            onchange="recalculateTotal();"
                                                            oninput="recalculateTotal();">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label for="adjustments"
                                                            class="small text-uppercase text-muted">Adjustments</label>
                                                        <input type="number" step="0.01" min="0" id="adjustments"
                                                            class="form-control form-control-sm" value="0"
                                                            onchange="recalculateTotal();"
                                                            oninput="recalculateTotal();">
                                                    </div>
                                                    <div class="col-3 mb-3">
                                                        <label for="deductions"
                                                            class="small text-uppercase text-muted">Deductions</label>
                                                        <input type="number" step="0.01" min="0" id="deductions"
                                                            class="form-control form-control-sm" value="0"
                                                            onchange="recalculateTotal();"
                                                            oninput="recalculateTotal();">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <div class="small text-uppercase text-muted mb-1">Basic Salary</div>
                                                <div class="h5 font-weight-bold" id="basicSalary">0.00</div>
                                                <div class="small text-uppercase text-muted mb-1">Net Payable</div>
                                                <div class="h4 font-weight-bold text-success" id="totalReceived">0.00
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('bars/footer.php'); ?>
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
            <script src="js/demo/datatables-demo.js"></script>
            <script src="js/sb-admin-2.min.js"></script>
            <script src="controllers/logOutConroller.js"></script>
            <script src="controllers/sessionController.js"></script>
            <script src="controllers/dentistPayrollReportController.js"></script>
            <script src="controllers/divPrinterController-v1.js"></script>
            <script src="controllers/divPrinterController-v2.js"></script>
        </div>
    </div>
</body>

</html>