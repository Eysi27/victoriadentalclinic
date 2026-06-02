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

        $searchFields = ['dentist', 'date', "concat(b.lname,', ',b.fname, ' ', b.mdname)"];
        $dynamics = '';

        if (!empty($search)) {
            $orConditions = [];
            foreach ($searchFields as $field) {
                $orConditions[] = "$field LIKE :search";
            }
            $dynamics = 'AND (' . implode(' OR ', $orConditions) . ')';
        }
        $dynamics .= '  LIMIT :limit OFFSET :offset';
        $query = "select b.*,concat(b.lname,', ',b.fname, ' ', b.mdname) as fullname,a.id,a.dentist,a.date from consent a inner join clientprofile b on a.clientid=b.clientid where a.status='Active' $dynamics";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $itemPerPage, PDO::PARAM_INT);  // Ensure itemPerPage is treated as an integer
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);  // 
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                echo '
                <tr>
                <td>' . ucwords(strtolower($row["fullname"])) . '</td>
                <td>' . $row["dentist"] . '</td>
                 <td>' . date("Y/m/d", strtotime($row["date"])) . '</td>
               
                <td align="center">
                
                ';
                echo '
                <a href="viewConsent.php?dentist=' . $row["dentist"] . '&date=' . $row["date"] . '&consentid=' . $row["id"] . '&civilStatus=' . $row["civilstatus"] . '&company=' . $row["company"] . '&cardNumber=' . $row["cardnumber"] . '&hmo=' . $row["hmo"] . '&religion=' . $row["religion"] . '&clientid=' . $row["clientid"] . '&lname=' . $row["lname"] . '&fname=' . $row["fname"] . '&mname=' . $row["mdname"] . '&nick=' . $row["nickname"] . '&age=' . $row["age"] . '&sex=' . $row["sex"] . '&occupation=' . $row["occupation"] . '
                &birthDate=' . $row["birthDate"] . '&mobileNumber=' . $row["mobileNumber"] . '&homeAddress=' . $row["homeAddress"] . '
                &guardianName=' . $row["guardianName"] . '&gOccupation=' . $row["gOccupation"] . '&refferedBy=' . $row["refferedBy"] . '
                " class="btn btn-secondary btn-circle" title="View Client Consent"><i class="fas fa-eye"></i></a>
                ';
                echo '
                
                </td>
            </tr>';
            }

        }
    }

}







?>