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
                            <h6 class="m-0 font-weight-bold">CLIENT PROFILE UPDATE</h6>
                        </div>
                        <div class="card-body" id="bodyResult" style="padding-left:20%;padding-right:20%;">
                            <!-- USE THIS SPACE FOR YOUR ADDITIONAL CODE SNIPPET -->
                            <label for="Name">PERSONAL INFORMATION</label>

                            <input type="hidden" name="lastName" id="clientid" value="<?php echo $_GET['clientid']; ?>">

                            <hr>
                            <label for="lastName">LAST NAME</label>
                            <input type="Text" name="lastName" id="lastName" placeholder="LAST NAME"
                                class="form-control" value="<?php echo $_GET['lname']; ?>">
                            <label for="firstName">FIRST NAME</label>
                            <input type="Text" name="firstName" id="firstName" placeholder="FIRST NAME"
                                class="form-control" value="<?php echo $_GET['fname']; ?>">
                            <label for="middleName">MIDDLE NAME</label>
                            <input type="Text" name="middleName" id="middleName" placeholder="MIDDLE NAME"
                                class="form-control" value="<?php echo $_GET['mname']; ?>">
                            <label for="nickName">NICKNAME</label>
                            <input type="Text" name="nickName" id="nickName" placeholder="NICKNAME" class="form-control"
                                value="<?php echo $_GET['nick']; ?>">
                            <label for="gender">GENDER</label>
                            <select id="gender" name="gender" size="1" class="form-control">

                                <option value="MALE" <?php if (($_GET['sex']) == 'MALE') {
                                    echo 'selected';
                                } ?>>MALE
                                </option>
                                <option value="FEMALE" <?php if (($_GET['sex']) == 'FEMALE') {
                                    echo 'selected';
                                } ?>>FEMALE
                                </option>
                            </select>
                            <label for="birthday">BIRTHDAY</label>
                            <input type="date" name="birthday" id="birthday" class="form-control" placeholder="BIRTHDAY"
                                onchange="computeAge()" value="<?php echo $_GET['birthDate']; ?>">
                            <label for="age">AGE</label>
                            <input type="number" name="age" id="age" placeholder="AGE" class="form-control" readonly
                                value="<?php echo $_GET['age']; ?>">
                            <label for="occupation">OCCUPATION</label>
                            <input type="Text" name="occupation" id="occupation" placeholder="OCCUPATION"
                                class="form-control" value="<?php echo $_GET['occupation']; ?>">
                            <label for="homeAddress">HOME ADDRESS</label>
                            <input type="Text" name="homeAddress" id="homeAddress" placeholder="HOME ADDRESS"
                                class="form-control" value="<?php echo $_GET['homeAddress']; ?>"><br>
                            <label for="contactNumber">CONACT NUMBER</label>
                            <input type="text" id="contactNumber" name="contactNumber" placeholder="CONTACT NUMBER"
                                class="form-control" value="<?php echo $_GET['mobileNumber']; ?>"><br>
                            <hr>
                            <label for="for Minors">FOR MINOR'S ONLY</label>
                            <hr>
                            <label for="guardianName">GUARDIAN NAME</label>
                            <input type="Text" name="guardianName" id="guardianName" placeholder="GUARDIAN NAME"
                                class="form-control" value="<?php echo $_GET['guardianName']; ?>"><br>
                            <label for="guardianOccupation">GUARDIAN OCCUPATION</label>
                            <input type="Text" name="guardianOccupation" id="guardianOccupation"
                                placeholder="GUARDIAN OCCUPATION" class="form-control"
                                value="<?php echo $_GET['gOccupation']; ?>"><br>
                            <label for="referredBy">REFERRED BY</label>
                            <input type="Text" name="referredBy" id="referredBy" placeholder="REFERRED BY"
                                class="form-control" value="<?php echo $_GET['refferedBy']; ?>"><br>
                            <div id="formResult"></div>
                            <button class="btn btn-success" onclick="updatePatientPersonalInfo()">Submit</button>


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
            <script src="controllers/clientProfileUpdateController-v1.js"></script>
</body>

</html>