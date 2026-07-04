<?php
include_once("bars/properties.php");
session_start();
error_reporting(0);
if ($_SESSION["account_type"] != 0 && $_SESSION["account_type"] != 100) {
    header("Location: clientProfileList.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Victoria Advanced Dental Care</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/vadc_icon.ico"/>  

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include_once('bars/sidebar.php'); ?>


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php include_once('bars/topbar.php'); ?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!--START DASHBOARD-->
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-warning   shadow-sm"><i
                                class="fas fa-exclamation fa-sm text-white-50"></i> WELCOME TO VICTORIA ADVANCED DENTAL CARE
                            OFFICIAL SYSTEM</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Number of Patients</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="dashPatient">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a
                                                    href="hmoList.php">Monthly Gross Income</a></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                                                        id="dashhmoRecord">0</div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <a href="expensesList.php">Monthly Expense</a>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="dashConsent">0
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Monthly Net Income</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="dashEarnings">0
                                            </div>
                                        </div>
                                        <div class="col-auto">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <div class="col-xl-6 col-lg-6">

                            <!-- Bar Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 <?php echo $cards; ?>">
                                    <h6 class="m-0 font-weight-bold">Yearly Earnings Overview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="earningsbar"></canvas>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6">

                            <!-- Bar Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 <?php echo $cards; ?>">
                                    <h6 class="m-0 font-weight-bold">Montly Earnings Overview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="monthlyearningsbar"></canvas>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6">

                            <!-- Bar Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 <?php echo $cards; ?>">
                                    <h6 class="m-0 font-weight-bold">Patients Statistic Report</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="patientsbar"></canvas>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6">

                            <!-- Bar Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 <?php echo $cards; ?>">
                                    <h6 class="m-0 font-weight-bold">Montly Patients Record</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="monthlypatientsbar"></canvas>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6">

                            <!-- Bar Chart -->
                        </div>
                    </div>




                    <!--END DASHBNOARD-->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <div id="jsResult">
            </div>
            <?php include_once('bars/footer.php'); ?>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>
            <script src="controllers/barchart.js"></script>

            <script src="controllers/dashboardController-v4.js"></script>
            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>
            <script src="controllers/logOutConroller.js"></script>

            <script src="controllers/sessionController.js"></script>


</body>

</html>