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
    <link href="css/sortable.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

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
                        <div class="card-header py-3 d-flex justify-content-between <?php echo $cards; ?>">
                            <h6 class="m-0 font-weight-bold">Prescription List</h6>


                            <button class="btn btn-success btn-circle edit-btn" data-toggle="modal"
                                data-target="#editExpenseModal">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="card-header py-3 d-flex justify-content-between">
                                <h6 class="m-0 font-weight-bold"></h6>
                                <div class="d-flex align-items-center gap-2 ms-auto">
                                    <strong>Search: </strong><input type="search" id="tableSearch"
                                        class="form-control form-control-sm" placeholder="" style="width: 300px;"
                                        oninput="search();">

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-dark" id="sortableTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>

                                            <th onclick="sortTable(this)">Date <span class="sort-icon"></span></th>
                                            <th onclick="sortTable(this)">Name <span class="sort-icon"></span>
                                            </th>
                                            <th onclick="sortTable(this)">Age <span class="sort-icon"></span>
                                            </th>
                                            <th onclick="sortTable(this)">Gender <span class="sort-icon"></span>
                                            </th>
                                            <th onclick="sortTable(this)">Address <span class="sort-icon"></span>
                                            </th>

                                            <th>Action</th>
                                            <!-- No onclick, since actions typically aren' t sortable -->



                                        </tr>
                                    </thead>

                                    <tbody id="resultResponseBody">



                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" id="currentPage" value="1">
                            <div id="pagination"></div>






                            <!-- END OF YOUR ADDITIONAL CODE SNIPPET -->
                        </div>

                    </div>

                    <div class="modal fade" id="printPrescriptionModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content p-3" id="printable-area">
                                <div class="modal-body">


                                    <div style="text-align:center;margin:0px;">
                                        <img src="img/white_logo_final.jpg"
                                            style="max-width:250px; align-items:center" />
                                    </div>

                                    <p style="text-align: center; color: black; margin: 0;font-size:13px;">
                                        Stall B Josefa St. Josefaville 1 Subd Brgy Malabanias<br>Angeles City Pampanga
                                        PH 2009

                                    </p>

                                    <p style="text-align: center; color: black; margin: 0;font-size:13px;">

                                        <strong>Contact Number:</strong> 0927-605-8418 / 0960-437-5938
                                    </p>




                                    <hr style="border: 1px solid black; margin: 10px 0;">

                                    <!-- Patient Info Row -->
                                    <div
                                        style="display: flex; justify-content: space-between; color: black; margin-bottom: 1px;">
                                        <div style="width: 100%;"><strong>Name:</strong> <span id="print-name"></span>
                                        </div>

                                    </div>
                                    <div
                                        style="display: flex; justify-content: space-between; color: black; margin-bottom: 1px;">

                                        <div style="width: 100%; text-align: left;">
                                            <strong>Age/Gender:</strong> <span id="print-age"></span> <span
                                                id="print-gender"></span>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div style="color: black; margin-bottom: 1px;">
                                        <strong>Address:</strong> <span id="print-address"></span>
                                    </div>

                                    <!-- Rx and Date Row -->
                                    <div
                                        style="display: flex; justify-content: space-between; align-items: flex-start; color: black; margin-bottom: 10px;">
                                        <div style="font-family: serif; font-weight: bold; font-size: 28px;">Rx</div>
                                        <div style="text-align: right;"><strong>Date:</strong> <span
                                                id="print-date"></span></div>
                                    </div>

                                    <!-- Prescription Medicine Section -->
                                    <div id="presmedicine" style="color: black; margin-bottom: 30px;">
                                        <!-- Medicine list will be injected here -->
                                    </div>

                                    <!-- Doctor Info at the bottom right -->
                                    <div style="text-align: right; color: black; font-size: 11pt; font-family: Arial;">
                                        <div
                                            style="border-bottom: 1px solid black; width: 200px; margin-left: auto; margin-bottom: 5px;">
                                        </div>

                                        <strong id="print-dentist">Nikki Ferrer Sarmiento, DDM</strong><br>
                                        License No.: <span id="print-license">0053036</span><br>
                                        PTR No.: _______________
                                    </div>


                                    -->

                                </div>
                                <div class="modal-footer d-print-none">

                                    <button class="btn btn-primary" onclick="printPrescription()">Print</button>

                                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="modal fade" id="editExpenseModal" tabindex="-1" role="dialog"
                        aria-labelledby="editExpenseModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header <?php echo $cards; ?>">
                                    <h5 class="modal-title" id="editExpenseModalLabel">Prescription</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form id="editExpenseForm">
                                        <input type="hidden" name="rxid" id="modal-rxid">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Dentist Name: </label>
                                                <input type="text" class="form-control" name="dentistname"
                                                    id="modal-dentist">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>License No.: </label>
                                                <input type="text" class="form-control" name="dentistname"
                                                    id="modal-license">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Patient Name</label>
                                                <input type="text" class="form-control" name="name" id="modal-name">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Date</label>
                                                <input type="date" class="form-control" name="date" id="modal-date">
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label>Age</label>
                                                <input type="text" class="form-control" name="age" id="modal-age">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender" id="modal-gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>

                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="address"
                                                    id="modal-address" value="">
                                            </div>





                                        </div>



                                        <!-- Standalone Medicine Field -->
                                        <div class="form-group">
                                            <label>Medicine</label>
                                            <div class="d-flex">
                                                <select class="form-control mr-2" name="medicine" id="modal-medicine"
                                                    style="flex: 1;">
                                                    <option value="1">med1</option>
                                                    <option value="2">med2</option>
                                                </select>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="AddMed();">Add</button>
                                            </div>
                                        </div>

                                        <!-- Separate block for table (not inside form-group) -->
                                        <div class="table-responsive mt-3">
                                            <table class="table table-bordered" id="medicine-table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>RxID</th>
                                                        <th>Medicine</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="prescriptionsubList">
                                                    <!-- JS rows go here -->
                                                </tbody>
                                            </table>
                                        </div>


                                    </form>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" onclick="submitCart();">Save
                                        changes</button>
                                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteExpenseModal" tabindex="-1" role="dialog"
                        aria-labelledby="editExpenseModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">

                            <div class="modal-content">
                                <div class="modal-header <?php echo $cards; ?>">
                                    <h5 class="modal-title" id="editExpenseModalLabel">Prescription</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form id="deleteExpenseForm">
                                        <input type="hidden" name="prescriptionid" id="modal-prescriptionid">
                                        Are you sure you want to delete this prescription?
                                    </form>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" onclick="deleteCart();">Yes</button>
                                    <button class="btn btn-danger" data-dismiss="modal">No</button>
                                </div>
                            </div>

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
            <script src="controllers/prescriptionListController.js"></script>
            <!-- <script src="controllers/deleteClientProfileController.js"></script> -->
            <script src="js/sortable.js"></script>



</body>

</html>