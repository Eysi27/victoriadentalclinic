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
            if (!isset($data['clientId'])) {
                throw new Exception("clientId is required for update.");
            }

            $clientId = $data['clientId'];
            $maxFields = 25;
            $keys = array_keys($data);
            $keys = array_filter($keys, fn($key) => $key !== 'clientId');
            $keys = array_slice($keys, 0, $maxFields);

            $setClauses = [];
            $bindings = [];

            foreach ($keys as $index => $key) {
                $placeholder = ':' . chr(97 + $index);
                $setClauses[] = "$key = $placeholder";
                $bindings[$placeholder] = $data[$key];
            }

            $query = "UPDATE medhistoryv2 SET " . implode(', ', $setClauses) . " WHERE clientId = :clientId";
            $stmt = $this->conn->prepare($query);

            foreach ($bindings as $ph => $val) {
                $stmt->bindValue($ph, $val);
            }

            $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0 ? "success" : "There is no changes to update.";

        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }


    }
    //UNTIL THIS CODE

}
//UNTIL HERE COPY



?>