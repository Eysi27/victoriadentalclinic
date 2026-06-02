<?php
require_once('databaseService.php');
$service = new ServiceClass();

$result = $service->loadClientTreatment($_POST);

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
    public function loadClientTreatment($data)
    {
        $month = $data['month'];
        $year = $data['year'];

        // If both dates are provided
        $query = "SELECT * from expenses where month(date) = :month and year(date) = :year ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':month', $month);
        $stmt->bindParam(':year', $year);


        $stmt->execute();
        $total = 0;

        echo ' <br> <br>   <div class="table-responsive">
                                    <table class="table text-dark" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th  style="text-align:left;">Date</th>
                                                <th style="text-align:center;">Particulars</th>
                                                <th style="text-align:center;">Description</th>
                                                <th style="text-align:right;">Amount</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody id="resultResponsez">
                                     ';
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $total += $row["amount"];

                echo '
                <tr style="color: black;">
                <td style="text-align:left;">' . $row["date"] . '</td>
                 <td style="text-align:center;">' . $row["particular"] . '</td>
                  <td style="text-align:center;">' . $row["description"] . '</td>
                   <td style="text-align:right;">' . number_format($row["amount"], 2) . '</td>


            </tr>';


            }

        }


        echo '
        </table>
      
';

        //END GROUPING
        echo '
        <hr>
<div style="margin-top: 20px; padding: 15px; border: 1px solid #ccc; background-color: #f9f9f9; border-radius: 8px;">
    <h5 style="margin-bottom: 15px; text-align: center;"> <strong> Summary Report</strong></h5>
    
    <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
        <span><strong>Grand Total:</strong></span>
        <span>₱' . number_format($total, 2) . '</span>
    </div>
   

        <hr>
   
</div>
';
    }
}
