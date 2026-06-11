<?php
//Service for Registration

require_once('databaseService.php');






//echo'<script>alert("tesT");</script>';
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->process($_POST);
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
    public function process($data)
    {
        try {

            $clientId = 0;
            $query = "select clientid from clientprofile order by clientid desc limit 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $clientId = $row["clientid"];
                }

            }
            // Limit the number of values to how many placeholders you're planning to bind
            $maxFields = 25; // change this based on how many fields you want to accept
            $keys = array_keys($data);
            $keys = array_slice($keys, 0, $maxFields);

            // Prepare columns and placeholder binding names (:a, :b, :c, ...)
            $columns = [];
            $placeholders = [];
            $bindings = [];

            foreach ($keys as $index => $key) {
                $columns[] = $key;
                $placeholder = ':' . chr(97 + $index); // 'a', 'b', 'c', ...
                $placeholders[] = $placeholder;
                $bindings[$placeholder] = $data[$key];
            }

            // Create query string
            $query = "INSERT INTO medhistoryv2 (clientId," . implode(',', $columns) . ")
                  VALUES (:clientId," . implode(',', $placeholders) . ")";

            $stmt = $this->conn->prepare($query);

            // Bind all values
            foreach ($bindings as $ph => $val) {
                $stmt->bindValue($ph, $val);
            }

            $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
            $stmt->execute();
            return "success";

        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }


    }
    //UNTIL THIS CODE

}
//UNTIL HERE COPY



?>