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
                                Treatment:<input type="text" id="ctreatment" onkeydown="getclientdata();">
                                Client:<input type="text" id="clientname" onkeydown="getclientdata();">
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
                            <h2>STATEMENT OF ACCOUNT SUMMARY</h2>
                            <h3 id="h3id"></h3>
                            <!-- USE THIS SPACE FOR YOUR ADDITIONAL CODE SNIPPET -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-dark" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>SOA ID</th>
                                                <th>Name</th>
                                                <th>Dentist</th>
                                                <th>Treatment</th>
                                                <th>Details</th>
                                                <th>Remarks</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Price</th>

                                            </tr>
                                        </thead>
                                        <tbody id="resultResponsez">
                                        </tbody>
                                    </table>
                                </div>
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
            <script src="controllers/logOutConroller.js"></script>
            <script src="controllers/sessionController.js"></script>
            <script src="controllers/clienttreatmentrecordpertreatmentcontroller.js"></script>
            <script src="controllers/divPrinterController-v1.js"></script>



</body>

</html>