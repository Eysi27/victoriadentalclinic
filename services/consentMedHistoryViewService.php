<?php
//Service for Registration

require_once('databaseService.php');

$clientId = urldecode($_POST['clientId']);

$consentId = urldecode($_POST['consentId']);
//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->loadMedHistory($clientId, $consentId);
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
    public function loadMedHistory($clientId, $consentId)
    {
        //:a,:b parameter
        try {
            $query = "select * from consentmedhistory where clientId=:clientid and consentId=:consentId";

            if ($consentId == '') {
                $query = "select * from medhistory where clientId=:clientid";

            }
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':clientid', $clientId);
            if ($consentId != '') {
                $stmt->bindParam(':consentId', $consentId);

            }
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    $questions = [
                        "q1" => "High Blood Pressure",
                        "q2" => "Low Blood Pressure",
                        "q3" => "Epilepsy/Convulsions",
                        "q4" => "AIDS/HIV Infection",
                        "q5" => "Sexually Transmitted Disease (STD)",
                        "q6" => "Stomach Troubles/Ulcers",
                        "q7" => "Fainting Seizures",
                        "q8" => "Rapid Weight Loss",
                        "q9" => "Heart Problems",
                        "q10" => "Heart Murmur",
                        "q11" => "Pacemaker",
                        "q12" => "Hepatitis",
                        "q13" => "Rheumatic Fever",
                        "q14" => "Hay Fever/Allergies",
                        "q15" => "Respiratory Problems",
                        "q16" => "Tuberculosis",
                        "q17" => "Diabetes",
                        "q18" => "Anemia",
                        "q19" => "Asthma",
                        "q20" => "Cancer",
                        "q21" => "Liver Disease",
                        "q22" => "Kidney Disease",
                        "q23" => "Blood Diseases",
                        "q24" => "Stroke",
                        "q25" => "Thyroid Problem",
                        "q26" => "Emphysema"
                    ];

                    // Split into 3 chunks
                    $chunks = array_chunk($questions, ceil(count($questions) / 3), true);

                    echo '<div class="row">';
                    foreach ($chunks as $chunk) {
                        echo '<div class="col-md-4">';
                        foreach ($chunk as $key => $label) {
                            $checked = $row[$key] == "true";
                            $icon = $checked ? 'fa-check-square' : 'fa-square';
                            $color = $checked ? 'style="color: green;"' : '';
                            echo '<div style="line-height: 1;"><i class="fas ' . $icon . '" ' . $color . '></i> ' . $label . '</div>';
                        }
                        echo '</div>';
                    }
                    echo '</div>';

                    // Display q27 (Others)
                    echo '<div class="row mt-2"><div class="col-md-12"><strong>Others, Please specify:</strong> ' . htmlspecialchars($row["q27"]) . '</div></div>';



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