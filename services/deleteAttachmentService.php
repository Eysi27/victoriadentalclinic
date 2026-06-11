<?php
//Service for Registration

require_once('databaseService.php');


$id = urldecode($_POST['id']);



//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->process($id);
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
    public function process($id)
    {
        //:a,:b parameter
        try {

            $query = "update attachment set status='Inactive' where id=:a";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':a', $id);
            $stmt->execute();
            return "Successfully Deleted.";
        } catch (Exception $e) {
            return "Error:" . $e->getMessage();
        }



    }
    //UNTIL THIS CODE

}
//UNTIL HERE COPY



?>