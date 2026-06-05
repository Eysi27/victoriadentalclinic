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

    <title>Victoria Advanced Dental Care</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="card shadow mb-12">
                        <div class="card-header py-3 <?php echo $cards; ?>">
                            Create SOA - Treatment
                            <button id="divPrinter" class="btn btn-success btn-sm float-right"
                                onclick="location.reload()" title="Print E-SOA">Add New</button>
                            <button id="divPrinter" class="btn btn-success btn-sm btn-circle float-right"
                                onclick="printDiv('bodyResult')" title="Print E-SOA" style="display:none;"><i
                                    class="fas fa-print"></i></button>
                        </div>
                        <input type="hidden" name="lastName" id="clientid" value="<?php echo $_GET['clientid']; ?>">

                        <div class="card-body" id="bodyResult">

                            <div class="row">
                                <div class="col-lg-6"><strong>Victoria Advanced Dental Care</strong></div>
                                <div class="col-lg-6" style="text-align:right;">Bringing you, your best smile!</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12"> Stall B Josefa St. Josefaville 1 Subd Brgy Malabanias Angeles
                                    City Pampanga PH 2009</div>
                                <div class="col-lg-12">0927-605-8418 / 0960-437-5938</div>
                                <hr>
                                <div class="col-lg-12" style="text-align:center;"><strong>Electronic Statement of
                                        Account - ESOA</strong></div>
                            </div>
                            <hr>
                            <!-- USE THIS SPACE FOR YOUR ADDITIONAL CODE SNIPPET -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="lastName">Dentist</label>


                                    <select name="dentist" id="dentist" class="form-control">
                                        <?php
                                        foreach ($dentist as $d) {
                                            echo '<option value="' . htmlspecialchars($d) . '">' . htmlspecialchars($d) . '</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="col-lg-6">
                                    <label for="lastName">Date</label>
                                    <input type="date" name="lastName" id="date" placeholder="Input Time"
                                        class="form-control" value="">

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="Client Name">Client Name</label>
                                    <input type="Text" name="lastName" id="lastName" placeholder="LAST NAME"
                                        class="form-control" value="<?php echo $_GET['clientname']; ?>" readonly>
                                    <label for="Birthday">Birthday</label>
                                    <input type="Text" name="lastName" id="lastName" placeholder="BIRTHDAY"
                                        class="form-control" value="<?php echo $_GET['birthDate']; ?>" readonly>
                                    <label for="Age">Age</label>
                                    <input type="Text" name="age" id="age" placeholder="Age" class="form-control"
                                        value="<?php echo $_GET['age']; ?>" readonly>

                                </div>
                                <div class="col-lg-6">
                                    <label for="lastName">Time</label>
                                    <input type="Text" name="lastName" id="time" placeholder="Input Time"
                                        class="form-control" value="">
                                    <label for="Address">Address</label>
                                    <input type="Text" name="address" id="address" placeholder="Address"
                                        class="form-control" value="<?php echo $_GET['address']; ?>" readonly>
                                    <label for="Address">HMO Accredited:</label>

                                    <select id="hmo" name="hmo" class="form-control mb-2">
                                        <option value="">-- Select HMO --</option>
                                        <?php
                                        $hmos = ['Flexicare', 'Intellicare', 'Avega', 'Eastwest', 'ValuCare', 'Medicard', 'Health Partners Dental Access, Inc.', 'Dental Network Company', 'Cocolife'];
                                        foreach ($hmos as $hmo) {
                                            $selected = ($_GET['hmo'] ?? '') == $hmo ? 'selected' : '';
                                            echo "<option value=\"$hmo\" $selected>$hmo</option>";
                                        }
                                        ?>
                                    </select>


                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">

                                    <label for="treatment">Treatment</label>
                                    <input list="treatment-options" id="treatment" name="treatment"
                                        class="form-control" />

                                    <datalist id="treatment-options">

                                        <!-- Add more options as needed -->
                                    </datalist>
                                    <!-- <select id="treatment" name="treatment" class="form-control">

                                    </select> -->
                                    <label for="diagnosis">Diagnosis</label>
                                    <textarea id="diagnosis" class="form-control" name="diagnosis"
                                        placeholder="Diagnosis"></textarea>
                                    <label for="treatment">Details</label>
                                    <textarea id="details" class="form-control" name="details"
                                        placeholder="Details"></textarea>
                                    <label for="treatment">Remarks</label>
                                    <input type="Text" name="remarks" id="remarks" placeholder="Input Remarks"
                                        class="form-control" value="">
                                    <label for="lastName">Treatment Fee</label>
                                    <input type="number" name="price" id="price" placeholder="Input fee"
                                        class="form-control" value="">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" value="1" id="hmoCovered"
                                            name="hmoCovered">
                                        <label class="form-check-label" for="hmoCovered">
                                            Covered by HMO
                                        </label>
                                    </div>
                                    <br>
                                    <button class="btn btn-primary form-control" onclick="add()">Add</button>
                                </div>

                                <div class="col-lg-6">
                                    <table class="table text-dark" width="100%" cellspacing="0" style="font-size:12px;">
                                        <thead>
                                            <tr>
                                                <th>Treatment</th>
                                                <th>Diagnosis</th>
                                                <th>Details</th>
                                                <th>Remarks</th>
                                                <th>Price</th>
                                                <th>HMO</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody id="treatmentList">
                                            <!-- <tr>
               -->

                                        </tbody>
                                    </table>

                                </div>

                            </div>
                            <hr>
                            <div class"row>
                                <div class="col-sm=12">
                                    <label for="agreement">Agreement</label>
                                    <textarea id="agreement" class="form-control" name="Agreement"
                                        placeholder="Input Agreement Here"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12" style="text-align:center;">
                                    <div id="formResult"></div>
                                    <button class="btn btn-success" onclick="submit()">Submit</button>
                                    <button class="btn btn-danger"
                                        onclick="window.location.href = 'clientTreatmentList.php';">Cancel</button>
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

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>
            <script src="controllers/logOutConroller.js"></script>
            <script src="controllers/sessionController.js"></script>
            <script src="controllers/eSoaController-v3.js"></script>
            <script src="controllers/divPrinterController-v1.js"></script>
            <script src="js/custom-v2.js"></script>
</body>

</html>