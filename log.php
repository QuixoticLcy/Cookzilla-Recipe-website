<?php 
	function loguser($logtype) {
		include("dbconnect.php");
		if (isset($_SESSION['uname'])) {
			$uname = $_SESSION['uname'];
			$time= date("Y-m-d H:i:s");
			if($logtype == "recipe") {
				$value = $_GET['recipeID'];
				$sql = "INSERT into log values ('$uname','$logtype','$value','$time')";
				mysqli_query($dbconnect, $sql);
			} else if ($logtype == "search_title" || $logtype == "search_description" || $logtype == "search_tag") {
				$value = $_GET['keyword'];
				$sql = "INSERT into log values ('$uname','$logtype','$value','$time')";
				mysqli_query($dbconnect, $sql);
			} 
		}
	}

?>