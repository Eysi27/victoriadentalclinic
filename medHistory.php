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
                            <h6 class="m-0 font-weight-bold">Client Medical History -
                                <?php echo ucwords($_GET['clientname']); ?>
                            </h6>
                        </div>
                        <input type="hidden" value="<?php echo $_GET['clientid']; ?>" id="clientId" class="form-control"
                            readonly>
                        <div class="card-body" id="bodyResult" style="padding-right:10%;padding-left:10%">
                            <div class="form-group">
                                <label class="form-label">Medical Conditions (Check all that apply):</label>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q1" name="q1"
                                                value="High Blood Pressure">
                                            <label class="form-check-label" for="q1">High Blood Pressure</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q2" name="q2"
                                                value="Low Blood Pressure">
                                            <label class="form-check-label" for="q2">Low Blood Pressure</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q3" name="q3"
                                                value="Epilepsy/Convulsions">
                                            <label class="form-check-label" for="q3">Epilepsy/Convulsions</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q4" name="q4"
                                                value="AIDS/HIV Infection">
                                            <label class="form-check-label" for="q4">AIDS/HIV Infection</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q5" name="q5"
                                                value="Sexually Transmitted Disease (STD)">
                                            <label class="form-check-label" for="q5">Sexually Transmitted Disease
                                                (STD)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q6" name="q6"
                                                value="Stomach Troubles/Ulcers">
                                            <label class="form-check-label" for="q6">Stomach Troubles/Ulcers</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q7" name="q7"
                                                value="Fainting Seizures">
                                            <label class="form-check-label" for="q7">Fainting Seizures</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q8" name="q8"
                                                value="Rapid Weight Loss">
                                            <label class="form-check-label" for="q8">Rapid Weight Loss</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q9" name="q9"
                                                value="Heart Problems">
                                            <label class="form-check-label" for="q9">Heart Problems</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q10" name="q10"
                                                value="Heart Murmur">
                                            <label class="form-check-label" for="q10">Heart Murmur</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q11" name="q11"
                                                value="Pacemaker">
                                            <label class="form-check-label" for="q11">Pacemaker</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q12" name="q12"
                                                value="Hepatitis">
                                            <label class="form-check-label" for="q12">Hepatitis</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q13" name="q13"
                                                value="Rheumatic Fever">
                                            <label class="form-check-label" for="q13">Rheumatic Fever</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q14" name="q14"
                                                value="Hay Fever/Allergies">
                                            <label class="form-check-label" for="q14">Hay Fever/Allergies</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q15" name="q15"
                                                value="Respiratory Problems">
                                            <label class="form-check-label" for="q15">Respiratory Problems</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q16" name="q16"
                                                value="Tuberculosis">
                                            <label class="form-check-label" for="q16">Tuberculosis</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q17" name="q17"
                                                value="Diabetes">
                                            <label class="form-check-label" for="q17">Diabetes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q18" name="q18"
                                                value="Anemia">
                                            <label class="form-check-label" for="q18">Anemia</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q19" name="q19"
                                                value="Asthma">
                                            <label class="form-check-label" for="q19">Asthma</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q20" name="q20"
                                                value="Cancer">
                                            <label class="form-check-label" for="q20">Cancer</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q21" name="q21"
                                                value="Liver Disease">
                                            <label class="form-check-label" for="q21">Liver Disease</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q22" name="q22"
                                                value="Kidney Disease">
                                            <label class="form-check-label" for="q22">Kidney Disease</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q23" name="q23"
                                                value="Blood Diseases">
                                            <label class="form-check-label" for="q23">Blood Diseases</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q24" name="q24"
                                                value="Stroke">
                                            <label class="form-check-label" for="q24">Stroke</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q25" name="q25"
                                                value="Thyroid Problem">
                                            <label class="form-check-label" for="q25">Thyroid Problem</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q26" name="q26"
                                                value="Emphysema">
                                            <label class="form-check-label" for="q26">Emphysema</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <strong>Others, Please specify:</strong>
                                        <input type="text" class="form-control" id="q27" placeholder="Others, Specify">
                                    </div>
                                </div>
                                <hr>


                            </div>
                            <div id="formResult"></div>
                            <footer class="sticky-footer">
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto">
                                        <a href="#" class="btn btn-success btn-icon-split"
                                            onclick="addMedHistoryProfile()">
                                            <span class="icon text-white-50"><i class="fas fa-fw fa-save"></i></span>
                                            <span class="text">Save</span>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-icon-split"
                                            onclick="location.replace('clientProfileList.php');">
                                            <span class="icon text-white-50"><i class="fas fa-fw fa-times"></i></span>
                                            <span class="text">Cancel</span>
                                        </a>
                                    </div>
                                </div>
                            </footer>



                            <!-- END OF YOUR ADDITIONAL CODE SNIPPET -->
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include_once('bars/footer.php'); ?>

            <!-- Bootstrap core JavaScript-->
            <script src=" vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <script src="js/custom-v2.js"></script>
            <script src="controllers/logOutConroller.js"></script>
            <script src="controllers/sessionController.js"></script>
            <script src="controllers/medHistoryRegController.js"></script>



</body>

</html>