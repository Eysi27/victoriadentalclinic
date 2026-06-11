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



            $query = "select * from attachment where soaid=:a and status='Active'";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':a', $soaid);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $imageData = base64_encode($row['attachment']);
                    $imageSrc = 'data:image/png;base64,' . $imageData;
                    echo '
 <div class="col-6 mb-4">
      <img src="' . $imageSrc . '" class="img-fluid rounded shadow-sm" alt="Photo 1" onclick="openPhotoModal(this,\'' . $row["id"] . '\')">
    </div>
';


                }
            } else {
                echo '
                <div class="col-lg-12 text-center">
                No attachment yet.
                </div>
                ';

            }


        } catch (Exception $e) {
            return "Error:" . $e->getMessage();
        }
    }
    //UNTIL THIS CODE

}
//UNTIL HERE COPY
