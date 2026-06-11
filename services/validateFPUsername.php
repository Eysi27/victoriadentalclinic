<?php

require_once('databaseService.php');
$username = urldecode($_POST['username']);
//INHERITANCE -- CREATING NEW INSTANCE OF A CLASS (INSTANTIATE)
$service = new ServiceClass();
$email = $service->validateUser($username);


if($email ==""){
    echo'unrecognized';
}else{
	
    echo $service->sendEmail($email);

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
	//DO NOT INCLUDE THIS CODE
    public function validateUser($username){
        $query = "select * from users where username=:a";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':a', $username);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $row["email"];
            }
			
		} else {
			return "";
		}
    }

    public function sendEmail($email){
  
		$characters ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 10; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		
	   $query = "update users set password=:b where email=:a";
	   $stmt = $this->conn->prepare($query);
	   $stmt->bindParam(':a', $email);
	   $stmt->bindParam(':b', $randomString);
	   $stmt->execute();
   
	  

	   $msg = "Your password has been reset. Your new password is ".$randomString;
	   $msg = wordwrap($msg,70);
	   mail($email,"PASSWORD RESET",$msg);
	   return 'recognized';
    }
	//UNTIL THIS CODE

}
//UNTIL HERE COPY



?>
