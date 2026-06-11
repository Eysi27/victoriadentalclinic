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
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs" id="myTabs" role="tablist" style="display:none;">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab"
                                aria-controls="tab1" aria-selected="true">Step 1</a>
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
                                                    <option value="Flexicare">Flexicare</option>
                                                    <option value="Intellicare">Intellicare</option>
                                                    <option value="Avega">Avega</option>
                                                    <option value="Eastwest">Eastwest</option>
                                                    <option value="ValuCare">ValuCare</option>
                                                    <option value="Medicard">Medicard</option>
                                                    <option value="Health Partners Dental Access, Inc.">Health Partners
                                                        Dental
                                                        Access, Inc.</option>
                                                    <option value="Dental Network Company">Dental Network Company
                                                    </option>
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
                                    <h6 class="m-0 font-weight-bold">Patient Medical History
                                    </h6>
                                </div>
                                <div class="card-body" id="bodyResult" style="padding-right:20%;padding-left:20%">
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
                                                    <label class="form-check-label"
                                                        for="q3">Epilepsy/Convulsions</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="q4" name="q4"
                                                        value="AIDS/HIV Infection">
                                                    <label class="form-check-label" for="q4">AIDS/HIV Infection</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="q5" name="q5"
                                                        value="Sexually Transmitted Disease (STD)">
                                                    <label class="form-check-label" for="q5">Sexually Transmitted
                                                        Disease
                                                        (STD)</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="q6" name="q6"
                                                        value="Stomach Troubles/Ulcers">
                                                    <label class="form-check-label" for="q6">Stomach
                                                        Troubles/Ulcers</label>
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
                                                    <label class="form-check-label" for="q14">Hay
                                                        Fever/Allergies</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="q15" name="q15"
                                                        value="Respiratory Problems">
                                                    <label class="form-check-label" for="q15">Respiratory
                                                        Problems</label>
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
                                                <input type="text" class="form-control" id="q27"
                                                    placeholder="Others, Specify" value="">
                                            </div>
                                        </div>
                                        <hr>


                                    </div>
                                    <div id="formResult"></div>
                                    <footer class="sticky-footer">
                                        <div class="container my-auto">
                                            <div class="copyright text-center my-auto">
                                                <a class="btn btn-danger btn-icon-split"
                                                    onclick="switchToTab1('tab1-tab')"> <span
                                                        class="icon text-white-50"><i
                                                            class="fas fa-fw fa-arrow-left"></i></span>
                                                    <span class="text">Back</span></a>
                                                <a class="btn btn-success btn-icon-split"
                                                    onclick="switchToTab1('tab3-tab')"> <span
                                                        class="icon text-white-50"><i
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
                            < <!-- Page Heading -->
                                <h1 class="h3 mb-4  text-center">Informed Consents</h1>

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
                                                style="height: 80px; cursor: pointer;" id="patient-signature-box"
                                                onclick="openSignatureModal(function(sigData) {
                 setSignature('patient', sigData);
             })">
                                            </div>
                                            <input type="hidden" name="patient_signature" id="patient-signature-input">

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="patientName">Dentist's Name</label>
                                            <input type="text" class="form-control" id="dentistName"
                                                placeholder="Enter full name" value="Dr. Maria Regina I. Valencia"
                                                readonly>
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
                                            <a class="btn btn-danger btn-icon-split" onclick="switchToTab1('tab2-tab')">
                                                <span class="icon text-white-50"><i
                                                        class="fas fa-fw fa-arrow-left"></i></span>
                                                <span class="text">Back</span></a>
                                            <a href="javascript:void(0)" class="btn btn-warning btn-icon-split"
                                                onclick="submitClientform('skip')">
                                                <span class="icon text-white-50"><i
                                                        class="fas fa-fw fa-send"></i></span>
                                                <span class="text">Skip Consent And Submit</span>
                                            </a>
                                            <a href="#" class="btn btn-success btn-icon-split"
                                                onclick="submitClientform('submit')">
                                                <span class="icon text-white-50"><i
                                                        class="fas fa-fw fa-save"></i></span>
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
            <script src="js/custom.js"></script>
            <script src="js/signature.js"></script>



            <script src="controllers/clientRegistrationController-v2.js"></script>



</body>

</html>