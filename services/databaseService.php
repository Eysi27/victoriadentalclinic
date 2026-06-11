<?php
header('Access-Control-Allow-Origin: *');
?>
<?php
date_default_timezone_set("Asia/Manila");
class Database
{
    // local   // // local
    private $host = "localhost";
    private $db_name = "vadc_db";
    private $username = "root";
    private $password = '';


    //prod

    // private $host = "216.218.206.42";
    // private $db_name = "smilesan_official";
    // private $username = "smilesan_admin";
    // private $password = 'G[aZ=F,G*~OT';



    public $conn;

    public function dbConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
        //include_once 'class.crud.php';

        //$crud = new crud($conn);
    }
}

?>