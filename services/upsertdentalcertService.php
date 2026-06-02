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
            $treatment = $data['treatment'];
            $diagnosis = $data['diagnosis'];

            // Begin transaction
            $this->conn->beginTransaction();


            if (!empty($rxid)) {
                // Update if rxid exists
                $query = "UPDATE dentalcertificate SET treatment=:treatment, diagnosis=:diagnosis,date = :date, name = :name, age = :age, gender = :gender, dentist = :dentist, license = :license, address = :address WHERE certid = :rxid";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':rxid', $rxid);
            } else {
                // Insert new if rxid is empty (assuming rxid is AUTO_INCREMENT)
                $query = "INSERT INTO dentalcertificate (date, name, age, gender, address,dentist,license, treatment,diagnosis) VALUES (:date, :name, :age, :gender, :address,:dentist,:license, :treatment,:diagnosis)";
                $stmt = $this->conn->prepare($query);
            }

            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':dentist', $dentist);
            $stmt->bindParam(':license', $license);
            $stmt->bindParam(':address', $address);

            $stmt->bindParam(':treatment', $treatment);
            $stmt->bindParam(':diagnosis', $diagnosis);
            $stmt->execute();
            $this->conn->commit();
            echo 'success';
        } catch (Exception $e) {
            $this->conn->rollBack();
            echo 'Error: ' . $e->getMessage();
        }

    }
}
?>