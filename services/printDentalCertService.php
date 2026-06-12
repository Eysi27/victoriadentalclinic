<?php
//Service for Registration

require_once('databaseService.php');
$soaid = urldecode($_POST['soaid']);
$service = new ServiceClass();
$result = $service->printSoa($soaid);
echo $result;
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
   public function printSoa($soaid)
{
    try {
        include_once('../bars/properties.php');

        $query = "SELECT * FROM dentalcertificate WHERE certid = :a";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $soaid);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 // ✅ Split treatment list by comma and build formatted output
                    $treatmentsOutput = '';
                    $treatments = preg_split("/\r\n|\n|\r/", $row["treatment"]);

        foreach ($treatments as $treatment) {
        if (trim($treatment) != '') {
        $treatmentsOutput .= '<span style="margin-left:30px;">[✔] ' . trim($treatment) . '</span><br>';
    }
        }

                echo '
        <style>
        @media print {
          h2 {
            -webkit-print-color-adjust: exact !important; /* For Chrome, Safari, Edge */
            print-color-adjust: exact !important;         /* Standard */
            background-color: darkblue !important;
            color: white !important;
          }
        }
        </style>

        <div style="width: 8.5in; height: 11in; padding: 0in; font-family: \'Times New Roman\', serif; font-size: 12pt; line-height: 1.6; text-align: justify; box-sizing: border-box; position: relative;">

           <!-- Centered Logo and Clinic Name -->
    <div style="text-align: center; margin-bottom: 0.5em;">
        <img src="img/vadc_whitebg.png" alt="Company Logo" style="height: 100px; display: inline-block; vertical-align: middle; margin-bottom: 0.3em;">
        <div style="font-size: 20pt; font-weight: bold;">Victoria Advanced Dental Care</div>
    </div>

    <!-- Centered Address and Contact Info -->
    <div style="text-align: center; margin-bottom: 1em;">
        <div> 101 Iriga, Iriga City, Camarines Sur</div>
        <div>(0968) 350 7067</div>
    </div>

            <!-- Certificate Title -->
            <h2 style="text-align: center; font-size: 18pt; margin-top: 0; margin-bottom: 1em; background-color: darkblue; color: white; padding: 5px; border-radius: 1px;">
                D E N T A L   &nbsp;&nbsp;&nbsp; C E R T I F I C A T E
            </h2>

            <!-- Certificate Date (Top Right) -->
            <div style="text-align: right;">
             <strong>Date:</strong> ' . date("F j, Y") . '
            </div>

            <!-- Certificate Content -->
            <p style="margin: 1em 0;">
                To Whom it may concern:<br>
                &nbsp;&nbsp;&nbsp; This is to certify that <strong>' . $row["name"] . '</strong> &nbsp; ' . $row["age"] . ' year-old, residing at &nbsp; ' . $row["address"] . '<br> 
                Has been a patient by this office. His/Her last visit was on <u>' . date("F j, Y", strtotime($row["date"])) . '</u> <br><br>
                The following procedure/s was-were performed:<br>
        
                  ' . $treatmentsOutput . '

            
                    
            </p>
           
            <p style="margin: 1em 0;">
                Remarks/Recommendations:  ' .nl2br( $row["diagnosis"] ). '.
            </p>
            <br>
            <p style="margin: 1em 0 3em 0;">
                <i>This certificate is being issued upon the request of the patient for whatever purpose it may serve except medico-legal purposes.</i>
            </p>

            <!-- Footer Just Below Last Paragraph -->
            <div style="text-align: right; margin-top: 2em;">
              <!-- Signature Section -->   
         <br>
                <p style="margin: 0;">' . $row["dentist"] . '</p>
                
                <p style="margin: 0;">License No. ' . $row["license"] . '</p>
               
            </div>

        </div>
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
