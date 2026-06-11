<?php
session_start();
if(isset($_SESSION['username'])){
	echo'logged';
}else{
	echo'loggedout';
}





?>