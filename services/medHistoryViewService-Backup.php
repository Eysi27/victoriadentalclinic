<?php
//Service for Registration

require_once('databaseService.php');

$clientId = urldecode($_POST['clientId']);
//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->loadMedHistory($clientId);
//USE THIS AS YOUR BASIS
class ServiceClass
{

    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function loadMedHistory($clientId)
    {
        //:a,:b parameter
        try {
            $query = "select * from medhistoryv2 where clientId=:clientid";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':clientid', $clientId, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo ' 
                      <div class="form-group">
                                        <h6 class="mb-3 text-center">Dental History</h6>
                                        <div class="row">
                                            <div class="col-lg-6 mb-6">
                                                <label for="cardNumber">Previous Dentists: </label>
                                                <input type="text" name="prevDentist" id="prevDentist"
                                                    placeholder="Prev Dentist Full name" class="form-control mb-2" value="' . (($row['prevDentist'] === 'null' || empty($row['prevDentist'])) ? '' : htmlspecialchars($row['prevDentist'])) . '">

                                            </div>
                                            <div class="col-lg-6 mb-6">
                                                <label for="cardNumber">Last Dental Visit: </label>
                                                <input type="date" name="lastDentalVisit" id="lastDentalVisit"
                                                    placeholder="Please specify" class="form-control mb-2" value="' . (($row['lastDentalVisit'] === 'null' || empty($row['lastDentalVisit'])) ? '' : htmlspecialchars($row['lastDentalVisit'])) . '">
                                            </div>

                                        </div>
                                        <hr>
                                        <h6 class="mb-3 text-center">Medical History</h6>
                                        <div class="row">
                                            <div class="col-lg-6 mb-6">
                                                <label for="cardNumber">Name of Physician :</label>
                                                <input type="text" name="physician" id="physician"
                                                    placeholder="Physician Full name" class="form-control mb-2" value="' . (($row['physician'] === 'null' || empty($row['physician'])) ? '' : htmlspecialchars($row['physician'])) . '">

                                            </div>
                                            <div class="col-lg-6 mb-6">
                                                <label for="cardNumber">Specialty, if applicable: </label>
                                                <input type="text" name="specialty" id="specialty"
                                                    placeholder="Please specify" class="form-control mb-2" value="' . (($row['specialty'] === 'null' || empty($row['specialty'])) ? '' : htmlspecialchars($row['specialty'])) . '">

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 mb-6">
                                                <label for="cardNumber">Office Address:</label>
                                                <input type="text" name="officeAddress" id="officeAddress"
                                                    placeholder="Office Address" class="form-control mb-2" value="' . (($row['officeAddress'] === 'null' || empty($row['officeAddress'])) ? '' : htmlspecialchars($row['officeAddress'])) . '">

                                            </div>
                                            <div class="col-lg-6 mb-6">
                                                <label for="cardNumber">Office Number:</label>
                                                <input type="text" name="officeNumber" id="officeNumber"
                                                    placeholder="Office Number" class="form-control mb-2" value="' . (($row['officeNumber'] === 'null' || empty($row['officeNumber'])) ? '' : htmlspecialchars($row['officeNumber'])) . '">

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
                                                        id="goodHealthYes" value="yes" ';
                    if ($row['goodHealth'] === 'yes')
                        echo 'checked';
                    echo '>
                                                    <label class="form-check-label" for="goodHealthYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="goodHealth"
                                                        id="goodHealthNo" value="no"';
                    if ($row['goodHealth'] === 'no')
                        echo 'checked';
                    echo '>
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
                                                        onclick="toggleCondition(true,\'treatmentCondition\')" ';
                    if ($row['underTreatment'] === 'yes')
                        echo 'checked';
                    echo '>
                                                    <label class="form-check-label" for="underTreatmentYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="underTreatment"
                                                        id="underTreatmentNo" value="no"
                                                        onclick="toggleCondition(false,\'treatmentCondition\')"';
                    if ($row['underTreatment'] === 'no') {
                        echo 'checked';
                    }
                    echo '>
                                                    <label class="form-check-label" for="underTreatmentNo">No</label>
                                                </div>
                                            </div>

                                            <!-- Conditional Input Field -->
                                            <div class="col-lg-12 mb-3">
                                                <label for="treatmentCondition" class="form-label">-If so, what is
                                                    the
                                                    condition being treated?</label>
                                                <input type="text" id="treatmentCondition" name="treatmentCondition"
                                                    class="form-control" placeholder="Describe the condition" value="';
                    if ($row['treatmentCondition'] === 'null' || empty($row['treatmentCondition'])) {
                        echo '"';
                    } else {
                        echo htmlspecialchars($row['treatmentCondition']) . '"';
                    }
                    if ($row['underTreatment'] === 'no') {
                        echo ' disabled';
                    }

                    echo '>
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
                                                        onclick="toggleCondition(true, \'illnessCondition\')" ';
                    if ($row['seriousIllness'] === 'yes')
                        echo 'checked';
                    echo '>
                                                    <label class="form-check-label" for="seriousIllnessYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="seriousIllness"
                                                        id="seriousIllnessNo" value="no"
                                                        onclick="toggleCondition(false, \'illnessCondition\')" ';
                    if ($row['seriousIllness'] === 'no') {
                        echo 'checked';
                    }
                    echo '>
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
                                                    value="';
                    if ($row['illnessCondition'] === 'null' || empty($row['illnessCondition'])) {
                        echo '"';
                    } else {
                        echo htmlspecialchars($row['illnessCondition']) . '"';
                    }
                    if ($row['seriousIllness'] === 'no') {
                        echo ' disabled';
                    }
                    echo '
                    >
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
                                                        onclick="toggleCondition(true, \'hospitalizedCondition\')"
                                                        ';
                    if ($row['hospitalized'] === 'yes') {
                        echo 'checked';
                    }
                    echo '>
                                                    <label class="form-check-label" for="hospitalizedYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="hospitalized"
                                                        id="hospitalizedNo" value="no"
                                                        onclick="toggleCondition(false, \'hospitalizedCondition\')" ';
                    if ($row['hospitalized'] === 'no') {
                        echo 'checked';
                    }
                    echo '>
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
                                                    placeholder="Provide the date and reason for hospitalization" value="'
                        . (($row['hospitalizedCondition'] === 'null' || empty($row['hospitalizedCondition'])) ? '' : htmlspecialchars($row['hospitalizedCondition'])) . '"';
                    if ($row['hospitalized'] === 'no') {
                        echo 'disabled';
                    }
                    echo '>
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
                                                        onclick="toggleCondition(true, \'medicationCondition\')" ';
                    if ($row['medication'] === 'yes') {
                        echo 'checked';
                    }
                    echo '>
                                                    <label class="form-check-label" for="medicationYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="medication"
                                                        id="medicationNo" value="no"
                                                        onclick="toggleCondition(false, \'medicationCondition\')" ';
                    if ($row['medication'] === 'no') {
                        echo 'checked';
                    }
                    echo '>
                                                    <label class="form-check-label" for="medicationNo">No</label>
                                                </div>
                                            </div>

                                            <!-- Conditional Input Field -->
                                            <div class="col-lg-12 mb-3">
                                                <label for="medicationCondition" class="form-label">- If so, please
                                                    specify:</label>
                                                <input type="text" id="medicationCondition" name="medicationCondition"
                                                    class="form-control" placeholder="List medications being taken"
                                                    value="';
                    if ($row['medicationCondition'] === 'null' || empty($row['medicationCondition'])) {
                        echo '"';
                    } else {
                        echo htmlspecialchars($row['medicationCondition']) . '"';
                    }
                    if ($row['medication'] === 'no') {
                        echo ' disabled';
                    }
                    echo '>
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
                                                        id="tobaccoUseYes" value="yes" ';
                    if ($row['tobaccoUse'] === 'yes') {
                        echo 'checked';
                    }
                    echo '
                                >
                                                    <label class="form-check-label" for="tobaccoUseYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tobaccoUse"
                                                        id="tobaccoUseNo" value="no" ';
                    if ($row['tobaccoUse'] === 'no') {
                        echo 'checked';
                    }
                    echo '>
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
                                                        id="substanceUseYes" value="yes" ';
                    if ($row['substanceUse'] === 'yes') {
                        echo 'checked';
                    }
                    echo '>
                                                    <label class="form-check-label" for="substanceUseYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="substanceUse"
                                                        id="substanceUseNo" value="no" ';
                    if ($row['substanceUse'] === 'no') {
                        echo 'checked';
                    }
                    echo '>
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
                                                        onclick="toggleConditionCheck(true, \'allergyOptions\')" ';
                    if ($row['allergies'] === 'yes') {
                        echo 'checked';
                    }
                    echo '>
                                                    <label class="form-check-label" for="allergicToYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="allergicTo"
                                                        id="allergicToNo" value="no"
                                                        onclick="toggleConditionCheck(false, \'allergyOptions\')"
                                                        ';
                    if ($row['allergies'] === 'no') {
                        echo 'checked';
                    }
                    echo '>
                                                    <label class="form-check-label" for="allergicToNo">No</label>
                                                </div>
                                            </div>

                                            <!-- Allergy Options -->
                                            <div class="col-lg-12 mb-3" id="allergyOptions" ';

                    if ($row['allergies'] === 'no') {
                        echo ' style="display: none;"';
                    } else {
                        echo ' style="display: block;"';
                    }
                    $allergyValues = isset($row["allergiesCondition"]) ? explode(",", $row["allergiesCondition"]) : [];

                    echo '>

                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="allergyLocalAnesthetic" name="allergies"
                                                                value="Local Anesthetic" ' . (in_array('Local Anesthetic', $allergyValues) ? 'checked' : '') . '>
                                                            <label class="form-check-label"
                                                                for="allergyLocalAnesthetic">Local Anesthetic (ex.
                                                                Lidocaine)</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="allergyAspirin" name="allergies" value="Aspirin" ' . (in_array('Aspirin', $allergyValues) ? 'checked' : '') . '>
                                                            <label class="form-check-label"
                                                                for="allergyAspirin">Aspirin</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="allergyPenicillin" name="allergies"
                                                                value="Penicillin" ' . (in_array('Penicillin', $allergyValues) ? 'checked' : '') . '>
                                                            <label class="form-check-label"
                                                                for="allergyPenicillin">Penicillin /
                                                                Antibiotics</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="allergyLatex" name="allergies" value="Latex" ' . (in_array('Latex', $allergyValues) ? 'checked' : '') . '>
                                                            <label class="form-check-label"
                                                                for="allergyLatex">Latex</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="allergySulfa" name="allergies" value="Sulfa" ' . (in_array('Sulfa', $allergyValues) ? 'checked' : '') . '>
                                                            <label class="form-check-label" for="allergySulfa">Sulfa
                                                                Drugs</label>
                                                        </div>
                                                        <!-- Others Checkbox -->
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="allergyOthers" name="allergies" value="Others"
                                                                onchange="toggleSpecifyInput(this, \'otherAllergySpecify\')" ' . (in_array('Others', $allergyValues) ? 'checked' : '') . '>
                                                            <label class="form-check-label"
                                                                for="allergyOthers">Others</label>
                                                        </div>

                                                        <!-- Input to specify other allergies -->
                                                        <div class="mt-2" id="otherAllergySpecify"
                                                            ';
                    if (!in_array('Others', $allergyValues)) {
                        echo 'style="display: none;"';
                    } else {
                        echo 'style="display: block;"';
                    }
                    echo '
                                                            >
                                                            <input type="text" class="form-control"
                                                                id="otherAllergyField" name="otherAllergyDetail"
                                                                placeholder="Please specify other allergy" value="';
                    if ($row['otherAllergyField'] === 'null' || empty($row['otherAllergyField'])) {
                        echo '';
                    } else {
                        echo htmlspecialchars($row['otherAllergyField']);
                    }
                    echo '"


                                                                >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        ';

                    echo '
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
                                                        id="pregnantYes" value="yes"';
                    if ($row['pregnant'] === 'yes') {
                        echo 'checked';
                    }
                    echo '>
                                                    <label class="form-check-label" for="pregnantYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="pregnant"
                                                        id="pregnantNo" value="no"';
                    if ($row['pregnant'] === 'no') {
                        echo 'checked';
                    }
                    echo '>
                                                    <label class="form-check-label" for="pregnantNo">No</label>
                                                </div>
                                            </div>

                                            <!-- Are you nursing? -->
                                            <div class="col-lg-6 mb-3">
                                                <label class="form-label mb-0">Are you nursing?</label>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="nursing"
                                                        id="nursingYes" value="yes"';
                    if ($row['nursing'] === 'yes') {
                        echo 'checked';
                    }
                    echo '>
                                                    <label class="form-check-label" for="nursingYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="nursing"
                                                        id="nursingNo" value="no" ';
                    if ($row['nursing'] === 'no') {
                        echo 'checked';
                    }
                    echo '>
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
                                                        id="birthControlYes" value="yes" ';
                    if ($row['birthControl'] === 'yes') {
                        echo 'checked';
                    }
                    echo '>
                                                    <label class="form-check-label" for="birthControlYes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="birthControl"
                                                        id="birthControlNo" value="no"';
                    if ($row['birthControl'] === 'no') {
                        echo 'checked';
                    }
                    echo '>
                                                    <label class="form-check-label" for="birthControlNo">No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <label class="form-label"><strong>Medical Conditions (Check all that
                                                apply):</strong></label>
';

                    $medicalFlags = isset($row['medicalHistory']) ? explode(',', $row['medicalHistory']) : [];


                    echo '
                                        <div class="row">
                                            <!-- Column 1 -->
                                            <div class="col-md-4">
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q1" name="q1" value="High Blood Pressure" ' . (isset($medicalFlags[0]) && $medicalFlags[0] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q1">High Blood Pressure</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q2" name="q2" value="Low Blood Pressure" ' . (isset($medicalFlags[1]) && $medicalFlags[1] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q2">Low Blood Pressure</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q3" name="q3" value="Epilepsy / Convulsions" ' . (isset($medicalFlags[2]) && $medicalFlags[2] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q3" >Epilepsy /
                                                        Convulsions</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q4" name="q4" value="AIDS or HIV Infection" ' . (isset($medicalFlags[3]) && $medicalFlags[3] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q4">AIDS or HIV
                                                        Infection</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q5" name="q5" value="Sexually Transmitted disease" ' . (isset($medicalFlags[4]) && $medicalFlags[4] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q5" >Sexually Transmitted
                                                        disease</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q6" name="q6" value="Stomach Troubles / Ulcers" ' . (isset($medicalFlags[5]) && $medicalFlags[5] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q6" >Stomach Troubles /
                                                        Ulcers</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q7" name="q7" value="Fainting Seizure" ' . (isset($medicalFlags[6]) && $medicalFlags[6] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q7">Fainting Seizure</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q8" name="q8" value="Rapid Weight Loss" ' . (isset($medicalFlags[7]) && $medicalFlags[7] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q8">Rapid Weight Loss</label>
                                                </div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q9" name="q9" value="Heart Disease" ' . (isset($medicalFlags[8]) && $medicalFlags[8] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q9">Heart Disease</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q10" name="q10" value="Heart Murmur" ' . (isset($medicalFlags[9]) && $medicalFlags[9] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q10">Heart Murmur</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q11" name="q11" value="Hepatitis / Liver Disease" ' . (isset($medicalFlags[10]) && $medicalFlags[10] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q11">Hepatitis / Liver
                                                        Disease</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q12" name="q12" value="Rheumatic Fever" ' . (isset($medicalFlags[11]) && $medicalFlags[11] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q12" >Rheumatic Fever</label></div>
                                                <div class="form-check"><input class="form-check-input" type="checkbox"
                                                        id="q13" name="q13" value="Hay Fever / Allergies" ' . (isset($medicalFlags[12]) && $medicalFlags[12] === 'true' ? 'checked' : '') . '><label
                                                        class="form-check-label" for="q13" >Hay Fever /
                                                        Allergies</label>
                                                </div>
                                            </div>

                                            <!-- Column 2 -->
                                            <div class="col-md-4">
                                               <div class="form-check"><input class="form-check-input" type="checkbox"
        id="q14" name="q14" value="Respiratory Problems" ' . (isset($medicalFlags[13]) && $medicalFlags[13] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q14">Respiratory Problems</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q15" name="q15" value="Hepatitis / Jaundice" ' . (isset($medicalFlags[14]) && $medicalFlags[14] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q15">Hepatitis / Jaundice</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q16" name="q16" value="Tuberculosis" ' . (isset($medicalFlags[15]) && $medicalFlags[15] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q16">Tuberculosis</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q17" name="q17" value="Radiation Therapy" ' . (isset($medicalFlags[16]) && $medicalFlags[16] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q17">Radiation Therapy</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q18" name="q18" value="Swollen ankles" ' . (isset($medicalFlags[17]) && $medicalFlags[17] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q18">Swollen ankles</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q19" name="q19" value="Joint Replacement / Implant" ' . (isset($medicalFlags[18]) && $medicalFlags[18] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q19">Joint Replacement / Implant</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q20" name="q20" value="Kidney disease" ' . (isset($medicalFlags[19]) && $medicalFlags[19] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q20">Kidney disease</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q21" name="q21" value="Heart Surgery" ' . (isset($medicalFlags[20]) && $medicalFlags[20] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q21">Heart Surgery</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q22" name="q22" value="Diabetes" ' . (isset($medicalFlags[21]) && $medicalFlags[21] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q22">Diabetes</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q23" name="q23" value="Heart Attack" ' . (isset($medicalFlags[22]) && $medicalFlags[22] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q23">Heart Attack</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q24" name="q24" value="Chest pain" ' . (isset($medicalFlags[23]) && $medicalFlags[23] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q24">Chest pain</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q25" name="q25" value="Thyroid Problem" ' . (isset($medicalFlags[24]) && $medicalFlags[24] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q25">Thyroid Problem</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q26" name="q26" value="Stroke" ' . (isset($medicalFlags[25]) && $medicalFlags[25] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q26">Stroke</label></div>

                                            </div>

                                            <!-- Column 3 -->
                                            <div class="col-md-4">
                                            <div class="form-check"><input class="form-check-input" type="checkbox"
        id="q27" name="q27" value="Cancer / Tumors" ' . (isset($medicalFlags[26]) && $medicalFlags[26] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q27">Cancer / Tumors</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q28" name="q28" value="Anemia" ' . (isset($medicalFlags[27]) && $medicalFlags[27] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q28">Anemia</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q29" name="q29" value="Angina" ' . (isset($medicalFlags[28]) && $medicalFlags[28] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q29">Angina</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q30" name="q30" value="Asthma" ' . (isset($medicalFlags[29]) && $medicalFlags[29] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q30">Asthma</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q31" name="q31" value="Emphysema" ' . (isset($medicalFlags[30]) && $medicalFlags[30] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q31">Emphysema</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q32" name="q32" value="Bleeding Problems" ' . (isset($medicalFlags[31]) && $medicalFlags[31] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q32">Bleeding Problems</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q33" name="q33" value="Blood Diseases" ' . (isset($medicalFlags[32]) && $medicalFlags[32] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q33">Blood Diseases</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q34" name="q34" value="Head Injuries" ' . (isset($medicalFlags[33]) && $medicalFlags[33] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q34">Head Injuries</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q35" name="q35" value="Arthritis / Rheumatism" ' . (isset($medicalFlags[34]) && $medicalFlags[34] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q35">Arthritis / Rheumatism</label></div>

<div class="form-check"><input class="form-check-input" type="checkbox"
        id="q36" name="q36" value="Rapid Weight Loss" ' . (isset($medicalFlags[35]) && $medicalFlags[35] === 'true' ? 'checked' : '') . '><label
        class="form-check-label" for="q36">Rapid Weight Loss</label></div>

<!-- Other (Specify) -->
<div class="form-check">
    <input class="form-check-input" type="checkbox" id="q37" name="q37" value="Other" ' . (isset($medicalFlags[36]) && $medicalFlags[36] === 'true' ? 'checked' : '') . '
        onclick="document.getElementById(\'otherCondition\').disabled = !this.checked;">
    <label class="form-check-label" for="q37">Other</label>
</div>
  
                                            
                                            <input type="text" id="otherCondition" name="otherCondition"
                                                    class="form-control mt-2" placeholder="Specify other condition"

                                                    value="'
                        . (($row['medicalHistoryOther'] === 'null' || empty($row['medicalHistoryOther'])) ? '' : htmlspecialchars($row['medicalHistoryOther'])) .
                        '"
                        
                        ';
                    if (!isset($medicalFlags[36]) || $medicalFlags[36] !== 'true') {
                        echo 'disabled';
                    }
                    echo '
                        >
                                            </div>
                                        </div>


                                        <hr>


                                    </div>
                                    <div id="formResult"></div>
                            <footer class="sticky-footer">
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto">
                                        <a href="#" class="btn btn-success btn-icon-split"
                                            onclick="validateHealthForm()">
                                            <span class="icon text-white-50"><i class="fas fa-fw fa-save"></i></span>
                                            <span class="text">Save</span>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-icon-split"
                                            onclick="location.replace(\'clientProfileList.php\');">
                                            <span class="icon text-white-50"><i class="fas fa-fw fa-times"></i></span>
                                            <span class="text">Cancel</span>
                                        </a>
                                    </div>
                                </div>
                            </footer>

';
                }
            }

        } catch (Exception $e) {
            return "Error:" . $e->getMessage();
        }



    }
    //UNTIL THIS CODE

}
//UNTIL HERE COPY



?>