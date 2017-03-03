<?php
$servername = "localhost:3306";
$username = "root";
$password = "a550125abc";
$dbconnect = new mysqli($servername,$username,$password);
mysqli_select_db($dbconnect,"cookzilla");
if(mysqli_connect_errno()) {
	echo "Connection failed:".mysqli_connect_error();
	exit;
} 

?>