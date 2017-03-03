<?php
include("dbconnect.php");
session_start();

	//sign out
if(isset($_GET['signout'])) {
	unset($_SESSION['uname']);


	echo "<script type='text/javascript'>
	alert(\"sign out success!\");
	window.location.href='index.php';
	</script>";
}
	//sign in
if(isset($_POST['signin'])) {
	$stmt = $dbconnect->prepare('SELECT * FROM cookzilla.user WHERE uname=? AND password=?');
	$password = sha1($_POST['password']);
	$stmt->bind_param('ss', $_POST['username'],$password);
	$stmt->execute();
	$results = $stmt->get_result();

	if(mysqli_num_rows($results)>0) {
		$login_rs=mysqli_fetch_assoc($results);
		$_SESSION['uname']=$login_rs['uname'];

		echo "<script type='text/javascript'>
		alert(\"sign in success!\");
		window.location.href='index.php';
		</script>";
	} else {
		echo "<script type='text/javascript'>
		alert(\"sign in failed!\");
		window.location.href='index.php';
		</script>";
	}
}

	//sign up
if(isset($_POST['signup'])) {

	$signup_sql="insert into cookzilla.user values ('".$_POST['username']."','".sha1($_POST['password'])."','')";

	if (mysqli_query($dbconnect, $signup_sql)) {
		$_SESSION['uname']=$_POST['username'];
		echo "<script type='text/javascript'>
		alert(\"sign up success!\");
		window.location.href='index.php';
		</script>";
	} else {
		echo "Error: " . $signup_sql . "<br>" . mysqli_error($dbconnect);
		echo "<script type='text/javascript'>
		alert(\"sign up failed!\");
		window.location.href='index.php';
		</script>";
	}
}

	//updateProfile
if(isset($_POST['updateProfile'])) {
	$updateProfile_sql="UPDATE cookzilla.user SET profile='".$_POST['profile']."' WHERE uname='".$_SESSION['uname']."';";
	if(mysqli_query($dbconnect, $updateProfile_sql)) {
		echo "<script type='text/javascript'>
		alert(\"profile updated!\");
		window.history.back();
		</script>";			
	};
}

	//newmeeting
if(isset($_POST['newmeeting'])) {

	$gname = urldecode($_POST['gname']);
	var_dump($gname);
	$meetingTitle = $_POST['meetingTitle'];
	$meetingDescription = $_POST['meetingDescription'];
	$startTime = $_POST['startTime'];
	$startTimeobj = date_create($startTime);
	if($startTimeobj > date_create("now")) {
		$sql="insert into meeting values (null,'$gname','$meetingTitle','$meetingDescription','$startTime')";
		var_dump($sql);
		if (mysqli_query($dbconnect, $sql)) {
			echo "<script type='text/javascript'>
			alert(\"propose success!\");
			window.history.back();
			</script>";
		} else {
					//echo "Error: " . $sql . "<br>" . mysqli_error($dbconnect);
			echo "<script type='text/javascript'>
			alert(\"propose failed!\");
			window.history.back();
			</script>";
		}
	} else {
		echo "<script type='text/javascript'>
		alert(\"starttime error !\");
		window.history.back();
		</script>";
	}
}


	//report a meeting
	//1.post uname, meetingID, time, text,pics to handler, add record into report.
	//2.add multiple pictures into picture
	//3.get IDs of pictures, add records into reportpic
if(isset($_POST['report'])) {
		//insert the report text
	$uname = $_POST['uname'];
	$meetingID = $_POST['meetingID'];
	$reportTime = $_POST['reportTime'];
	$reportText = $_POST['reportText'];
	$sql = "INSERT into report values ('$uname','$meetingID','$reportTime','$reportText')";
	if(mysqli_query($dbconnect, $sql)) {
			//upload multiple pics
		$imageNumber = 0;
		if(isset($_FILES['picFile'])) {
			$imageNumber = sizeof($_FILES['picFile']['name']);
		} else {
			echo "<script type='text/javascript'>
			window.history.back();
			</script>";	
		}

		if($imageNumber > 0) {
			for ($i = 0; $i < $imageNumber; $i++) {
				$fileName = $_FILES['picFile']['name'][$i];
				$tmpName  = $_FILES['picFile']['tmp_name'][$i];
				$fileSize = $_FILES['picFile']['size'][$i];
				$fileType = $_FILES['picFile']['type'][$i];

				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);

				if(!get_magic_quotes_gpc()) {
					$fileName = addslashes($fileName);
				}

				$insert_sql = "INSERT INTO picture VALUES (null,'$content')";
				if (mysqli_query($dbconnect, $insert_sql)) {
					echo "success";
				} else {
					echo "Error: " . $insert_sql . "<br>" . mysqli_error($dbconnect);}

					$last = mysqli_insert_id($dbconnect);

					$insert_reportpic_sql = "INSERT into reportpic values ('$uname','$meetingID','$reportTime','$last')";
					mysqli_query($dbconnect, $insert_reportpic_sql);
					echo "<script type='text/javascript'>
					window.history.back();
					</script>";	
				}
			}

		} else {
			echo "Error: ".mysqli_error($dbconnect);
			echo "<script type='text/javascript'>
			alert(\"report failed!\");
			window.history.back();
			</script>";				
		};
	}

	//RSVP
	if(isset($_POST['RSVP'])) {
		$uname = $_POST['uname'];
		$meetingID = $_POST['meetingID'];
		$sql = "INSERT into meetingrsvp values ('$meetingID','$uname')";
		mysqli_query($dbconnect, $sql);
		echo "<script type='text/javascript'>
		window.history.back();
		</script>";
	}

	//new group
	if(isset($_POST['newgroup'])) {
		$stmt = $dbconnect->prepare('INSERT into cookgroup values (?,?)');
		$gname = $_POST['gname'];
		$uname = $_POST['uname'];
		$stmt->bind_param('ss', $gname,$uname);
		$stmt->execute();
		$results = $stmt->get_result();
		echo "<script type='text/javascript'>
		window.history.back();
		</script>";
	}

	//join group
	if(isset($_POST['joingroup'])) {
		$stmt = $dbconnect->prepare('INSERT into cookgroup values (?,?)');
		$gname = $_POST['gname'];
		$uname = $_SESSION['uname'];
		$stmt->bind_param('ss', $gname,$uname);
		$stmt->execute();
		$results = $stmt->get_result();
		echo "<script type='text/javascript'>
		window.history.back();
		</script>";
	}


	//new recipw
	if(isset($_POST['newrecipe'])) {
			
			//insert into runkit_class_emancipate(classname)
		$stmt = $dbconnect->prepare('INSERT INTO recipe  VALUES (null, ?, ?, ?, ?);');
		$stmt->bind_param('ssss', $_SESSION['uname'],$_POST['title'],$_POST['servings'],$_POST['description']);
		$stmt->execute();
		$last = mysqli_insert_id($dbconnect);

			//insert into details
		$detailNumber = sizeof($_POST['ingredient']);
		if($detailNumber > 0 ) {
			for ($i = 0 ; $i < $detailNumber ; $i++) {
				$stmt = $dbconnect->prepare('INSERT INTO ingredientdetail VALUES  (?, ?, ?);');
				$stmt->bind_param('sss', $last, $_POST['ingredient'][$i] , $_POST['quantity'][$i] );
				$stmt->execute();
			}
		}
			//insert into tags
		$tagNumber = sizeof($_POST['tags']);
		if($tagNumber > 0 ) {
			for ($i = 0 ; $i < $tagNumber ; $i++) {
				$stmt = $dbconnect->prepare('INSERT INTO tag  VALUES (?,?);');
				
					
				$stmt->bind_param('ss', $last, $_POST['tags'][$i] );
				$stmt->execute();
			}
		}
		echo "<script type='text/javascript'>
		window.history.back();
		</script>";
	}			




	//add review
	if(isset($_POST['review'])) {
		
		
		// insert into review
		$stmt = $dbconnect->prepare('INSERT INTO review  VALUES (?,?,?,?,?,?,?);');
		$stmt->bind_param('sssssss', $_POST['uname'],$_POST['recipeID'],$_POST['reportTime'],$_POST['rate'],$_POST['title'],$_POST['reviewText'],$_POST['suggestion'] );
		$stmt->execute();
		echo "Error: "   . "<br>" . mysqli_error($dbconnect);

		// insert multiple pic into picture and reviewpic
		
		$imageNumber = 0;
		if(isset($_FILES['picFile'])) {
			$imageNumber = sizeof($_FILES['picFile']['name']);
		} else {
			echo "<script type='text/javascript'>
			window.history.back();
			</script>";	
		}

		if($imageNumber > 0) {
			for ($i = 0; $i < $imageNumber; $i++) {
				$fileName = $_FILES['picFile']['name'][$i];
				$tmpName  = $_FILES['picFile']['tmp_name'][$i];
				$fileSize = $_FILES['picFile']['size'][$i];
				$fileType = $_FILES['picFile']['type'][$i];

				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);

				if(!get_magic_quotes_gpc()) {
					$fileName = addslashes($fileName);
				}

				$insert_sql = "INSERT INTO picture VALUES (null,'$content')";
				if (mysqli_query($dbconnect, $insert_sql)) {
					echo "success";

					

					$last = mysqli_insert_id($dbconnect);
					$recipeID = $_POST['recipeID'];
					$uname = $_SESSION['uname'];
					$reviewTime = $_POST['reportTime'];
					$insert_reportpic_sql = "INSERT into reviewpic values ('$uname','$recipeID','$reviewTime', '$last')";
					if(mysqli_query($dbconnect, $insert_reportpic_sql)) {
			echo "<script type='text/javascript'>
			window.history.back();
			</script>";
					} else {
						echo $insert_reportpic_sql.":" .mysqli_error($dbconnect);
					};
				}
			}

		}
	}





	// add pic to recipes
	if (isset($_POST['addrecipepic'])) {
		
		$imageNumber = 0;
		if(isset($_FILES['picFile'])) {
			$imageNumber = sizeof($_FILES['picFile']['name']);
		} else {
			echo "<script type='text/javascript'>
			window.history.back();
			</script>";	
		}
		if($imageNumber > 0) {
			for ($i = 0; $i < $imageNumber; $i++) {
				$fileName = $_FILES['picFile']['name'][$i];
				$tmpName  = $_FILES['picFile']['tmp_name'][$i];
				$fileSize = $_FILES['picFile']['size'][$i];
				$fileType = $_FILES['picFile']['type'][$i];

				$fp      = fopen($tmpName, 'r');
				$content = fread($fp, filesize($tmpName));
				$content = addslashes($content);
				fclose($fp);

				if(!get_magic_quotes_gpc()) {
					$fileName = addslashes($fileName);
				}

				$insert_sql = "INSERT INTO picture VALUES (null,'$content')";
				if (mysqli_query($dbconnect, $insert_sql)) {
					echo "success";
				} else {
					echo "Error: " . $insert_sql . "<br>" . mysqli_error($dbconnect);}

					$last = mysqli_insert_id($dbconnect);
					$recipeID = $_POST['recipeID'];
					$insert_reportpic_sql = "INSERT into recipepic values ('$recipeID','$last')";
					mysqli_query($dbconnect, $insert_reportpic_sql);
			echo "<script type='text/javascript'>
			window.history.back();
			</script>";
				}
			}
		}

	// delete recipe
	if(isset($_GET['delete'])) {
		$recipeID = $_GET['delete'];

		$stmt = $dbconnect->prepare('DELETE from recipepic where recipeID = ?');
		$stmt->bind_param('s', $recipeID);
		$stmt->execute();

		$stmt = $dbconnect->prepare('DELETE from ingredientdetail where recipeID = ?');
		$stmt->bind_param('s', $recipeID);
		$stmt->execute();

		$stmt = $dbconnect->prepare('DELETE from tag where recipeID = ?');
		$stmt->bind_param('s', $recipeID);
		$stmt->execute();

		$stmt = $dbconnect->prepare('DELETE from recipe where recipeID = ?');
		$stmt->bind_param('s', $recipeID);
		$stmt->execute();

		echo "<script type='text/javascript'>
		alert(\"recipe deleted!\");
		window.history.back();
		</script>";	
	}







			?>