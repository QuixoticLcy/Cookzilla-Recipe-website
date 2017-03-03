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
            <br>
    		<div class="row row-offcanvas row-offcanvas-right col-sm-12">
    			<label ><h3>Members:</h3></label>
    			<table class="table form-group ">
    				<thead>
    					<tr>
    						<th><h4></h4></th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php
    					$gname = urldecode($_GET['gname']);

    					$stmt = $dbconnect->prepare('SELECT uname from cookzilla.cookgroup where gname = ?');
    					$paras = $gname;
    					$stmt->bind_param('s', $paras );
    					$stmt->execute();
    					$results = $stmt->get_result();



    					if (mysqli_num_rows($results) > 0) {
    						while($row = mysqli_fetch_assoc($results)) {
    							$uname = htmlspecialchars($row['uname']);
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
                <?php 
                    if(isset($_SESSION['uname'])) {
                        $stmt = $dbconnect->prepare('SELECT * FROM cookgroup WHERE gname=? AND uname=?');
                        $gname = $_GET['gname'];
                        $uname = $_SESSION['uname'];
                        $stmt->bind_param('ss', $gname,$uname);
                        $stmt->execute();
                        $results = $stmt->get_result();

                        if(mysqli_num_rows($results)>0) {
                            echo "you are already in this group";
                        } else {
                            ?> 

                            <form action="handler.php" method="post" class="form-horizontal">   
                                <input type="hidden" name="gname"  value="<?php echo $_GET['gname'] ?>" ></input>
                                <input type="submit" class="btn btn-default" name="joingroup" value="join group" ></input>
                            </form>

                            <?php
                        }
                    } else {
                        echo "<h2>Sign in to join this group!</h2>";
                    }
                ?>
    		</div>

    		<!--     			<hr>this is your historical events: -->
    		<div class="row row-offcanvas row-offcanvas-right col-sm-12">
    			<label ><h3>Historical Events:</h3></label>
    			<table class="table form-group ">
    				<thead>
    					<tr>
    						<th><h4></h4></th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php
    					$gname = urldecode($_GET['gname']);

    					$stmt = $dbconnect->prepare('SELECT * from cookzilla.meeting where startTime <= now() and gname = ?;');
    					$stmt->bind_param('s', $gname);
    					$stmt->execute();
    					$results = $stmt->get_result();

    					if (mysqli_num_rows($results) > 0) {
    						while($row = mysqli_fetch_assoc($results)) {
    							$meetingTitle = htmlspecialchars($row['meetingTitle']);
    							$meetingID = htmlspecialchars($row['meetingID']);
    							$herf = "index.php?page=meeting&meetingID=$meetingID";
    							echo "<tr>";
    							echo "<td>";
    							echo "<a href=$herf>$meetingTitle</a> ";
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
    		</div>

    		<!--     			<hr>this is your coming events: -->
    		<div class="row row-offcanvas row-offcanvas-right col-sm-12">
    			<label ><h3>Upcoming Events:</h3></label>
    			<table class="table form-group ">
    				<thead>
    					<tr>
    						<th><h4></h4></th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php
    					$gname = urldecode($_GET['gname']);

    					$stmt = $dbconnect->prepare('SELECT * from cookzilla.meeting where startTime > now() and gname = ?;');
    					$stmt->bind_param('s', $gname);
    					$stmt->execute();
    					$results = $stmt->get_result();

    					if (mysqli_num_rows($results) > 0) {
    						while($row = mysqli_fetch_assoc($results)) {
    							$meetingTitle = htmlspecialchars($row['meetingTitle']);
    							$meetingID = htmlspecialchars($row['meetingID']);
    							$herf = "index.php?page=meeting&meetingID=$meetingID";
    							echo "<tr>";
    							echo "<td>";
    							echo "<a href=$herf>$meetingTitle</a> ";
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
    		</div>

<!--     		<hr> add new meeting -->
<?php 
    if (isset($_SESSION['uname'])){
        $gname = urlencode($_GET['gname']);
        
    echo "<a class='btn btn-primary' href='index.php?page=newmeeting&gname=$gname'>add new meeting</a>";
    }

?>
    		
    	</div>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    	<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    	<script src="js/bootstrap.min.js"></script>
    	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    	<script src="js/ie10-viewport-bug-workaround.js"></script>
    	<script src="js/offcanvas.js"></script>
    </body>
    

    </html>