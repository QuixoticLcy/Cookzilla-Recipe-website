<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="favicon.ico">

	<title>Create Recipe</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/offcanvas.css" rel="stylesheet">

	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<script src="js/ie-emulation-modes-warning.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
        h1,h2 {
        	text-align: center;
        }
        p{
        	text-align: center;
        }
        </style>
    </head>
    <!-- <hr>this is your members: -->
    <body>
    	<div class="container">

    		<h2>Description:</h2>
    		<?php
    		$meetingID = $_GET['meetingID'];
    		$sql = "SELECT * from cookzilla.meeting where meetingID = '$meetingID'";
    		$results = mysqli_query($dbconnect, $sql);

    		if (mysqli_num_rows($results) > 0) {
    			$row = mysqli_fetch_assoc($results);
    			$meetingDescription = $row['meetingDescription'];
    			$startTime = $row['startTime'];
    			echo "<h4>$meetingDescription</h4>";
                echo "<br>";
    			
    		} else {
    			echo "0 results";
    		}
    		?>

    		<div class="row row-offcanvas row-offcanvas-right col-sm-12">
    			<!-- label ><h3>Your RSVP meetings:</h3></label> -->
    			<table class="table form-group ">
    				<thead>
    					<tr>
    						<th><h4>Member:</h4></th>
    					</tr>
    				</thead>
    				<tbody>
    					<!-- <hr>this is your  rsvp members: -->
    					<?php
    					$meetingID = $_GET['meetingID'];
    					$sql = "SELECT * from cookzilla.meetingrsvp where meetingID = '$meetingID'";
    					$results = mysqli_query($dbconnect, $sql);

    					if (mysqli_num_rows($results) > 0) {
    						while($row = mysqli_fetch_assoc($results)) {
    							$uname = $row['uname'];
    							$herf = "index.php?page=profile&uname=$uname";
    							echo "<tr>";
    							echo "<td>";
    							echo "<a href=$herf>$uname</a> ";
    							echo "</td>";
    							echo "</tr>";
    						}
    					} else {
    						echo "<tr>";
    						echo "<td>";
    						echo "0 results";
    						echo "</td>";
    						echo "</tr>";
    					}
    					?>
                    </tbody>
                </table>
                        <div class= "col-lg-12">
<!--     					<label><h4>you can RSVP this meeting if it's coming!</h4></label> -->
                        </div>
    					<?php 	
    					$uname = $_SESSION['uname'];
    					$sql = "SELECT * from cookzilla.meetingrsvp where meetingID = '$meetingID' and uname = '$uname'";
    					$results = mysqli_query($dbconnect, $sql);
    					$RSVPed = mysqli_num_rows($results) > 0;
    					if($RSVPed) {
    						echo "<label>you already RSVP with this meeting.</label>";
    					} else {
    						date_default_timezone_set('America/New_York');
    						$now = date("Y-m-d H:i:s");
    						$nowtime = date_create($now);
    						$startTimetime = date_create($startTime);
    						if ($nowtime > $startTimetime) {
    							echo "this meeting was finished, you can not RSVP now";
    						} else {
    							?>
    							<form action="handler.php" method="post">
    								<input type="hidden" name="uname" value="<?php echo $_SESSION['uname'];?>">
    								<input type="hidden" name="meetingID" value="<?php echo $_GET['meetingID'];?>">
    								<input class="btn btn-primary" type="submit" name="RSVP" value="RSVP now!">
    							</form>
    							<?php
    						}
    					};


    					?>


    					<hr> read and add reports if user have access<br>
    					<?php 

    					
	//if user RSVP with this meeting
    					if ($RSVPed) {
		//display reports text and pics
    						$sql = "SELECT * from cookzilla.report where meetingID = '$meetingID'";
    						$results = mysqli_query($dbconnect, $sql);
		//if there is some report about this meeting
    						if (mysqli_num_rows($results) > 0) {
    							
    							while($row = mysqli_fetch_assoc($results)) {
		    	//display report
    								echo "<hr>";
    								$uname = $row['uname'];
    								$reportTime = $row['reportTime'];
    								$reportText = $row['reportText'];
    								$herf = "index.php?page=profile&uname=$uname";
    								echo "$uname at $reportTime : $reportText <br>";
		        // after report text, display all pics with this report
    								$pic_sql = "SELECT * from reportpic natural join picture where uname = '$uname' and meetingID = '$meetingID' and reportTime = '$reportTime' ";
    								$pic_results = mysqli_query($dbconnect, $pic_sql);
		        //if there is pic with this report, display it
    								if (mysqli_num_rows($pic_results) > 0) {
    									while($pic_row = mysqli_fetch_assoc($pic_results)) {
    										echo '<div class ="col-sm-12"><img class="img-rounded"  src="data:image/jpeg;base64,'.base64_encode( $pic_row['picFile'] ).'"/></div>';
    									}
    								}
    							}
    						} else {
    							echo "0 results";
    						}

		//add report with pic
    						$uname = $_SESSION['uname'];
    						date_default_timezone_set('America/New_York');
    						$reportTime = date("Y-m-d H:i:s");
    						$meetingID = $_GET['meetingID'];
    						?>
    						<form action="handler.php" method="post" enctype="multipart/form-data">
    							<input type="hidden" name="uname" value = "<?php echo $uname;?>">
    							<input type="hidden" name="meetingID" value = "<?php echo $meetingID;?>">
    							<input type="hidden" name="reportTime" value = "<?php echo $reportTime;?>">
    							<h3><label>Report about the meeting</label></h3>
    							<textarea class="form-control" rows="5" name="reportText"></textarea>

    							<div id="images">
    								
    							</div>
    							<input type="button" value="Add a picture" onClick="addInput('images');">
    							<input type="submit" class="btn btn-default" name="report" value="report">
    						</form>

    						

    						<script type="text/javascript">
    						var counter = 0;
    						var limit = 5;

    						function addInput(divName){
    							if (counter == limit)  {
    								alert("You have reached the limit of adding " + counter + " inputs");
    							}
    							else {
    								var newdiv = document.createElement('div');
    								newdiv.innerHTML = "picture " + (counter + 1) + " <br><input type='file' name='picFile[]' multiple='multiple'>";
    								document.getElementById(divName).appendChild(newdiv);
    								counter++;
    							}
    						}
    						</script>
    						<?php

    					} else {
    						echo "you don't have access to this meeting";
    					}
    					?>
    				</div>
    			</body>
    			</html>









