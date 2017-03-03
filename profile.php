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

  <title>Profile</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
  <!-- Bootstrap core CSS -->

  <link href="css/offcanvas.css" rel="stylesheet">

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="js/ie-emulation-modes-warning.js"></script>

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
<body>
<?php 
        $uname = $_GET['uname'];
  // var_dump($uname);
        $profile_sql="SELECT profile FROM cookzilla.user where uname = '$uname'";
  // var_dump($profile_sql);
        $profile_query=mysqli_query($dbconnect, $profile_sql);
  // echo mysqli_error($dbconnect);
  // var_dump($profile_query);
        $profile_rs=mysqli_fetch_assoc($profile_query);
  // var_dump($profile_rs);

        $oldprofile = $profile_rs['profile'];
        // var_dump($oldprofile);

        ?>
    <div class="container">
        <div class="jumbotron">
            <h2><?php echo $_GET['uname']; ?>'s profile</h2>
        </div>

        
        <div class="row row-offcanvas row-offcanvas-right">
            <div class="form-group col-sm-12">

                <label><h3>personal profile:</h3></label>

                <form action="handler.php" method="post">
                 <textarea class="form-control" rows="5" name="profile"><?php 
echo $oldprofile;?></textarea>
            <?php 
               if (($_SESSION['uname']) === $_GET['uname']){

                echo "<button type='submit' name='updateProfile' class='btn btn-default' value='update' >Update</button>";
               }
            ?>
             
         </form>
     </div>
 </div>

 <div class="row row-offcanvas row-offcanvas-right col-sm-12">
    <label ><h3>Your recipes:</h3></label>
    <table class="table form-group ">
        <thead>
            <tr>
                
<!--                 <th><h4><button class ='btn btn-danger'>Delete</button></h4></th> -->
                    <th ><h4 align='right'>Operation</h4></th>
            </tr>
        </thead>
        <tbody>

            <?php
            $title_sql = "SELECT * FROM cookzilla.recipe where uname = '$uname';";
            $title_query = mysqli_query($dbconnect, $title_sql);

            if (mysqli_num_rows($title_query) > 0) {
                while($row = mysqli_fetch_assoc($title_query)) {
                 $title = $row['title'];
                 $recipeID = $row['recipeID'];
                 $herf = "index.php?page=recipe&recipeID=$recipeID";
                 echo "<tr>";
                 echo "<td>";
                 echo "<a href=$herf>$title</a> ";
                 echo "</td>";
                
                 echo "<td align='right'>";
                 echo "<a href = 'handler.php?delete=$recipeID'><button class ='btn btn-danger'>Delete</button></a>";
                 echo "</td>";
                 echo "</tr>";
             }
         } else {
            echo "<tr>";
            echo "<td>";
            echo "0 results";
            echo "</td>";
            echo "<td></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
</div>
<a href="index.php?page=newrecipe">
  <button class="btn btn-primary">add new recipe</button>
</a>


<div class="row row-offcanvas row-offcanvas-right col-sm-12">
    <label ><h3>Your groups:</h3></label>
    <table class="table form-group ">
        <thead>
            <tr>
                <th><h4></h4></th>
            </tr>
        </thead>
        <tbody>

            <?php
            $group_sql = "SELECT gname from cookzilla.cookgroup natural join cookzilla.user where uname = '$uname';";
            $group_query = mysqli_query($dbconnect, $group_sql);

            if (mysqli_num_rows($group_query) > 0) {
                while($row = mysqli_fetch_assoc($group_query)) {
                   $gname = $row['gname'];
                   $urlgname = urlencode($row['gname']);

                   $herf = "index.php?page=group&gname=$urlgname";
                   echo "<tr>";
                   echo "<td>";
                   echo "<a href=$herf>$gname</a> ";
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

<div class="row row-offcanvas row-offcanvas-right col-sm-12">
    <label ><h3>Your meetings:</h3></label>
    <table class="table form-group ">
        <thead>
            <tr>
                <th><h4></h4></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $meetingRsvp_sql = "SELECT meetingID, meetingTitle from cookzilla.meetingrsvp natural join cookzilla.user natural join cookzilla.meeting where uname = '$uname';";
            $meetingRsvp_query = mysqli_query($dbconnect, $meetingRsvp_sql);

            if (mysqli_num_rows($meetingRsvp_query) > 0) {
                while($row = mysqli_fetch_assoc($meetingRsvp_query)) {
                   $meetingID = $row['meetingID'];
                   $meetingTitle = $row['meetingTitle'];
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


<div class="row row-offcanvas row-offcanvas-right col-sm-12">
    <label ><h3>Recent view history:</h3></label>
    <table class="table form-group ">
        <thead>
            <tr>
                <th><h4></h4></th>
            </tr>
        </thead>
        <tbody>

<?php 
  // recent search 
  $stmt = $dbconnect->prepare('SELECT * FROM log WHERE uname=? order by time desc limit 20');
  $stmt->bind_param('s', $_SESSION['uname']);
  $stmt->execute();
  $results = $stmt->get_result();

  if (mysqli_num_rows($results) > 0) {
    while($row = mysqli_fetch_assoc($results)) {
     $logtype = $row['logtype'];
     $value = $row['value'];
     if ($logtype=="recipe") {
      $herf = "index.php?page=recipe&recipeID=$value";
     } else if ($logtype == "search_tag") {
      $herf = "index.php?page=search&keyword=$value&searchtype=search_tag";
     } else if ($logtype  == "search_title") {
      $herf = "index.php?page=search&keyword=$value&searchtype=search_title";
     } else if ($logtype == "search_description") {
      $herf = "index.php?page=search&keyword=$value&searchtype=search_description";
     }
     echo "<tr>";
     echo "<td>";
     echo "<a href=$herf>$value</a> ";
     echo "</td>";
     echo "</tr>";
    }
  } else {
      echo "<tr>";
      echo "<td>";
      echo "0 recent view results";
      echo "</td>";
      echo "</tr>";
  }

?>

</div>




</div>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="js/holder.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>

<script src="js/offcanvas.js"></script>
</body>
</html>