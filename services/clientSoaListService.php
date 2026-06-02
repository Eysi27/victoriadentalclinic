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

        $searchFields = ['a.dentist', 'a.date', "concat(b.lname,', ',b.fname, ' ', b.mdname)"];
        $dynamics = '';

        if (!empty($search)) {
            $orConditions = [];
            foreach ($searchFields as $field) {
                $orConditions[] = "$field LIKE :search";
            }
            $dynamics = 'WHERE (' . implode(' OR ', $orConditions) . ')';
        }
        $dynamics .= ' order by soaid desc  LIMIT :limit OFFSET :offset';

        $query = "select a.date,a.time,a.soaid,a.dentist,a.total, concat(b.lname,', ',b.fname, ' ', b.mdname) as fullname from treatmentsoa a inner join clientprofile b on a.clientid=b.clientid  $dynamics ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $itemPerPage, PDO::PARAM_INT);  // Ensure itemPerPage is treated as an integer
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $payment = 0;
                $soaid = $row["soaid"];
                $query2 = "SELECT amount FROM treatmentsubpayment WHERE tsubid in (select tsubid from treatmentsub where soaid=:x)";
                $stmt2 = $this->conn->prepare($query2);
                $stmt2->bindParam(':x', $soaid);
                $stmt2->execute();
                if ($stmt2->rowCount() > 0) {

                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        $payment += $row2["amount"];
                    }
                }
                echo '
                    <tr style="color: black;">
                    <td>' . date("Y/m/d", strtotime($row["date"])) . '</td>
                    <td>' . $row["time"] . '</td>
                     <td>' . ucwords(strtolower($row["fullname"])) . '</td>
                      <td>' . ucwords(strtolower($row["dentist"])) . '</td>
      
                    <td>' . $row["total"] . '</td>
                    <td>' . ($row["total"] - $payment) . '</td>
                    <td style="text-align:center;">';
                echo '
               
                <button class="btn btn-warning edit-btn btn-circle"
    data-soaid="' . $row["soaid"] . '"
     data-dentist="' . $row["dentist"] . '"
    data-date="' . htmlspecialchars($row["date"], ENT_QUOTES) . '"
    data-time="' . htmlspecialchars($row["time"], ENT_QUOTES) . '"
    
    data-toggle="modal" data-target="#editModal">
    <i class="fas fa-edit"></i>
  </button>
                <a class="btn btn-success btn-circle" href="soaViewing.php?soaid=' . $row["soaid"] . '" title="View SOA"><i class="fas fa-eye"></i></a>
                      <a class="btn btn-primary btn-circle" href="attachment.php?soaid=' . $row["soaid"] . ' title="View Attachment"><i class="fas fa-paperclip"></i></a>
                   </td>
                </tr>';
            }
        }
    }
}
