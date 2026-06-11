<?php
//Service for Registration

require_once('databaseService.php');

$service = new ServiceClass();
$result = $service->process();
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
    public function process()
    {
        //:a,:b parameter
        try {

            $query = "select clientid, lname,fname,mdname,birthDate,guardianName from clientprofile order by lname";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $lname = $row['lname'];
                    $fname = $row['fname'];
                    $mdname = $row['mdname'];
                    $birthDate = $row['birthDate'];
                    $guardianName = $row['guardianName'];

                    // Calculate age
                    $birthDateObj = new DateTime($birthDate);
                    $today = new DateTime();
                    $age = $today->diff($birthDateObj)->y;

                    // Construct full name
                    $fullName = $lname . ', ' . $fname . ' ' . $mdname;

                    if ($age < 18) {
                        echo '<option value="' . htmlspecialchars($fullName) . ' - Guardian: ' . htmlspecialchars($guardianName) . '" data-id="' . $row['clientid'] . '"></option>';
                    } else {
                        echo '<option value="' . htmlspecialchars($fullName) . ' " data-id="' . $row['clientid'] . '"></option>';
                    }
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