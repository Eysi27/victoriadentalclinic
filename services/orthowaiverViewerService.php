<?php
require_once('databaseService.php');
$service = new ServiceClass();
$clientId = urldecode($_POST['clientId']);

$result = $service->process($clientId);

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
    //DO NOT INCLUDE THIS CODE
    public function process($clientId)
    {

        $query = "select * from orthowaiver where clientId=:a LIMIT 1";


        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $clientId);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '
                
                <div style="flex: 0 0 50%; padding-right: 15px; box-sizing: border-box;">
                                        <label for="dateSigned">Date: ' . $row["date"] . '</label><br>
                                   

                                        <label for="patientName">Patient\'s/Guardian\'s Name: <br> ' . $row["patient"] . '</label><br>
                                        
                                        <label>Patient\'s/Guardian\'s Signature</label>
                                        <div id="patient-signature-box" class="signature-box"
                                            style="border: 1px solid #ccc; border-radius: 4px; padding: 15px; height: 80px; cursor: pointer;">
';

                $imageData = base64_encode($row['signature']);
                $imageType = "png"; // Or "png" depending on what your DB stores
                $patientSignature = "data:image/{$imageType};base64,{$imageData}";
                // echo $patientSignature;

                echo '
                                            <img  alt="signature"
                                                style="width: 100%; height: 100%; object-fit: contain;"
                                                id="patientSignature" src="' . $patientSignature . '">
                                        </div>
                                    
                                    </div>

                                    <div style="flex: 0 0 50%; padding-left: 15px; box-sizing: border-box;">
                                        <br><br>
                                        <label for="dentistName">Dentist\'s Name: ' . $row["dentist"] . '</label><br>
                                       
';

                $imageData = base64_encode($row['dentistSignature']);
                $imageType = "png"; // Or "png" depending on what your DB stores
                $dentistSignature = 'img/e-sign.png';


                if ($row['dentistSignature'] != null || $row['dentistSignature'] != '') {


                    $dentistSignature = "data:image/{$imageType};base64,{$imageData}";
                }
                echo '
                                        <label>Dentist Signature</label>
                                        <div id="dentist-signature-box" class="signature-box"
                                            style="border: 1px solid #ccc; border-radius: 4px; padding: 15px; height: 80px; cursor: pointer; text-align: center;">
                                            <img  alt="../img/e-sign.png"
                                                style="width: 100%; height: 100%; object-fit: contain;"
                                                id="patientSignature" src="' . $dentistSignature . '">

                                        </div>
                                    </div>
                
                ';




            }
        }
    }
}
