<?php
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

        $offset = ($page - 1) * $itemPerPage;  // Calculate the offset for pagination

        $searchFields = ['name', 'accountnumber', "hmotype", "company", "contact", "agent", "verificationStatus"];
        $dynamics = '';

        if (!empty($search)) {
            $orConditions = [];
            foreach ($searchFields as $field) {
                $orConditions[] = "$field LIKE :search";
            }
            $dynamics = 'AND (' . implode(' OR ', $orConditions) . ')';
        }
        $dynamics .= 'ORDER BY name ASC  LIMIT :limit OFFSET :offset';

        $query = "select * from hmo where status='Active' $dynamics";
        $stmt = $this->conn->prepare($query);
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $itemPerPage, PDO::PARAM_INT);  // Ensure itemPerPage is treated as an integer
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);  // 

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                echo '
                <tr style="color: black;">
              
                <td>' . ucwords(strtolower($row["name"])) . '</td>
                <td>' . $row["hmo"] . '</td>
                  <td>' . $row["accountnumber"] . '</td>
                  <td>' . $row["hmotype"] . '</td>
                <td>' . $row["dob"] . '</td>
                  <td>' . $row["company"] . '</td>
                <td>' . $row["contact"] . '</td>
                <td>' . ucwords(strtolower($row["agent"])) . '</td>
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