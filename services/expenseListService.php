<?php
session_start();
require_once('databaseService.php');
$service = new ServiceClass();

$search = urldecode($_POST['search']);
$searchParam = '%' . $search . '%';
$page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
$itemPerPage = isset($_POST['item']) ? (int) $_POST['item'] : 10;
$result = $service->process($searchParam, $page, $itemPerPage);

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
    public function process($search, $page, $itemPerPage)
    {
        $superuser = "nikesarmiento";

        $offset = ($page - 1) * $itemPerPage;  // Calculate the offset for pagination

        $searchFields = ['particular', 'description', 'amount', 'date'];
        $dynamics = '';

        if (!empty($search)) {
            $orConditions = [];
            foreach ($searchFields as $field) {
                $orConditions[] = "$field LIKE :search";
            }
            $dynamics = '(' . implode(' OR ', $orConditions) . ')';
        }

        $dynamics .= 'ORDER BY expenseid DESC LIMIT :limit OFFSET :offset';
        // Using prepared statements for query to avoid SQL injection
        $query = "SELECT * FROM expenses WHERE $dynamics ";



        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $itemPerPage, PDO::PARAM_INT);  // Ensure itemPerPage is treated as an integer
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);  // Ensure offset is treated as an integer
        $stmt->execute();
        if ($stmt->rowCount() > 0) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                echo '
                <tr style="color: black;">
                <td>' . $row["date"] . '</td>
           
                <td>' . ucwords(strtolower($row["particular"])) . '</td>
              
                <td>' . ucwords(strtolower($row["description"])) . '</td>
        
                <td style="text-align:right">' . number_format($row["amount"], decimals: 2) . '</td>
               
     
               
               <td align="center">
        <button 
            class="btn btn-primary btn-circle edit-btn" 
            data-toggle="modal" 
            data-target="#editExpenseModal"
            data-id="' . htmlspecialchars($row["expenseid"]) . '"
            data-date="' . htmlspecialchars($row["date"]) . '"
            data-particular="' . htmlspecialchars($row["particular"]) . '"
            data-description="' . htmlspecialchars($row["description"]) . '"
            data-amount="' . htmlspecialchars($row["amount"]) . '"
        >
            <i class="fas fa-edit"></i>
        </button>


         <button 
            class="btn btn-danger btn-circle edit-btn" 
            data-toggle="modal" 
            data-target="#deleteExpenseModal"
            data-id="' . htmlspecialchars($row["expenseid"]) . '"
           
        >
            <i class="fas fa-trash"></i>
        </button>
    </td>
            </tr>';
            }

        }
    }

}







?>