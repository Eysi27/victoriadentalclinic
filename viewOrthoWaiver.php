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
                        <div class="card-header <?php echo $cards; ?>">
                            View Orthodontics Waiver

                            <button id="divPrinter" class="btn btn-success btn-sm btn-circle float-right"
                                onclick="printDiv('bodyResult')" title="Print E-SOA"><i
                                    class="fas fa-print"></i></button>
                        </div>
                        <div class="card-body" id="bodyResult">

                            <input type="hidden" value="<?php echo $_GET['clientId']; ?>" id="clientId">

                            <div style="display: flex; align-items: center; margin-left: 50px;">
                                <img src="img/white_logo_final.jpg" alt="Logo"
                                    style="max-height: 100px; margin-right: 20px;">
                                <div>
                                    <h4 style="margin-bottom: 5px; font-weight: bold;">Dr. Nikki Sarmiento Dental Care
                                        Clinic</h4>
                                    <p style="margin: 0;">
                                        Stall B Josefa St. Josefaville 1 Subd Brgy Malabanias<br>
                                        Angeles City Pampanga PH 2009
                                        <br>
                                        0927-605-8418 / 0960-437-5938
                                    </p>
                                </div>
                            </div>


                            <!-- Page Heading -->
                            <div style="text-align:center;">
                                <h1 class="h3">Patient Informed Consent and Information</h1>
                                <p><strong>Potential Risks and Limitations of Orthodontic Treatment </strong></p>

                            </div>


                            <!-- Consent Card -->
                            <div style="margin-left:50px;margin-right:50px;text-align:justify;">



                                <p>We appreciate your confidence in choosing our clinic for your orthodontic treatment.
                                    We want you to be fully informed and invite you to inquire about your treatment at
                                    any time.</p>

                                <p>As a rule, excellent orthodontic results can be achieved with informed and
                                    cooperative patients. Thus, the following information is given to anyone considering
                                    orthodontic treatment in our office. While recognizing the benefits of a pleasing
                                    smile and healthy teeth, you should also be aware that orthodontic treatment has
                                    some risks and limitations. These seldom are enough to contraindicate treatment, but
                                    should be considered in making the decision to undergo orthodontic treatment.</p>

                                <p><strong>1. Oral Hygiene:</strong> Immaculate oral hygiene is a must during
                                    orthodontic treatment. Failure to brush and floss thoroughly every day may result in
                                    decalcifications (permanent white markings on teeth), decay, or gum disease. Food
                                    containing sugars and between-meal snacks should be avoided.</p>

                                <p><strong>2. Non-vital Tooth:</strong> A non-vital (“dead”) tooth is a possibility on
                                    rare occasions. An undetected non-vital tooth may flare up during orthodontic
                                    treatment, necessitating root canal treatment. In some cases, canker sores or
                                    allergic reactions are also a possibility.</p>

                                <p><strong>3. Root Resorption:</strong> Root desorption can occur in some cases. This is
                                    the shortening of the ends of the roots of teeth. Normally, shortened roots are not
                                    disadvantaged. However, should the patient experience gum disease in later years,
                                    severely shortened roots may reduce the longevity of the affected teeth. Root
                                    resorption can also result from trauma, cuts, impactions, endocrine disorders, or
                                    unknown causes.</p>

                                <p><strong>4. Headgear Use:</strong> Headgear instructions must be followed carefully
                                    for safety, as well as for optimum orthodontic results. The patient must release the
                                    elastic as instructed.</p>

                                <p><strong>5. TMJ Issues:</strong> Problems with accompanying pain in the
                                    Temporomandibular Joint (TMJ), also called the “jaw joint,” are also a possibility.
                                    Many times, orthodontic treatment can improve existing TMJ pain, but not in all
                                    cases. Stress and tension are also a factor in some TMJ problems.</p>

                                <p><strong>6. Treatment Compromise:</strong> Occasionally, treatment objectives may have
                                    to be compromised. If growth in either of the jaws becomes disproportionate, the jaw
                                    relationship can be affected. This skeletal growth disharmony is genetically coded
                                    and beyond our control. It may also become necessary to stop orthodontic treatment
                                    short of the desired final result if non-compliance with oral hygiene causes
                                    extensive decay. In either case, it will be discussed thoroughly with the patient
                                    and/or parent before treatment is discontinued.</p>

                                <p><strong>7. Relapse:</strong> Teeth have a tendency to relapse toward their original
                                    position following active orthodontic treatment. Full cooperation in wearing
                                    retainers is necessary to reduce this tendency. When retainer use is discontinued,
                                    some relapse is still possible.</p>

                                <p><strong>8. Treatment Duration:</strong> The total time of treatment may extend beyond
                                    our original estimate. Lack of facial growth, poor patient compliance, broken
                                    appliances, and missed appointments are all factors that may lengthen the treatment
                                    time.</p>

                                <p><strong>9. Dental Maintenance:</strong> Regular cleanings and check-ups at six-month
                                    intervals, or more frequently if needed, will still be necessary to maintain the
                                    teeth in good health.</p>

                                <p>I have read and understand this letter of information and hereby give consent to the
                                    orthodontic treatment recommended by my dentist.</p>

                            </div>



                            <!-- Signature Area -->
                            <form>
                                <div style="display: flex; flex-wrap: wrap; margin-left: 50px;" id="waiverDetails">

                                </div>





                            </form>








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
            <script src="controllers/orthowaiverController.js"></script>
            <script src="controllers/divPrinterController-v1.js"></script>

            <script src="js/custom-v2.js"></script>
</body>

</html>