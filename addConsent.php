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
                            <h6 class="m-0 font-weight-bold">Add Consent</h6>
                        </div>
                        <div class="card-body" id="bodyResult">
                            <input type="hidden" value="<?php echo $_GET['clientid']; ?>" id="clientId">
                            <div class="row">
                                <div class="col-lg-12 d-flex align-items-center">
                                    <img src="img/white_logo_final.jpg" alt="Logo"
                                        style="max-height:100px; margin-right: 20px;">
                                    <div>
                                        <h4 class="mb-1"><strong>Dr. Nikki Sarmiento Dental Care Clinic</strong>
                                        </h4>
                                        <p class="mb-0">Stall B Josefa St. Josefaville 1 Subd Brgy Malabanias
                                            Angeles
                                            City Pampanga PH 2009</p>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-lg-6 d-flex align-items-center">
                                    <strong class="mr-3">Name: </strong>
                                    <?php echo trim($_GET["lname"]) . ', ' . trim($_GET['fname']) . ' ' . trim($_GET['mname']); ?>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center">
                                    <strong class="mr-3">Address: </strong>
                                    <?php echo trim($_GET["homeAddress"]); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 d-flex align-items-center">
                                    <strong class="mr-3">Birthdate: </strong>
                                    <?php echo trim($_GET["birthDate"]); ?>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center">
                                    <strong class="mr-3">Age: </strong>
                                    <?php

                                    $dob = new DateTime($_GET["birthDate"]); // assuming dob is something like '1990-04-15'
                                    $today = new DateTime();
                                    $age = $today->diff($dob)->y;
                                    echo $age;


                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 d-flex align-items-center">
                                    <strong class="mr-3">Gender: </strong>
                                    <?php echo trim($_GET["sex"]); ?>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center">
                                    <strong class="mr-3">Occupation: </strong>
                                    <?php echo trim($_GET["occupation"]); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 d-flex align-items-center">
                                    <strong class="mr-3">Civil Status: </strong>
                                    <?php echo trim($_GET["civilStatus"]); ?>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center">
                                    <strong class="mr-3">Religion: </strong>
                                    <?php echo trim($_GET["religion"]); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 d-flex align-items-center">
                                    <strong class="mr-3">Contact Number: </strong>
                                    <?php echo trim($_GET["mobileNumber"]); ?>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center">
                                    <strong class="mr-3">Referred By: </strong>
                                    <?php echo trim($_GET["refferedBy"]); ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    Please CHECK if you have had or any of the following:
                                </div>
                                <div class="col-lg-12" id="medHistory">


                                </div>
                            </div>

                            <br>

                            <!-- Page Heading -->
                            <h1 class="h3 mb-4  text-center">Informed Consent</h1>

                            <!-- Consent Card -->


                            <div class="text-justify">

                                <p><strong>Treatment To Be Done:</strong> I understand and consent to have
                                    any treatment done by the dentist after the procedure, the risks &
                                    benefits & cost have been fully explained. These treatments include, but
                                    are not limited to, x-rays, cleanings, periodontal treatments, fillings,
                                    crowns, bridges, all types of extraction, root canals, and/or dentures,
                                    local anesthetics & surgical cases.</p>

                                <p><strong>Drugs & Medications:</strong> I understand that antibiotics,
                                    analgesics, and other medications can cause allergic reactions like
                                    redness and swelling of tissues, pain, itching, vomiting, and/or
                                    anaphylactic shock.</p>

                                <p><strong>Changes in Treatment Plan:</strong> I understand that during
                                    treatment it may be necessary to change and add procedures because of
                                    conditions found while working on the teeth that were not discovered
                                    during examination. I give my permission to the dentist to make any/all
                                    changes and additions as necessary with my responsibility to pay all the
                                    costs agreed.</p>

                                <p><strong>Radiograph:</strong> I understand that an x-ray or radiograph may
                                    be necessary as a diagnostic aid, but this does not provide 100%
                                    assurance for treatment accuracy as complications may arise.</p>

                                <p><strong>Removal of Teeth:</strong> I understand the alternatives to tooth
                                    removal and the associated risks. I understand that removing teeth may
                                    not eliminate all infections and that further treatment may be needed. I
                                    accept the risks involved including pain, swelling, dry socket, nerve
                                    damage, and possible need for specialist referral.</p>

                                <p><strong>Crowns and Bridges:</strong> I understand that preparing a tooth
                                    may irritate the nerve and may lead to sensitivity or root canal
                                    therapy. I am aware of limitations with color matching and the risks of
                                    delay in returning for permanent cementation. I accept responsibility
                                    for remakes and final approval before cementation.</p>

                                <p><strong>Endodontics (Root Canal):</strong> I understand root canal
                                    treatment is not guaranteed to save a tooth. Complications may occur. I
                                    accept the risks including file breakage and the need for referral to a
                                    specialist, which may result in additional costs.</p>

                                <p><strong>Periodontal Disease:</strong> I understand the seriousness of
                                    periodontal disease and treatment options. I understand that any dental
                                    procedure can affect periodontal health.</p>

                                <p><strong>Fillings:</strong> I understand the care required post-filling
                                    and the possibility of sensitivity or the need for further treatment
                                    such as crowns or root canals.</p>

                                <p><strong>Dentures:</strong> I understand the challenges with dentures,
                                    especially immediate ones, and the need for adjustments and permanent
                                    relines. I understand the responsibility of returning on time and the
                                    associated fees for delays or modifications.</p>

                                <p><strong>I understand that Dentistry is not an exact science and that no
                                        dentist can properly guarantee accurate results all the
                                        time.</strong></p>

                                <p>I hereby authorize any of the doctors/dental auxiliaries to proceed with
                                    and perform the dental restorations and treatments as explained to me. I
                                    understand that these are subject to modification depending on
                                    undiagnosable circumstances that may arise during the course of
                                    treatment.</p>

                                <p>I understand that regardless of any dental insurance coverage I may have,
                                    I am responsible for payment of dental fees. I agree to pay any
                                    attorney's fees, collection fees, or court costs that may be incurred to
                                    satisfy any obligation to this office.</p>

                                <p>All treatment was properly explained to me, and in case of any untoward
                                    circumstances, I will not hold the attending dentist liable as I am
                                    undergoing this treatment of my own free will and with full trust and
                                    confidence in their care.</p>

                            </div>

                            <!-- Signature Area -->
                            <form class="mt-4">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="dateSigned">Date</label>
                                        <input type="date" class="form-control" id="dateSigned">
                                        <label>Patient's/Guardian's Signature</label>
                                        <div class="border rounded p-3 signature-box"
                                            style="height: 80px; cursor: pointer;" id="patient-signature-box" onclick="openSignatureModal(function(sigData) {
                 setSignature('patient', sigData);
             })">
                                        </div>
                                        <input type="hidden" name="patient_signature" id="patient-signature-input">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="patientName">Dentist's Name</label>
                                        <input type="text" class="form-control" id="dentistName"
                                            placeholder="Enter full name" value="Dr. Nikki Sarmiento" readonly>
                                        <label>Dentist Signature</label>
                                        <div class="border rounded p-3 signature-box"
                                            style="height: 80px; cursor: pointer;" id="dentist-signature-box">
                                            <img src="img/e-sign.png" alt="${role} signature"
                                                style="height: 100%; width: auto; display: block; margin: 0 auto;">

                                        </div>
                                        <input type="hidden" name="dentist_signature" id="dentist-signature-input">
                                    </div>

                                </div>

                                <div class="form-row mt-3">
                                    <div class="form-group col-md-6">
                                    </div>
                                    <div class="form-group col-md-6">

                                    </div>
                                </div>


                            </form>



                            <div id="signature-modal">
                                <div class="modal-content">
                                    <h3>Draw your Signature</h3>
                                    <canvas id="signature-pad"></canvas><br>
                                    <button onclick="clearPad()">Clear</button>
                                    <button onclick="confirmSignature()">Done</button>
                                    <button onclick="closeSignatureModal()">Cancel</button>
                                </div>
                            </div>

                            <footer class="sticky-footer">
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto">
                                        <a href="#" class="btn btn-success btn-icon-split" onclick="addConsent()">
                                            <span class="icon text-white-50"><i class="fas fa-fw fa-save"></i></span>
                                            <span class="text">Save</span>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-icon-split"
                                            onclick="window.location.href='clientProfileList.php'">
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
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>
            <script src="controllers/logOutConroller.js"></script>
            <script src="controllers/sessionController.js"></script>
            <script src="controllers/consentAddController.js"></script>
            <script src="js/signature.js"></script>
            <script src="js/custom-v2.js"></script>
</body>

</html>