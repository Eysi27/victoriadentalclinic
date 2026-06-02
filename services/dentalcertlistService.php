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

        $searchFields = ['name', 'age', 'gender', 'dentist', 'date'];
        $dynamics = '';

        if (!empty($search)) {
            $orConditions = [];
            foreach ($searchFields as $field) {
                $orConditions[] = "$field LIKE :search";
            }
            $dynamics = '(' . implode(' OR ', $orConditions) . ')';
        }

        $dynamics .= 'ORDER BY date ASC LIMIT :limit OFFSET :offset';
        // Using prepared statements for query to avoid SQL injection
        $query = "SELECT * FROM dentalcertificate WHERE $dynamics ";



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
           
                <td>' . ucwords(strtolower($row["name"])) . '</td>
                <td>' . ucwords(strtolower($row["age"])) . '</td>
                  <td>' . ucwords(strtolower($row["gender"])) . '</td>
                    <td>' . ucwords(strtolower($row["dentist"])) . '</td>
               <td align="center">
        <button 
            class="btn btn-primary btn-circle edit-btn" 
            data-toggle="modal" 
            data-target="#editExpenseModal"
            data-rxid="' . htmlspecialchars($row["certid"]) . '"
            data-date="' . htmlspecialchars($row["date"]) . '"
            data-name="' . htmlspecialchars($row["name"]) . '"
            data-age="' . htmlspecialchars($row["age"]) . '"
            data-gender="' . htmlspecialchars($row["gender"]) . '"
             data-address="' . htmlspecialchars($row["address"]) . '"
               data-license="' . htmlspecialchars($row["license"]) . '"
                 data-dentist="' . htmlspecialchars($row["dentist"]) . '"
                    data-treatment="' . htmlspecialchars($row["treatment"]) . '"
                       data-diagnosis="' . htmlspecialchars($row["diagnosis"]) . '"
        >
            <i class="fas fa-edit"></i>
        </button>

<a href="dentalcertForm.php?certid=' . $row["certid"] . '" 
    class="btn btn-success btn-circle view-prescription-btn" 
   
>
    <i class="fas fa-file-alt"></i>
</a>
         <button 
            class="btn btn-danger btn-circle edit-btn" 
            data-toggle="modal" 
            data-target="#deleteExpenseModal"
            data-id="' . htmlspecialchars($row["certid"]) . '"
           
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