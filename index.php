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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (with Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


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

                    <div class="col-lg-12 d-flex align-items-center justify-content-between">
                        <!-- Left Side: Logo and Clinic Info -->
                        <div class="d-flex align-items-center">
                            <img src="img/vadc_whitebg.png" alt="Logo"
                                style="max-height:100px; margin-right: 20px;">
                            <div>
                                <h4 class="mb-1"><strong>Victoria Advanced Dental Care</strong></h4>
                                <p class="mb-0">101 Iriga, Iriga City, Camarines Sur</p>
                            </div>
                        </div>

                        <!-- Right Side: Back Button -->
                        <a href="waiver.php" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50"><i class="fas fa-fw fa-sign"></i></span>
                            <span class="text">Ortho Waiver</span>
                        </a>
                    </div>


                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs" id="myTabs" role="tablist" style="display:none;">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab"
                                aria-controls="tab1" aria-selected="false">Step 1</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab"
                                aria-controls="tab2" aria-selected="false">Step 2</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab"
                                aria-controls="tab3" aria-selected="false">Step 3</a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-4" id="myTabsContent">

                        <!-- Tab 1 -->
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                            <div class="card shadow mb-12">
                                <div class="card-header py-3 <?php echo $cards; ?>">
                                    <h6 class="m-0 font-weight-bold">PATIENT REGISTRATION</h6>
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
                                                    <canvas id="canvas" width="400" height="400"
                                                        style="display:none;"></canvas>
                                                    <img id="photoPreview" src="img/profilepic.png"
                                                        onclick="openCameraModal()" class="img-fluid rounded mb-2"
                                                        style="cursor:pointer;" />
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
                                                <input type="text" name="firstName" id="firstName"
                                                    placeholder="First Name" class="form-control mb-2">

                                                <label for="middleName">Middle Name</label>
                                                <input type="text" name="middleName" id="middleName"
                                                    placeholder="Middle Name" class="form-control mb-2">

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

                                                <label for="emailAddress">Email Address</label>
                                                <input type="text" name="emailAddress" id="emailAddress"
                                                    placeholder="Email Address" class="form-control mb-2">


                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Birth Info -->
                                            <div class="col-lg-4 mb-4">
                                                <label for="birthday">Birthday</label>
                                                <input type="date" name="birthday" id="birthday"
                                                    class="form-control mb-2" onchange="computeAge()">

                                                <label for="age">Age</label>
                                                <input type="number" name="age" id="age" placeholder="Age"
                                                    class="form-control mb-2" readonly>

                                                <label for="occupation">Occupation</label>
                                                <input type="text" name="occupation" id="occupation"
                                                    placeholder="Occupation" class="form-control mb-2">
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
                                                <input type="text" name="referredBy" id="referredBy"
                                                    placeholder="Referred By" class="form-control mb-2">
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
                                                    <option value="Cocolife">Cocolife</option>
                                                    <option value="Medicard">Medicard</option>
                                                    <option value="Flexicare">Flexicare</option>
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
                                                <input type="text" name="company" id="company"
                                                    placeholder="Company Name" class="form-control mb-2">

                                            </div>
                                        </div>

                                        <div id="formResult"></div>
                                        <footer class="sticky-footer">
                                            <div class="container my-auto">
                                                <div class="copyright text-center my-auto">


                                                    <a class="btn btn-success btn-icon-split"
                                                        onclick="addPatientPersonalInfo();"> <span
                                                            class="icon text-white-50"><i
                                                                class="fas fa-fw fa-arrow-right"></i></span>
                                                        <span class="text">Next</span></a>

                                                </div>
                                            </div>
                                        </footer>

                                    </div>



                                </div>
                                <!-- /.container-fluid -->
                            </div>
                        </div>

                        <!-- Tab 2 -->
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                            <div class="card shadow mb-12">
                                <div class="card-header py-3 <?php echo $cards; ?>">
                                    <h6 class="m-0 font-weight-bold">Patient History
                                    </h6>
                                </div>
                                <div class="card-body" id="bodyResult" style="padding-right:10%;padding-left:10%">
                                    <div class="form-group">
                                        <h6 class="mb-3 text-center">Dental History</h6>
                                        <div class="row">
                                            <div class="col-lg-6 mb-6">
                                                <label for="cardNumber">Previous Dentist: </label>
                                                <input type="text" name="prevDentist" id="prevDentist"
                                                    placeholder="Prev Dentist Full name" class="form-control mb-2">

                                            </div>
                                            <div class="col-lg-6 mb-6">
                                                <label for="cardNumber">Last Dental Visit: </label>
                                                <input type="date" name="lastDentalVisit" id="lastDentalVisit"
                                                    placeholder="Please specify" class="form-control mb-2">
                                            </div>

                                        </div>
                                        <hr>
                                        <h6 class="mb-3 text-center">Medical History</h6>
                                        <div class="row">
                                            <div class="col-lg-6 mb-6">
                                                <label for="cardNumber">Name of Physician :</label>
                                                <input type="text" name="physician" id="physician"
                                                    placeholder="Physician Full name" class="form-control mb-2">

                                            </div>
                                            <div class="col-lg-6 mb-6">
                                                <label for="cardNumber">Specialty, if applicable: </label>
                                                <input type="text" name="specialty" id="specialty"
                                                    placeholder="Please specify" class="form-control mb-2">

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 mb-6">
                                                <label for="cardNumber">Office Address:</label>
                                                <input type="text" name="officeAddress" id="officeAddress"
                                                    placeholder="Office Address" class="form-control mb-2">

                                            </div>
                                            <div class="col-lg-6 mb-6">
                                                <label for="cardNumber">Office Number:</label>
                                                <input type="text" name="officeNumber" id="officeNumber"
                                                    placeholder="Office Number" class="form-control mb-2">

                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label class="form-label mb-0">1. Are you in good
                                                        health?</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="goodHealth"
                                                        id="goodHealthYes" value="yes">
                                                    <label class="form-check-label" for="goodHealthYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="goodHealth"
                                                        id="goodHealthNo" value="no">
                                                    <label class="form-check-label" for="goodHealthNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- Question Label -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <label class="form-label mb-0">2. Are you under medical
                                                        treatment
                                                        now?</label>
                                                </div>
                                            </div>

                                            <!-- Yes/No Options -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="underTreatment"
                                                        id="underTreatmentYes" value="yes"
                                                        onclick="toggleCondition(true,'treatmentCondition')">
                                                    <label class="form-check-label" for="underTreatmentYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="underTreatment"
                                                        id="underTreatmentNo" value="no"
                                                        onclick="toggleCondition(false,'treatmentCondition')">
                                                    <label class="form-check-label" for="underTreatmentNo">No</label>
                                                </div>
                                            </div>

                                            <!-- Conditional Input Field -->
                                            <div class="col-lg-12 mb-3">
                                                <label for="treatmentCondition" class="form-label">-If so, what is
                                                    the
                                                    condition being treated?</label>
                                                <input type="text" id="treatmentCondition" name="treatmentCondition"
                                                    class="form-control" placeholder="Describe the condition" disabled>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Question Label -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <label class="form-label mb-0">3. Have you ever had serious
                                                        illness
                                                        or surgical operation?</label>
                                                </div>
                                            </div>

                                            <!-- Yes/No Options -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="seriousIllness"
                                                        id="seriousIllnessYes" value="yes"
                                                        onclick="toggleCondition(true, 'illnessCondition')">
                                                    <label class="form-check-label" for="seriousIllnessYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="seriousIllness"
                                                        id="seriousIllnessNo" value="no"
                                                        onclick="toggleCondition(false, 'illnessCondition')">
                                                    <label class="form-check-label" for="seriousIllnessNo">No</label>
                                                </div>
                                            </div>

                                            <!-- Conditional Input Field -->
                                            <div class="col-lg-12 mb-3">
                                                <label for="illnessCondition" class="form-label">- If so, what
                                                    illness
                                                    or operation?</label>
                                                <input type="text" id="illnessCondition" name="illnessCondition"
                                                    class="form-control" placeholder="Describe the illness or operation"
                                                    disabled>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Question Label -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <label class="form-label mb-0">4. Have you ever been
                                                        hospitalized?</label>
                                                </div>
                                            </div>

                                            <!-- Yes/No Options -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="hospitalized"
                                                        id="hospitalizedYes" value="yes"
                                                        onclick="toggleCondition(true, 'hospitalizedCondition')">
                                                    <label class="form-check-label" for="hospitalizedYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="hospitalized"
                                                        id="hospitalizedNo" value="no"
                                                        onclick="toggleCondition(false, 'hospitalizedCondition')">
                                                    <label class="form-check-label" for="hospitalizedNo">No</label>
                                                </div>
                                            </div>

                                            <!-- Conditional Input Field -->
                                            <div class="col-lg-12 mb-3">
                                                <label for="hospitalizedCondition" class="form-label">- If so, when
                                                    and
                                                    why?</label>
                                                <input type="text" id="hospitalizedCondition"
                                                    name="hospitalizedCondition" class="form-control"
                                                    placeholder="Provide the date and reason for hospitalization"
                                                    disabled>
                                            </div>
                                        </div>
                                        <!--5-->
                                        <div class="row">
                                            <!-- Question Label -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <label class="form-label mb-0">5. Are you taking any
                                                        prescription/non-prescription medication?</label>
                                                </div>
                                            </div>

                                            <!-- Yes/No Options -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="medication"
                                                        id="medicationYes" value="yes"
                                                        onclick="toggleCondition(true, 'medicationCondition')">
                                                    <label class="form-check-label" for="medicationYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="medication"
                                                        id="medicationNo" value="no"
                                                        onclick="toggleCondition(false, 'medicationCondition')">
                                                    <label class="form-check-label" for="medicationNo">No</label>
                                                </div>
                                            </div>

                                            <!-- Conditional Input Field -->
                                            <div class="col-lg-12 mb-3">
                                                <label for="medicationCondition" class="form-label">- If so, please
                                                    specify:</label>
                                                <input type="text" id="medicationCondition" name="medicationCondition"
                                                    class="form-control" placeholder="List medications being taken"
                                                    disabled>
                                            </div>
                                        </div>
                                        <!--6-->
                                        <div class="row">
                                            <!-- Question Label -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <label class="form-label mb-0">6. Do you use tobacco
                                                        products?</label>
                                                </div>
                                            </div>

                                            <!-- Yes/No Options -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tobaccoUse"
                                                        id="tobaccoUseYes" value="yes">
                                                    <label class="form-check-label" for="tobaccoUseYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tobaccoUse"
                                                        id="tobaccoUseNo" value="no">
                                                    <label class="form-check-label" for="tobaccoUseNo">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!--7-->
                                        <div class="row">
                                            <!-- Question Label -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <label class="form-label mb-0">7. Do you use alcohol, cocaine or
                                                        other dangerous drugs?</label>
                                                </div>
                                            </div>

                                            <!-- Yes/No Options -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="substanceUse"
                                                        id="substanceUseYes" value="yes">
                                                    <label class="form-check-label" for="substanceUseYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="substanceUse"
                                                        id="substanceUseNo" value="no">
                                                    <label class="form-check-label" for="substanceUseNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--8-->
                                        <div class="row">
                                            <!-- Question Label -->
                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label mb-0">8. Are you allergic to any of the
                                                    following:</label>
                                            </div>

                                            <!-- Yes/No Radio Buttons -->
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="allergicTo"
                                                        id="allergicToYes" value="yes"
                                                        onclick="toggleConditionCheck(true, 'allergyOptions')">
                                                    <label class="form-check-label" for="allergicToYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="allergicTo"
                                                        id="allergicToNo" value="no"
                                                        onclick="toggleConditionCheck(false, 'allergyOptions')">
                                                    <label class="form-check-label" for="allergicToNo">No</label>
                                                </div>
                                            </div>

                                            <!-- Allergy Options -->
                                            <div class="col-lg-12 mb-3" id="allergyOptions" style="display: block;">

                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="allergyLocalAnesthetic" name="allergies"
                                                                value="Local Anesthetic">
                                                            <label class="form-check-label"
                                                                for="allergyLocalAnesthetic">Local Anesthetic (ex.
                                                                Lidocaine)</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="allergyAspirin" name="allergies" value="Aspirin">
                                                            <label class="form-check-label"
                                                                for="allergyAspirin">Aspirin</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="allergyPenicillin" name="allergies"
                                                                value="Penicillin">
                                                            <label class="form-check-label"
                                                                for="allergyPenicillin">Penicillin /
                                                                Antibiotics</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="allergyLatex" name="allergies" value="Latex">
                                                            <label class="form-check-label"
                                                                for="allergyLatex">Latex</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="allergySulfa" name="allergies" value="Sulfa">
                                                            <label class="form-check-label" for="allergySulfa">Sulfa
                                                                Drugs</label>
                                                        </div>
                                                        <!-- Others Checkbox -->
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="allergyOthers" name="allergies" value="Others"
                                                                onchange="toggleSpecifyInput(this, 'otherAllergySpecify')">
                                                            <label class="form-check-label"
                                                                for="allergyOthers">Others</label>
                                                        </div>

                                                        <!-- Input to specify other allergies -->
                                                        <div class="mt-2" id="otherAllergySpecify"
                                                            style="display: none;">
                                                            <input type="text" class="form-control"
                                                                id="otherAllergyField" name="otherAllergyDetail"
                                                                placeholder="Please specify other allergy">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--9-->
                                        <div class="row">
                                            <div class="col-lg-12 mb-2">
                                                <label class="form-label fw-bold">9. For women only:</label>
                                            </div>

                                            <!-- Are you pregnant? -->
                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label mb-0">Are you pregnant?</label>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="pregnant"
                                                        id="pregnantYes" value="yes">
                                                    <label class="form-check-label" for="pregnantYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="pregnant"
                                                        id="pregnantNo" value="no">
                                                    <label class="form-check-label" for="pregnantNo">No</label>
                                                </div>
                                            </div>

                                            <!-- Are you breastfeeding? -->
                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label mb-0">Are you breastfeeding?</label>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="nursing"
                                                        id="nursingYes" value="yes">
                                                    <label class="form-check-label" for="nursingYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="nursing"
                                                        id="nursingNo" value="no">
                                                    <label class="form-check-label" for="nursingNo">No</label>
                                                </div>
                                            </div>

                                            <!-- Are you taking birth control pills? -->
                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label mb-0">Are you taking birth control
                                                    pills?</label>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="birthControl"
                                                        id="birthControlYes" value="yes">
                                                    <label class="form-check-label" for="birthControlYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="birthControl"
                                                        id="birthControlNo" value="no">
                                                    <label class="form-check-label" for="birthControlNo">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <label class="form-label"><strong>Medical Conditions (Check all that
                                                apply):</strong></label>

                                        <div class="row">
                                            <!-- Column 1 -->
                                            <div class="col-md-4">
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q1" name="q1" value="High Blood Pressure"><label
                                                        class="form-check-label" for="q1">High Blood Pressure</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q2" name="q2" value="Low Blood Pressure"><label
                                                        class="form-check-label" for="q2">Low Blood Pressure</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q3" name="q3" value="Epilepsy / Convulsions"><label
                                                        class="form-check-label" for="q3">Epilepsy /
                                                        Convulsions</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q4" name="q4" value="AIDS or HIV Infection"><label
                                                        class="form-check-label" for="q4">AIDS or HIV
                                                        Infection</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q5" name="q5" value="Sexually Transmitted disease"><label
                                                        class="form-check-label" for="q5">Sexually Transmitted
                                                        disease</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q6" name="q6" value="Stomach Troubles / Ulcers"><label
                                                        class="form-check-label" for="q6">Stomach Troubles /
                                                        Ulcers</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q7" name="q7" value="Fainting Seizure"><label
                                                        class="form-check-label" for="q7">Fainting Seizure</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q8" name="q8" value="Rapid Weight Loss"><label
                                                        class="form-check-label" for="q8">Rapid Weight Loss</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q9" name="q9" value="Heart Disease"><label
                                                        class="form-check-label" for="q9">Heart Disease</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q10" name="q10" value="Heart Murmur"><label
                                                        class="form-check-label" for="q10">Heart Murmur</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q11" name="q11" value="Hepatitis / Liver Disease"><label
                                                        class="form-check-label" for="q11">Hepatitis / Liver
                                                        Disease</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q12" name="q12" value="Rheumatic Fever"><label
                                                        class="form-check-label" for="q12">Rheumatic Fever</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q13" name="q13" value="Hay Fever / Allergies"><label
                                                        class="form-check-label" for="q13">Hay Fever /
                                                        Allergies</label>
                                                </div>
                                            </div>

                                            <!-- Column 2 -->
                                            <div class="col-md-4">
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q14" name="q14" value="Respiratory Problems"><label
                                                        class="form-check-label" for="q14">Respiratory Problems</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q15" name="q15" value="Hepatitis / Jaundice"><label
                                                        class="form-check-label" for="q15">Hepatitis / Jaundice</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q16" name="q16" value="Tuberculosis"><label
                                                        class="form-check-label" for="q16">Tuberculosis</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q17" name="q17" value="Radiation Therapy"><label
                                                        class="form-check-label" for="q17">Radiation Therapy</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q18" name="q18" value="Swollen ankles"><label
                                                        class="form-check-label" for="q18">Swollen ankles</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q19" name="q19" value="Joint Replacement / Implant"><label
                                                        class="form-check-label" for="q19">Joint Replacement /
                                                        Implant</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q20" name="q20" value="Kidney disease"><label
                                                        class="form-check-label" for="q20">Kidney disease</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q21" name="q21" value="Heart Surgery"><label
                                                        class="form-check-label" for="q21">Heart Surgery</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q22" name="q22" value="Diabetes"><label
                                                        class="form-check-label" for="q22">Diabetes</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q23" name="q23" value="Heart Attack"><label
                                                        class="form-check-label" for="q23">Heart Attack</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q24" name="q24" value="Chest pain"><label
                                                        class="form-check-label" for="q24">Chest pain</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q25" name="q25" value="Thyroid Problem"><label
                                                        class="form-check-label" for="q25">Thyroid Problem</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q26" name="q26" value="Stroke"><label
                                                        class="form-check-label" for="q26">Stroke</label></div>
                                            </div>

                                            <!-- Column 3 -->
                                            <div class="col-md-4">
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q27" name="q27" value="Cancer / Tumors"><label
                                                        class="form-check-label" for="q27">Cancer / Tumors</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q28" name="q28" value="Anemia"><label
                                                        class="form-check-label" for="q28">Anemia</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q29" name="q29" value="Angina"><label
                                                        class="form-check-label" for="q29">Angina</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q30" name="q30" value="Asthma"><label
                                                        class="form-check-label" for="q30">Asthma</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q31" name="q31" value="Emphysema"><label
                                                        class="form-check-label" for="q31">Emphysema</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q32" name="q32" value="Bleeding Problems"><label
                                                        class="form-check-label" for="q32">Bleeding Problems</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q33" name="q33" value="Blood Diseases"><label
                                                        class="form-check-label" for="q33">Blood Diseases</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q34" name="q34" value="Head Injuries"><label
                                                        class="form-check-label" for="q34">Head Injuries</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q35" name="q35" value="Arthritis / Rheumatism"><label
                                                        class="form-check-label" for="q35">Arthritis /
                                                        Rheumatism</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q36" name="q36" value="Rapid Weight Loss"><label
                                                        class="form-check-label" for="q36">Rapid Weight Loss</label>
                                                </div>

                                                <!-- Other (Specify) -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="q37" name="q37"
                                                        value="Other"
                                                        onclick="document.getElementById('otherCondition').disabled = !this.checked;">
                                                    <label class="form-check-label" for="q37">Other</label>
                                                </div>
                                                <input type="text" id="otherCondition" name="otherCondition"
                                                    class="form-control mt-2" placeholder="Specify other condition"
                                                    disabled>
                                            </div>
                                        </div>


                                        <hr>


                                    </div>
                                    <div id="formResult"></div>
                                    <footer class="sticky-footer">
                                        <div class="container my-auto">
                                            <div class="copyright text-center my-auto">
                                                <a class="btn btn-danger btn-icon-split"
                                                    onclick="switchToTab1('tab1-tab')">
                                                    <span class="icon text-white-50"><i
                                                            class="fas fa-fw fa-arrow-left"></i></span>
                                                    <span class="text">Back</span></a>
                                                <a class="btn btn-success btn-icon-split"
                                                    onclick="validateHealthForm();">
                                                    <span class="icon text-white-50"><i
                                                            class="fas fa-fw fa-arrow-right"></i></span>
                                                    <span class="text">Next</span></a>


                                            </div>
                                        </div>
                                    </footer>


                                    <!-- USE THIS SPACE FOR YOUR ADDITIONAL CODE SNIPPET -->


                                    <!-- END OF YOUR ADDITIONAL CODE SNIPPET -->
                                </div>
                            </div>
                        </div>
                        <!--tab 3-->
                        <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">




                            <!-- Page Heading -->
                            <h1 class="h3 mb-4 text-center">Informed Consent</h1>

                            <!-- Consent Card -->
                            <div class="text-justify" style="margin:50px;">

                                <p><strong>TREATMENT TO BE DONE:</strong> I understand and consent to have any treatment
                                    done by the dentist after the procedure, the risks & benefits & cost have been fully
                                    explained. These treatments include, but are not limited to, x-rays, cleanings,
                                    periodontal treatments, fillings, crowns, bridges, all types of extraction, root
                                    canals, and or dentures, local anesthetics & surgical cases.</p>

                                <p><strong>DRUGS & MEDICATIONS:</strong> I understand that antibiotics, analgesics, and
                                    other medications can cause allergic reactions like redness and swelling of tissues,
                                    pain, itching, vomiting, and or anaphylactic shock. </p>

                                <p><strong>CHANGES IN TREATMENT PLAN:</strong> I understand that during treatment it may
                                    be necessary to change and add procedures because of conditions found while working
                                    on the teeth that were not discovered during examination. For example, root canal
                                    therapy may be needed following routine restorative procedures. I give my permission
                                    to the dentist to make any/all changes and additions as necessary with my
                                    responsibility to pay all the costs agreed.
                                </p>

                                <p><strong>RADIOGRAPH:</strong> I understand that an x-ray shot or a radiograph may be
                                    necessary as part of diagnostic aid to come up with tentative diagnosis of my dental
                                    problem and to make a good treatment plan but this will not give me a 100% assurance
                                    for the accuracy of the treatment since all dental treatments are subject to
                                    unpredictable complications that later on may lead to sudden change of treatment
                                    plan and subject to new charges.</p>

                                <p><strong>REMOVAL OF TEETH:</strong> I understand the alternatives to tooth removal
                                    (root canal therapy, crowns & periodontal surgery, etc.) and I completely understand
                                    these alternatives, including their risk and benefits prior to authorizing the
                                    dentist to remove teeth and any other structures necessary for reasons above. I
                                    understand that removing teeth does not always remove all the infections, if present
                                    and it may be necessary to have further treatment. I understand the risk involved in
                                    having teeth removed, such as pain, swelling, spread of infection, dry socket, and
                                    fractured jaw, loss of feeling on the teeth, lips, tongue and surrounding tissue
                                    that can last for an indefinite period of time. I understand that I may need further
                                    treatment under a specialist if complications arise during or following treatment.
                                </p>

                                <p><strong>CROWNS AND BRIDGES:</strong> Preparing a tooth may irritate the nerve tissue
                                    in the center of the tooth, leaving the tooth extra sensitive to heat, cold &
                                    pressure. Treating such irritation may involve using special toothpastes, mouth
                                    rinses or root canal therapy. I understand that sometimes it is not possible to
                                    match the color of natural teeth exactly with artificial teeth and further
                                    understand that I may be wearing temporary crowns which may come off easily and that
                                    I must be careful to ensure that they are kept on until the permanent crowns are
                                    delivered. It is my responsibility to return for permanent cementation within 20
                                    days from tooth preparation, as excessive delay may allow for tooth movement, which
                                    may necessitate a remake of the crown, bridge and cap. I understand there will be
                                    additional charges for remakes due to my delaying of permanent cementation. I
                                    realize that final opportunity to make changes in my new crown, bridges or cap
                                    (including shape, fit, size & color) will be before permanent cementation.
                                </p>

                                <p><strong>ENDODONTICS (ROOT CANAL):</strong> I understand there is no guarantee that a
                                    root canal treatment will save a tooth & that complications can occur from the
                                    treatment and that occasionally root canal filling materials may extend through the
                                    tooth which does not necessarily affect the success of the treatment. I understand
                                    that endodontic files & drills are very fine instruments & stresses vented in their
                                    manufacture and calcifications present in teeth can cause them to break during use.
                                    I understand that referral to the endodontist for additional treatments may be
                                    necessary following any root canal treatment & I agree that I am responsible for any
                                    additional cost for treatment performed by the endodontist. I understand that a
                                    tooth may require removal in spite of all efforts to save it. </p>

                                <p><strong>PERIODONTAL DISEASE:</strong> I understand that periodontal disease is a
                                    serious condition causing gum & bone inflammation or loss and that can lead
                                    eventually to the loss of my teeth. I understand the alternative treatment plans to
                                    correct periodontal disease, including gum surgery, tooth extractions with or
                                    without replacement. I understand that undertaking any dental procedures may have
                                    future adverse effect on my periodontal conditions. </p>

                                <p><strong>FILLINGS:</strong> I understand that care must be exercised in chewing on
                                    fillings, especially during the first 24 hours to avoid breakage. I understand that
                                    a more extensive filling or a crown may be required, as additional decay or fracture
                                    may become evident after initial excavation. I understand that significant
                                    sensitivity is a common but usually temporary, after-effect of a newly placed
                                    filling. I further understand that filling a tooth may irritate the nerve tissue
                                    creating sensitivity & treating such sensitivity could require root canal therapy or
                                    extractions.</p>

                                <p><strong>DENTURES:</strong> I understand that wearing of dentures can be difficult.
                                    Sore spots, altered speech and difficulty in eating are common problems. Immediate
                                    dentures (placement of denture immediately after extractions) may be painful and may
                                    require considerable adjusting in several relines. I understand that it is my
                                    responsibility to return for delivery of dentures. I understand that failure to keep
                                    my delivery appointment may result in poorly fitted dentures. If a remake is
                                    required due to my delays of more than 30 days, there will be additional charges. A
                                    permanent reline will be needed later, which is not included in the initial fee. I
                                    understand that all adjustment or alterations of any kind after this initial period
                                    is subject to charges.</p>

                                <p><strong>I understand that Dentistry is not an exact science and that no dentist can
                                        properly guarantee accurate results all the time.</strong></p>

                                <p>I hereby authorize any of the doctors/dental auxiliaries to proceed with and perform
                                    the dental restorations and treatments as explained to me. I understand that these
                                    are subject to modification depending on undiagnosable circumstances that may arise
                                    during the course of treatment.</p>

                                <p>I understand that regardless of any dental insurance coverage I may have, I am
                                    responsible for payment of dental fees. I agree to pay any attorney's fees,
                                    collection fee, or court costs that may be incurred to satisfy any obligation to
                                    this office.</p>

                                <p>All treatment was properly explained to me and in case of any untoward circumstances
                                    that may arise during the procedure, the attending dentist will not be held liable
                                    since it is my free will, with full trust and confidence in him/her to undergo
                                    dental treatment under his/her care.</p>

                            </div>


                            <!-- Signature Area -->
                            <form class="mt-4">
                                <div class="form-row" style="margin:50px;">
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

                                        <label for="dentist">Dentist's Name</label>


                                        <input list="dentists" name="dentist" id="dentistName" class="form-control"
                                            onchange="setDentistSignature();">
                                        <datalist id="dentists">
                                            <?php
                                            include_once("bars/properties.php");
                                            foreach ($dentist as $d) {
                                                echo '<option value="' . htmlspecialchars($d) . '">';
                                            }
                                            ?>
                                        </datalist>
                                        <label>Dentist Signature</label>
                                        <div class="border rounded p-3 signature-box text-center"
                                            style="height: 80px; cursor: pointer;" id="dentist-signature-box" onclick="openSignatureModal(function(sigData) {
                 setSignature('dentist', sigData);
             })">

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
                                        <a class="btn btn-danger btn-icon-split" onclick="switchToTab1('tab2-tab')">
                                            <span class="icon text-white-50"><i
                                                    class="fas fa-fw fa-arrow-left"></i></span>
                                            <span class="text">Back</span></a>

                                        <a href="#" class="btn btn-success btn-icon-split"
                                            onclick="submitClientform('submit')">
                                            <span class="icon text-white-50"><i class="fas fa-fw fa-save"></i></span>
                                            <span class="text">Submit</span>
                                        </a>

                                    </div>
                                </div>
                            </footer>


                            <!-- END OF YOUR ADDITIONAL CODE SNIPPET -->
                        </div>
                    </div>
                </div>

                <!-- Page Heading -->

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
            <script src="js/custom-v1.js"></script>
            <script src="js/signature.js"></script>



            <script src="controllers/clientRegistrationController-v7.js"></script>



</body>

</html>