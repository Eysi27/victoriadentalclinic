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



            $query = "select * from dentalcertificate where certid=:a";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $soaid);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '
          <div style="width: 8.27in; height: 11.69in; padding: 0in; font-family: \'Times New Roman\', serif; font-size: 12pt; line-height: 1.6; text-align: justify; box-sizing: border-box; position: relative;">

    <!-- Centered Logo and Clinic Name -->
    <div style="text-align: center; margin-bottom: 0.5em;">
        <img src="img/white_logo_final.jpg" alt="Company Logo" style="height: 40px; display: inline-block; vertical-align: middle; margin-bottom: 0.3em;">
        <div style="font-size: 20pt; font-weight: bold;">Smiles & More</div>
    </div>

    <!-- Centered Address and Contact Info -->
    <div style="text-align: center; margin-bottom: 1em;">
        <div>Stall B Josefa St. Josefaville 1 Subd, Brgy Malabanias, Angeles City, Pampanga PH 2009</div>
        <div>0927-605-8418 / 0960-437-5938</div>
    </div>

    <hr style="margin: 1em 0;">

    <!-- Certificate Title -->
    <h2 style="text-align: center; font-size: 18pt; margin-top: 0; margin-bottom: 1.5em;">
        Dental Certificate
    </h2>

    <!-- Certificate Content -->
    <p style="text-indent: 2em; margin: 0 0 1em 0;">
        This is to certify that <strong>' . $row["name"] . '</strong>,  ' . $row["age"] . ', ' . $row["gender"] . ', residing at ' . $row["address"] . ', was seen and examined at our office on ';
                    $date = new DateTime($row["date"]);
                    echo $date->format('F j, Y, l');
                    echo
                        ' for a ' . $row["treatment"] . '.
    </p>

    <p style="text-indent: 2em; margin: 0 0 1em 0;">
        Upon examination, ' . $row["diagnosis"] . '.
    </p>

    <p style="text-indent: 2em; margin: 0 0 3em 0;">
        This certification is being issued upon the request for whatever legal purpose it may serve.
    </p>

    <!-- Footer Just Below Last Paragraph -->
    <div style="text-align: right; margin-top: 2em;">
        <p style="margin: 0;">' . $row["dentist"] . '</p>
        <p style="margin: 0;">Attending Dentist</p>
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
