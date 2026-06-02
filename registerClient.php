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
    <link href="css/custom.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include_once("bars/toast.php"); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="card shadow mb-12">
                        <div class="card-header py-3 <?php echo $cards; ?>">
                            <h6 class="m-0 font-weight-bold">CLIENT REGISTRATION</h6>
                        </div>
                        <div class="card-body" id="bodyResult">
                            <div class="card-body" id="bodyResult">
                                <h5 class="mb-3">PERSONAL INFORMATION</h5>
                                <hr>

                                <div class="row">
                                    <!-- Profile Photo & Capture -->
                                    <div class="col-lg-4 mb-4">
                                        <div class="text-center">
                                            <h6>Profile Photo</h6>
                                            <canvas id="canvas" width="400" height="400" style="display:none;"></canvas>
                                            <img id="photoPreview" src="img/profilepic.png" onclick="openCameraModal()"
                                                class="img-fluid rounded mb-2" style="cursor:pointer;" />
                                            <input type="hidden" name="capturedPhoto" id="capturedPhoto">
                                            <br>
                                            Click to capture photo

                                        </div>
                                    </div>

                                    <!-- Basic Information -->
                                    <div class="col-lg-4 mb-4">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" name="lastName" id="lastName" placeholder="Last Name"
                                            class="form-control mb-2">

                                        <label for="firstName">First Name</label>
                                        <input type="text" name="firstName" id="firstName" placeholder="First Name"
                                            class="form-control mb-2">

                                        <label for="middleName">Middle Name</label>
                                        <input type="text" name="middleName" id="middleName" placeholder="Middle Name"
                                            class="form-control mb-2">

                                        <label for="nickName">Nickname</label>
                                        <input type="text" name="nickName" id="nickName" placeholder="Nickname"
                                            class="form-control mb-2">
                                    </div>

                                    <!-- Demographics -->
                                    <div class="col-lg-4 mb-4">
                                        <label for="gender">Gender</label>
                                        <select id="gender" name="gender" class="form-control mb-2">
                                            <option value="">-- Select Gender --</option>
                                            <option value="MALE">Male</option>
                                            <option value="FEMALE">Female</option>
                                        </select>

                                        <label for="civilStatus">Civil Status</label>
                                        <select name="civilStatus" id="civilStatus" class="form-control mb-2">
                                            <option value="">-- Select Civil Status --</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Separated">Separated</option>
                                            <option value="Divorced">Divorced</option>
                                        </select>

                                        <label for="religion">Religion</label>
                                        <input type="text" name="religion" id="religion" placeholder="Religion"
                                            class="form-control mb-2">
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Birth Info -->
                                    <div class="col-lg-4 mb-4">
                                        <label for="birthday">Birthday</label>
                                        <input type="date" name="birthday" id="birthday" class="form-control mb-2"
                                            onchange="computeAge()">

                                        <label for="age">Age</label>
                                        <input type="number" name="age" id="age" placeholder="Age"
                                            class="form-control mb-2" readonly>

                                        <label for="occupation">Occupation</label>
                                        <input type="text" name="occupation" id="occupation" placeholder="Occupation"
                                            class="form-control mb-2">
                                    </div>

                                    <!-- Contact Info -->
                                    <div class="col-lg-4 mb-4">
                                        <label for="homeAddress">Home Address</label>
                                        <input type="text" name="homeAddress" id="homeAddress"
                                            placeholder="Home Address" class="form-control mb-2">

                                        <label for="contactNumber">Contact Number</label>
                                        <input type="text" name="contactNumber" id="contactNumber"
                                            placeholder="Contact Number" class="form-control mb-2">

                                        <label for="referredBy">Referred By</label>
                                        <input type="text" name="referredBy" id="referredBy" placeholder="Referred By"
                                            class="form-control mb-2">
                                    </div>

                                    <div class="col-lg-4 mb-4">
                                        <h6 class="mb-3">FOR MINORS ONLY</h6>
                                        <label for="guardianName">Guardian Name</label>
                                        <input type="text" name="guardianName" id="guardianName"
                                            placeholder="Guardian Name" class="form-control mb-2">

                                        <label for="guardianOccupation">Guardian Occupation</label>
                                        <input type="text" name="guardianOccupation" id="guardianOccupation"
                                            placeholder="Guardian Occupation" class="form-control mb-2">
                                    </div>
                                </div>


                                <hr>
                                <h5 class="mb-3">Health Maintenance Organization</h5>
                                <div class="row">

                                    <!-- Demographics -->
                                    <div class="col-lg-4 mb-4">
                                        <label for="HMO">HMO</label>
                                        <select id="hmo" name="hmo" class="form-control mb-2">
                                            <option value="">-- Select HMO --</option>
                                            <option value="Flexicare">Flexicare</option>
                                            <option value="Intellicare">Intellicare</option>
                                            <option value="Avega">Avega</option>
                                            <option value="Eastwest">Eastwest</option>
                                            <option value="ValuCare">ValuCare</option>
                                            <option value="Medicard">Medicard</option>
                                            <option value="Health Partners Dental Access, Inc.">Health Partners Dental
                                                Access, Inc.</option>
                                            <option value="Dental Network Company">Dental Network Company</option>
                                            <option value="Cocolife">Cocolife</option>
                                        </select>

                                    </div>
                                    <!-- Demographics -->
                                    <div class="col-lg-4 mb-4">
                                        <label for="cardNumber">Account No.</label>
                                        <input type="text" name="cardNumber" id="cardNumber"
                                            placeholder="Health Card Number" class="form-control mb-2">

                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <label for="cardNumber">Company</label>
                                        <input type="text" name="company" id="company" placeholder="Company Name"
                                            class="form-control mb-2">

                                    </div>
                                </div>

                                <div id="formResult"></div>
                                <footer class="sticky-footer">
                                    <div class="container my-auto">
                                        <div class="copyright text-center my-auto">
                                            <a href="#" class="btn btn-success btn-icon-split"
                                                onclick="addPatientPersonalInfo()">
                                                <span class="icon text-white-50"><i
                                                        class="fas fa-fw fa-plus"></i></span>
                                                <span class="text">Submit</span>

                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-icon-split"
                                                onclick="location.reload();">
                                                <span class="icon text-white-50"><i
                                                        class="fas fa-fw fa-times"></i></span>
                                                <span class="text">Cancel</span>
                                            </a>
                                        </div>
                                    </div>
                                </footer>

                            </div>



                        </div>
                        <!-- /.container-fluid -->
                    </div>
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

                <script src="js/camera.js"></script>
                <script src="js/custom-v2.js"></script>
                <script src="controllers/logOutConroller.js"></script>
                <script src="controllers/sessionController.js"></script>
                <script src="controllers/clientRegistrationController.js"></script>



</body>

</html>