<?php
require_once('databaseService.php');
$service = new ServiceClass();

$search = urldecode($_POST['search']);
$searchParam = '%' . $search . '%';
$itemPerPage = isset($_POST['item']) ? (int) $_POST['item'] : 10;

$page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
$paginationData = $service->process($searchParam, $itemPerPage, $page);

$totalRecords = $paginationData['totalRecords'];
$totalPages = ceil($totalRecords / $itemPerPage); // Calculate total pages
$currentPage = $paginationData['currentPage'];

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
    public function process($search, $itemPerPage, $page)
    {


        $searchFields = ['hmo', 'nickname', 'sex', 'mobilenumber', "CONCAT(a.lname, ', ', a.fname, ' ', a.mdname)"];
        $dynamics = '';

        if (!empty($search)) {
            $orConditions = [];
            foreach ($searchFields as $field) {
                $orConditions[] = "$field LIKE :search";
            }
            $dynamics = 'AND (' . implode(' OR ', $orConditions) . ')';
        }
        $dynamics .= 'ORDER BY CONCAT(lname, \', \', fname, \' \', mdname)';
        // Using prepared statements for query to avoid SQL injection
        $query = "SELECT count(clientid) as itemCount FROM clientprofile a WHERE (status != 'Deleted' OR status IS NULL) $dynamics";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->execute();
        $totalRecords = 0;
        if ($stmt->rowCount() > 0) {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $totalRecords = $row["itemCount"];
            }
            return [
                'totalRecords' => $totalRecords,
                'totalPages' => ceil($totalRecords / $itemPerPage),
                'currentPage' => $page
            ];
        }

    }

}
echo '<nav aria-label="Page navigation">';
echo '<ul class="pagination justify-content-center">';

// Previous page
if ($currentPage > 1) {
    echo '<li class="page-item">';
    echo '<a class="page-link" href="#" onclick="setPage(' . ($currentPage - 1) . ')" aria-label="Previous">';
    echo '<span aria-hidden="true">&laquo;</span>';
    echo '</a>';
    echo '</li>';
}

$visiblePages = 5;
$start = max(1, $currentPage - floor($visiblePages / 2));
$end = min($totalPages, $start + $visiblePages - 1);

if ($start > 1) {
    echo '<li class="page-item"><a class="page-link" href="#" onclick="setPage(1)">1</a></li>';
    if ($start > 2) {
        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
    }
}

for ($i = $start; $i <= $end; $i++) {
    $active = ($i == $currentPage) ? 'active' : '';
    echo '<li class="page-item ' . $active . '">';
    echo '<a class="page-link" href="#" onclick="setPage(' . $i . ')">' . $i . '</a>';
    echo '</li>';
}

if ($end < $totalPages) {
    if ($end < $totalPages - 1) {
        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
    }
    echo '<li class="page-item"><a class="page-link" href="#" onclick="setPage(' . $totalPages . ')">' . $totalPages . '</a></li>';
}

// Next page
if ($currentPage < $totalPages) {
    echo '<li class="page-item">';
    echo '<a class="page-link" href="#" onclick="setPage(' . ($currentPage + 1) . ')" aria-label="Next">';
    echo '<span aria-hidden="true">&raquo;</span>';
    echo '</a>';
    echo '</li>';
}

echo '</ul>';
echo '</nav>';



$startRecord = ($currentPage - 1) * $itemPerPage + 1;
$endRecord = min($startRecord + $itemPerPage - 1, $totalRecords);

echo '<div class="text-center mb-2">';
echo "Showing <strong>$startRecord</strong> to <strong>$endRecord</strong> of <strong>$totalRecords</strong> Entries";
echo '</div>';



?>