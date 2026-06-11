<?php
//Service for Registration

require_once('databaseService.php');
$ref = urldecode($_POST['ref']);
$currentvalue = urldecode($_POST['currentvalue']);
$column = urldecode($_POST['column']);
$table = urldecode($_POST['table']);
$newvalue = urldecode($_POST['value']);
$refname = urldecode($_POST['refname']);
$service = new ServiceClass();
$result = $service->createTicket($ref, $currentvalue, $column, $table, $newvalue, $refname);

//USE THIS AS YOUR BASIS
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
    public function createTicket($ref, $currentvalue, $column, $table, $newvalue, $refname)
    {
        try {
            $date = date("Y-m-d h:i:sa");
            $status = "Pending";
            $query = "insert into tickets (ref,columnname,tablename,curval,newval,status,daterequested) values (:a,:b,:c,:d,:e,:f,:g)";
            $stmt = $this->conn->prepare($query);
            //setting of parameter
            $stmt->bindParam(':a', $ref);
            $stmt->bindParam(':b', $column);
            $stmt->bindParam(':c', $table);
            $stmt->bindParam(':d', $currentvalue);
            $stmt->bindParam(':e', $newvalue);
            $stmt->bindParam(':f', $status);
            $stmt->bindParam(':g', $date);
            //trigger
            $stmt->execute();

            $ticketid = 0;
            $query = "select max(ticketid) as lastticketid from tickets";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $ticketid = $row["lastticketid"];
                }

            }

            session_start();
            $msg = "<html>
            <body>
            <p>Dear IT Support,</p>
            <strong><p>You have pending items that needs your review.</p>
            </strong>
            <p>Ticket ID: " . $ticketid . " : Change value of column <strong> " . $column . " </strong> for table <strong> " . $table . "</strong> from current value <strong>" . $currentvalue . " </strong> to new value <strong>" . $newvalue . "</strong>. Date Requested : " . $date . "
            <br>
            Please select action:
            <a href=\"https://system.smilesavedental.ph/support/index.php?action=1&ref=" . $ref . "&refname=" . $refname . "&ticketid=" . $ticketid . "&tablename=" . $table . "&column=" . $column . "&currentvalue=" . urlencode($currentvalue) . "&newvalue=" . urlencode($newvalue) . "\"><button>Approve</button></a>
            <a href=\"https://system.smilesavedental.ph/support/index.php?action=2&ref=" . $ref . "&refname=" . $refname . "&ticketid=" . $ticketid . "&tablename=" . $table . "&column=" . $column . "&currentvalue=" . urlencode($currentvalue) . "&newvalue=" . urlencode($newvalue) . "\"><button>Decline</button></a>
            
            </body>
            </html>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <ServiceBot@smilesavedental.ph>' . "\r\n";
            mail($_SESSION["supportemail"], "SmileSaveDental Ticket#" . $ticketid, $msg, $headers);



        } catch (Exception $e) {
            return "Error:" . $e->getMessage();
        }
    }
    //UNTIL THIS CODE

}
//UNTIL HERE COPY
