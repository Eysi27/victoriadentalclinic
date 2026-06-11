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
                        $query = "select * from medhistory where clientId=:clientid";
                        $stmt = $this->conn->prepare($query);
                        $stmt->bindParam(':clientid', $clientId);
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
       <div class="form-group">
                                <label class="form-label">Medical Conditions (Check all that apply):</label>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q1" name="q1"
                                                value="High Blood Pressure" ';
                                        if ($row["q1"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q1">High Blood Pressure</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q2" name="q2"
                                                value="Low Blood Pressure" ';
                                        if ($row["q2"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q2">Low Blood Pressure</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q3" name="q3"
                                                value="Epilepsy/Convulsions"';
                                        if ($row["q3"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q3">Epilepsy/Convulsions</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q4" name="q4"
                                                value="AIDS/HIV Infection"';
                                        if ($row["q4"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q4">AIDS/HIV Infection</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q5" name="q5"
                                                value="Sexually Transmitted Disease (STD)"';
                                        if ($row["q5"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q5">Sexually Transmitted Disease
                                                (STD)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q6" name="q6"
                                                value="Stomach Troubles/Ulcers"';
                                        if ($row["q6"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q6">Stomach Troubles/Ulcers</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q7" name="q7"
                                                value="Fainting Seizures"';
                                        if ($row["q7"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q7">Fainting Seizures</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q8" name="q8"
                                                value="Rapid Weight Loss"';
                                        if ($row["q8"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q8">Rapid Weight Loss</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q9" name="q9"
                                                value="Heart Problems"';
                                        if ($row["q9"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q9">Heart Problems</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q10" name="q10"
                                                value="Heart Murmur"';
                                        if ($row["q10"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q10">Heart Murmur</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q11" name="q11"
                                                value="Pacemaker"';
                                        if ($row["q11"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q11">Pacemaker</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q12" name="q12"
                                                value="Hepatitis"';
                                        if ($row["q12"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q12">Hepatitis</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q13" name="q13"
                                                value="Rheumatic Fever"';
                                        if ($row["q13"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q13">Rheumatic Fever</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q14" name="q14"
                                                value="Hay Fever/Allergies"';
                                        if ($row["q14"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q14">Hay Fever/Allergies</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q15" name="q15"
                                                value="Respiratory Problems"';
                                        if ($row["q15"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q15">Respiratory Problems</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q16" name="q16"
                                                value="Tuberculosis"';
                                        if ($row["q16"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q16">Tuberculosis</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q17" name="q17"
                                                value="Diabetes"';
                                        if ($row["q17"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q17">Diabetes</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q18" name="q18"
                                                value="Anemia"';
                                        if ($row["q18"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q18">Anemia</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q19" name="q19"
                                                value="Asthma"';
                                        if ($row["q19"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q19">Asthma</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q20" name="q20"
                                                value="Cancer"';
                                        if ($row["q20"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q20">Cancer</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q21" name="q21"
                                                value="Liver Disease"';
                                        if ($row["q21"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q21">Liver Disease</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q22" name="q22"
                                                value="Kidney Disease"';
                                        if ($row["q22"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q22">Kidney Disease</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q23" name="q23"
                                                value="Blood Diseases"';
                                        if ($row["q23"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q23">Blood Diseases</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q24" name="q24"
                                                value="Stroke"';
                                        if ($row["q24"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q24">Stroke</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q25" name="q25"
                                                value="Thyroid Problem"';
                                        if ($row["q25"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q25">Thyroid Problem</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="q26" name="q26"
                                                value="Emphysema"';
                                        if ($row["q26"] == "true")
                                                echo 'checked';
                                        echo '>
                                            <label class="form-check-label" for="q26">Emphysema</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <strong>Others, Please specify:</strong>
                                        <input type="text" class="form-control" id="q27" placeholder="Others, Specify" value="' . $row["q27"] . '">
                                    </div>
                                </div>
                                <hr>


                            </div>
                            <div id="formResult"></div>
                            <footer class="sticky-footer">
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto">
                                        <a href="#" class="btn btn-success btn-icon-split"
                                            onclick="updateMedHistoryProfile()">
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