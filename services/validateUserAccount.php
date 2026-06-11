<?php
//Service for login

require_once('databaseService.php');
$username = urldecode($_POST['username']);
$password = urldecode($_POST['password']);
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$result = $service->loginAccount($username, $password);
if ($result) {
	echo 'success';
} else {
	echo 'failed';
}

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
	public function loginAccount($username, $password)
	{
		$query = "select * from users where username=:a and password=:b";
		$stmt = $this->conn->prepare($query);
		//setting of parameter
		$stmt->bindParam(':a', $username);
		$stmt->bindParam(':b', $password);
		//trigger
		$stmt->execute();
		//for select query
		if ($stmt->rowCount() > 0) {
			session_start();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				//

				$_SESSION['username'] = $row["username"];
				$_SESSION['password'] = $row["password"];
				$_SESSION['email'] = $row["email"];
				$_SESSION['lastUpdate'] = $row["lastUpdate"];


			}

			$query2 = "select status from notifconfig where name='notif-email'";
			$stmt2 = $this->conn->prepare($query2);
			//setting of parameter


			//trigger
			$stmt2->execute();
			//for select query
			if ($stmt2->rowCount() > 0) {

				while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
					$_SESSION['notifemail'] = $row2["status"];
				}

			}

			$query3 = "select status from notifconfig where name='support-email'";
			$stmt3 = $this->conn->prepare($query3);
			//setting of parameter


			//trigger
			$stmt3->execute();
			//for select query
			if ($stmt3->rowCount() > 0) {

				while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
					$_SESSION['supportemail'] = $row3["status"];
				}

			}

			return true;
		} else {
			return false;
		}
	}
	//UNTIL THIS CODE

}
//UNTIL HERE COPY



?>