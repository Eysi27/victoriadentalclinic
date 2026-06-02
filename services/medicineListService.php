<?php
require_once('databaseService.php');
$service = new ServiceClass();
$result = $service->process();

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
    public function process()
    {



        $query = "select * from medicine";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                echo '
                <tr style="color: black;">
              
                <td>' . $row["genericname"] . '</td>
                <td>' . $row["dispense"] . '</td>
                 <td>' . $row["signetur"] . '</td>
               
                <td align="center">

                <a href="#" class="btn btn-warning btn-circle"
   data-toggle="modal"
   data-target="#editTreatmentModal"
   data-treatmentid="' . $row["medicineid"] . '"
   data-genericname="' . htmlspecialchars($row["genericname"]) . '"
   data-dispense="' . htmlspecialchars($row["dispense"]) . '"
   data-signetur="' . htmlspecialchars($row["signetur"]) . '"
   title="Update treatment">
    <i class="fas fa-edit"></i>
</a>

 
                <a href="#" class="btn btn-danger btn-circle" onclick="deleteMedicine(\'' . $row["medicineid"] . '\')" title="Delete Medicine"><i class="fas fa-trash"></i></a>
                
                
                </td>
            </tr>';
            }



        }
    }

}







?>