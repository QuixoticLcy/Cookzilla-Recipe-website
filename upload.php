<html>
<head>
</head>

<body>
	<form method="post" enctype="multipart/form-data">

	
	<input name="userfile" type="file" id="userfile"> 
	<input name="upload" type="submit" class="box" id="upload" value=" Upload ">
	

	</form>

<?php
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {

	var_dump($_FILES) ;

	$fileName = $_FILES['userfile']['name'];
	$tmpName  = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];

	$fp      = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	$content = addslashes($content);
	fclose($fp);

	if(!get_magic_quotes_gpc()) {
	    $fileName = addslashes($fileName);
	}

	

	$insert_sql = "INSERT INTO cookzilla.picture VALUES (null,'$content')";
	 if (mysqli_query($dbconnect, $insert_sql)) {
	 	echo "success";
	 } else {echo "failed";
		echo "Error: " . $insert_sql . "<br>" . mysqli_error($dbconnect);}

	$last = mysqli_insert_id($dbconnect);


	$display_sql="SELECT * FROM cookzilla.picture WHERE picID = 93";
	$result=mysqli_query($dbconnect, $display_sql);
	// var_dump($login_query);
	if(mysqli_num_rows($result)>0) {
		$login_rs=mysqli_fetch_assoc($result);
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $login_rs['picFile'] ).'"/>';
			} else {
				echo "display failed";
			}
} 


?>



</body>
</html>