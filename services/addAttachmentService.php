<?php
//Service for Registration

require_once('databaseService.php');
$base64Image = $_POST['attachment'];

// Remove the metadata from base64
$base64Image = str_replace('data:image/png;base64,', '', $base64Image);
$base64Image = str_replace(' ', '+', $base64Image);

$attachment = base64_decode($base64Image);
$soaid = urldecode($_POST['soaid']);



//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->process($soaid, $attachment);
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
    public function process($soaid, $attachment)
    {
        //:a,:b parameter
        try {

            $query = "insert into attachment (attachment,soaid,status) values (:a,:b,'Active')";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $attachment, PDO::PARAM_LOB);
            $stmt->bindParam(':b', $soaid);
            $stmt->execute();
            return "success";
        } catch (Exception $e) {
            return "Error:" . $e->getMessage();
        }



    }
    //UNTIL THIS CODE

}
//UNTIL HERE COPY



?>