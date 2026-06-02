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
            $stmt->bindParam(':clientid', $clientId);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo ' 
                    
                                     <div style="width: 50%; display: flex; margin: 10px 30px;"><strong>Dental History</strong></div>
                                       ';
                    echo '

<!-- Previous Dentist and Last Dental Visit -->
<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%; display: flex; align-items: center;">
        Previous Dentist:&nbsp;<strong>' . (!empty($row["prevDentist"]) && $row["prevDentist"] !== "null" ? htmlspecialchars($row["prevDentist"]) : "<em>Not specified</em>") . '</strong>
    </div>
    <div style="width: 50%; display: flex; align-items: center;">
        Last Dental Visit:&nbsp;<strong>' . (!empty($row["lastDentalVisit"]) && $row["lastDentalVisit"] !== "null" ? htmlspecialchars($row["lastDentalVisit"]) : "<em>Not specified</em>") . '</strong>
    </div>
</div>

 <div style="width: 50%; display: flex; margin: 10px 30px;"><strong>Medical History</strong></div>

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%; display: flex; align-items: center;">
        Physician:&nbsp;<strong>' . (!empty($row["physician"]) && $row["physician"] !== "null" ? htmlspecialchars($row["physician"]) : "<em>Not specified</em>") . '</strong>
    </div>
    <div style="width: 50%; display: flex; align-items: center;">
        Specialty:&nbsp;<strong>' . (!empty($row["specialty"]) && $row["specialty"] !== "null" ? htmlspecialchars($row["specialty"]) : "<em>Not specified</em>") . '</strong>
    </div>
</div>

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%; display: flex; align-items: center;">
        Office Address:&nbsp;<strong>' . (!empty($row["officeAddress"]) && $row["officeAddress"] !== "null" ? htmlspecialchars($row["officeAddress"]) : "<em>Not specified</em>") . '</strong>
    </div>
    <div style="width: 50%; display: flex; align-items: center;">
        Office Number:&nbsp;<strong>' . (!empty($row["officeNumber"]) && $row["officeNumber"] !== "null" ? htmlspecialchars($row["officeNumber"]) : "<em>Not specified</em>") . '</strong>
    </div>
</div>

<hr style="margin: 10px 30px;">

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%;">1. Are you in good health?</div>
    <div style="width: 50%;"><strong>' . ($row["goodHealth"] === "yes" ? "Yes" : ($row["goodHealth"] === "no" ? "No" : "<em>Not specified</em>")) . '</strong></div>
</div>

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%;">2. Are you under medical treatment now?</div>
    <div style="width: 50%;"><strong>' . ($row["underTreatment"] === "yes" ? "Yes" : ($row["underTreatment"] === "no" ? "No" : "<em>Not specified</em>")) . '</strong></div>
</div>

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%;">- If so, what is the condition being treated?</div>
    <div style="width: 50%;"><strong>' . ($row["treatmentCondition"] === "null" || empty($row["treatmentCondition"]) ? "<em>None specified</em>" : htmlspecialchars($row["treatmentCondition"])) . '</strong></div>
</div>

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%;">3. Have you ever had serious illness or surgical operation?</div>
    <div style="width: 50%;"><strong>' . ($row["seriousIllness"] === "yes" ? "Yes" : ($row["seriousIllness"] === "no" ? "No" : "<em>Not specified</em>")) . '</strong></div>
</div>

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%;">- If so, what illness or operation?</div>
    <div style="width: 50%;"><strong>' . ($row["illnessCondition"] === "null" || empty($row["illnessCondition"]) ? "<em>None specified</em>" : htmlspecialchars($row["illnessCondition"])) . '</strong></div>
</div>

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%;">4. Have you ever been hospitalized?</div>
    <div style="width: 50%;"><strong>' . ($row["hospitalized"] === "yes" ? "Yes" : ($row["hospitalized"] === "no" ? "No" : "<em>Not specified</em>")) . '</strong></div>
</div>

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%;">- If so, when and why?</div>
    <div style="width: 50%;"><strong>' . ($row["hospitalizedCondition"] === "null" || empty($row["hospitalizedCondition"]) ? "<em>None specified</em>" : htmlspecialchars($row["hospitalizedCondition"])) . '</strong></div>
</div>

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%;">5. Are you taking any prescription/non-prescription medication?</div>
    <div style="width: 50%;"><strong>' . ($row["medication"] === "yes" ? "Yes" : ($row["medication"] === "no" ? "No" : "<em>Not specified</em>")) . '</strong></div>
</div>

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%;">- If so, please specify:</div>
    <div style="width: 50%;"><strong>' . ($row["medicationCondition"] === "null" || empty($row["medicationCondition"]) ? "<em>None specified</em>" : htmlspecialchars($row["medicationCondition"])) . '</strong></div>
</div>

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%;">6. Do you use tobacco products?</div>
    <div style="width: 50%;"><strong>' . ($row["tobaccoUse"] === "yes" ? "Yes" : ($row["tobaccoUse"] === "no" ? "No" : "<em>Not specified</em>")) . '</strong></div>
</div>

<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%;">7. Do you use alcohol, cocaine or other dangerous drugs?</div>
    <div style="width: 50%;"><strong>' . ($row["substanceUse"] === "yes" ? "Yes" : ($row["substanceUse"] === "no" ? "No" : "<em>Not specified</em>")) . '</strong></div>
</div>';



                    $allergyValues = isset($row["allergiesCondition"]) ? explode(",", $row["allergiesCondition"]) : [];
                    echo '
                                       
