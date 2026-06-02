<?php
session_start();
require_once('databaseService.php');
$service = new ServiceClass();
$service->process($_POST);

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
            // Get form data
            $rxid = $data['rxid'];
            $date = $data['date'];
            $name = $data['name'];
            $age = $data['age'];
            $gender = $data['gender'];
            $dentist = $data['dentist'];
            $license = $data['license'];
            $address = $data['address'];
            $rxids = $data['rxids']; // comma-separated medicine IDs

            // Begin transaction
            $this->conn->beginTransaction();

            if (!empty($rxid)) {
                // Update if rxid exists
                $query = "UPDATE prescription SET date = :date, name = :name, age = :age, gender = :gender, dentist = :dentist, license = :license, address = :address WHERE rxid = :rxid";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':rxid', $rxid);
            } else {
                // Insert new if rxid is empty (assuming rxid is AUTO_INCREMENT)
                $query = "INSERT INTO prescription (date, name, age, gender, address,dentist,license) VALUES (:date, :name, :age, :gender, :address,:dentist,:license)";
                $stmt = $this->conn->prepare($query);
            }

            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':dentist', $dentist);
            $stmt->bindParam(':license', $license);
            $stmt->bindParam(':address', $address);
            $stmt->execute();

            // 🔁 Get last inserted rxid if it was new
            if (empty($rxid)) {
                $rxid = $this->conn->lastInsertId(); // <-- Get the generated rxid
            }

            // ❌ Delete all existing prescriptionsub records for this rxid
            $deleteQuery = "DELETE FROM prescriptionsub WHERE rxid = :rxid";
            $deleteStmt = $this->conn->prepare($deleteQuery);
            $deleteStmt->bindParam(':rxid', $rxid);
            $deleteStmt->execute();

            // ➕ Insert new prescriptionsub rows
            if (!empty($rxids)) {
                $medicineIds = explode(',', $rxids);
                $insertQuery = "INSERT INTO prescriptionsub (rxid, medicineid) VALUES (:rxid, :medicineid)";
                $insertStmt = $this->conn->prepare($insertQuery);

                foreach ($medicineIds as $medicineid) {
                    $medicineid = trim($medicineid);
                    if (!empty($medicineid)) {
                        $insertStmt->bindParam(':rxid', $rxid);
                        $insertStmt->bindParam(':medicineid', $medicineid);
                        $insertStmt->execute();
                    }
                }
            }

            $this->conn->commit();
            echo 'success';
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo 'Error: ' . $e->getMessage();
        }

    }
}
?>