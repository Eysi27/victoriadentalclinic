<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Smiles & More</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                <div class="container-fluid" id="content-table">

                    <!-- Page Heading -->
                    <div class="card shadow mb-12">
                        <div class="card-header py-3 <?php echo $cards; ?>">

                            <div class="row float-right" style-"float: right;">
                                Group By :
                                <select id="group" name="group" onchange="getclientdata();">
                                    <option value="Mode of Payment">Mode of Payment</option>
                                    <option value="Dentist">Dentist</option>
                                    <option value="Patient">Patient</option>

                                </select>
                                Date From : <input type="date" id="from" onchange="getclientdata();">
                                Date To : <input type="date" id="to" onchange="getclientdata();">

                                <input type="button" class="btn btn-primary" onclick="printDiv('daterange')"
                                    value="Print">

                            </div>
                            <h6 class="m-0 font-weight-bold">RECORDS OF SOA AS OF:
                                <?php $dToday = date('Y-m-d');
                                echo $dToday; ?>
                            </h6>

                        </div>

                        <div class="card-body" id="daterange">
                            <div>
                                <div style=" text-align:left;">
                                    <h2 style="margin:0; font-weight:bold; font-size: 1.5rem;">Smiles & More
                                    </h2>
                                    <div style="font-size:14px;">Stall B Josefa St. Josefaville 1 Subd Brgy Malabanias
                                        Angeles City Pampanga PH 2009</div>
                                </div>
                                <hr>
                                <div style="text-align:center;">
                                    <h2 style="margin:0; font-weight:bold;">INCOME STATEMENT SUMMARY</h2>
                                    <h5 id="h3id" style="margin:0;"></h5>
                                </div>
                                <div style="width:180px;"></div> <!-- Spacer for symmetry, adjust width as needed -->
                            </div>

                            <div id="loading" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(255,255,255,0.7); backdrop-filter: blur(3px);
            z-index:9999;">

                                <div class="d-flex flex-column align-items-center justify-content-center"
                                    style="height: 100%;">
                                    <div class="spinner-grow text-primary mb-3" role="status"
                                        style="width: 3rem; height: 3rem;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="h5 font-weight-bold text-primary">Loading, please wait...</div>
                                </div>
                            </div>
                            <!-- USE THIS SPACE FOR YOUR ADDITIONAL CODE SNIPPET -->
                            <div class="card-body" id="responseBody">

                            </div>






                            <!-- END OF YOUR ADDITIONAL CODE SNIPPET -->
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include_once('bars/footer.php'); ?>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/datatables-demo.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>
            <script src="js/custom-v2.js"></script>
            <script src="controllers/logOutConroller.js"></script>
            <script src="controllers/sessionController.js"></script>
            <script src="controllers/getincomedaterange-v2.js"></script>
            <script src="controllers/divPrinterController-v1.js"></script>



</body>

</html>