<!-- 8. Are you allergic to any of the following -->
<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%; display: flex; align-items: center;">
        8. Are you allergic to any of the following:
    </div>
    <div style="width: 50%; display: flex; align-items: center;">
        <strong>' . (
                        $row["allergies"] === "yes" ? "Yes" :
                        ($row["allergies"] === "no" ? "No" : "<em>Not specified</em>")
                    ) . '</strong>
    </div>
</div>

' . (
                        $row["allergies"] === "yes"
                        ? '
<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%; display: flex; align-items: center;">
        - If yes, specify:
    </div>
    <div style="width: 50%; display: flex; align-items: center;">
        <strong>' . (
                            empty($row["allergiesCondition"]) || $row["allergiesCondition"] === "null"
                            ? "<em>None specified</em>"
                            : htmlspecialchars(implode(", ", array_map("trim", explode(",", $row["allergiesCondition"]))))
                        ) . '</strong>
    </div>
</div>' .
                        (in_array("Others", $allergyValues) && !empty($row["otherAllergyField"]) && $row["otherAllergyField"] !== "null"
                            ? '
<div style="display: flex; margin: 10px 30px;">
    <div style="width: 50%; display: flex; align-items: center;">
        - Other allergies:
    </div>
    <div style="width: 50%; display: flex; align-items: center;">
        <strong>' . htmlspecialchars($row["otherAllergyField"]) . '</strong>
    </div>
</div>'
                            : '')
                        : ''
                    ) . '


                                      <!-- 9. For women only -->
<div style="margin: 10px 30px;">
    <div style="font-weight: bold; margin-bottom: 8px;">
        9. For women only:
    </div>

    <!-- Are you pregnant? -->
    <div style="display: flex; margin-bottom: 6px;">
        <div style="width: 50%; display: flex; align-items: center;">
            Are you pregnant?
        </div>
        <div style="width: 50%; display: flex; align-items: center;">
            <strong>' . (
                        $row["pregnant"] === "yes" ? "Yes" :
                        ($row["pregnant"] === "no" ? "No" : "<em>Not specified</em>")
                    ) . '</strong>
        </div>
    </div>

    <!-- Are you nursing? -->
    <div style="display: flex; margin-bottom: 6px;">
        <div style="width: 50%; display: flex; align-items: center;">
            Are you nursing?
        </div>
        <div style="width: 50%; display: flex; align-items: center;">
            <strong>' . (
                        $row["nursing"] === "yes" ? "Yes" :
                        ($row["nursing"] === "no" ? "No" : "<em>Not specified</em>")
                    ) . '</strong>
        </div>
    </div>

    <!-- Are you taking birth control pills? -->
    <div style="display: flex; margin-bottom: 6px;">
        <div style="width: 50%; display: flex; align-items: center;">
            Are you taking birth control pills?
        </div>
        <div style="width: 50%; display: flex; align-items: center;">
            <strong>' . (
                        $row["birthControl"] === "yes" ? "Yes" :
                        ($row["birthControl"] === "no" ? "No" : "<em>Not specified</em>")
                    ) . '</strong>
        </div>
    </div>
</div>

<hr style="margin: 10 30px;">
                                     ';

                    $medicalFlags = isset($row['medicalHistory']) ? explode(',', $row['medicalHistory']) : [];
                    $medicalHistoryOther = isset($row['medicalHistoryOther']) ? htmlspecialchars($row['medicalHistoryOther']) : '';

                    $columns = [
                        [
                            "High Blood Pressure",
                            "Low Blood Pressure",
                            "Epilepsy / Convulsions",
                            "AIDS or HIV Infection",
                            "Sexually Transmitted disease",
                            "Stomach Troubles / Ulcers",
                            "Fainting Seizure",
                            "Rapid Weight Loss",
                            "Heart Disease",
                            "Heart Murmur",
                            "Hepatitis / Liver Disease",
                            "Rheumatic Fever",
                            "Hay Fever / Allergies"
                        ],
                        [
                            "Respiratory Problems",
                            "Hepatitis / Jaundice",
                            "Tuberculosis",
                            "Radiation Therapy",
                            "Swollen ankles",
                            "Joint Replacement / Implant",
                            "Kidney disease",
                            "Heart Surgery",
                            "Diabetes",
                            "Heart Attack",
                            "Chest pain",
                            "Thyroid Problem",
                            "Stroke"
                        ],
                        [
                            "Cancer / Tumors",
                            "Anemia",
                            "Angina",
                            "Asthma",
                            "Emphysema",
                            "Bleeding Problems",
                            "Blood Diseases",
                            "Head Injuries",
                            "Arthritis / Rheumatism",
                            "Rapid Weight Loss",
                            "Other"
                        ]
                    ];



                    echo ' <h6 style="margin: 20px 30px 10px;">Medical Conditions</h6>';
                    echo '<div style="display: flex; justify-content: space-between; margin: 10px 30px; line-height: 1.5;">'; // compact text with left/right margin

                    $flagIndex = 0;

                    foreach ($columns as $col) {
                        echo '<div style="flex: 1; white-space: nowrap;">'; // roughly 1/3 width column

                        foreach ($col as $condition) {
                            $icon = (isset($medicalFlags[$flagIndex]) && $medicalFlags[$flagIndex] === 'true') ? '✅' : '❌';
                            $label = htmlspecialchars($condition);

                            if ($label === 'Other') {
                                if (isset($medicalFlags[$flagIndex]) && $medicalFlags[$flagIndex] === 'true' && !empty($medicalHistoryOther)) {
                                    echo $icon . ' <strong>Other:</strong> ' . htmlspecialchars($medicalHistoryOther) . '<br>';
                                } else {
                                    echo '❌ <strong>Other</strong><br>';
                                }
                            } else {
                                echo $icon . ' ' . $label . '<br>';
                            }

                            $flagIndex++;
                        }

                        echo '</div>';
                    }

                    echo '</div>';






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