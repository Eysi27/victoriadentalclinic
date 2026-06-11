<?php
require_once('databaseService.php');
$service = new ServiceClass();
$result = $service->loadTreatmentList();

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
    //DO NOT INCLUDE THIS CODE
    public function loadTreatmentList()
    {



        $query = "select * from hmo where status='Active'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                echo '
                <tr>
              
                <td>' . $row["name"] . '</td>
                <td>' . $row["hmo"] . '</td>
                  <td>' . $row["accountnumber"] . '</td>
                <td>' . $row["dob"] . '</td>
                  <td>' . $row["company"] . '</td>
                <td>' . $row["contact"] . '</td>
                <td>' . $row["agent"] . '</td>
                <td>' . $row["verificationStatus"] . '</td>

                <td align="center">
                <a href="updatehmo.php?id=' . $row["id"] . '" class="btn btn-warning btn-circle" title="Update record"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-circle" onclick="deletehmo(\'' . $row["id"] . '\')" title="Delete record"><i class="fas fa-trash"></i></a>
                
                
                </td>
            </tr>';
            }

        }
    }

}







?>