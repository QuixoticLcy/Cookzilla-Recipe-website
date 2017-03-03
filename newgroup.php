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
<div class ="container">
<div class="row row-offcanvas row-offcanvas-right">


        <form action="handler.php" method="post" class="form-horizontal">

          <div class="form-group">
            <label class="control-label">Group Name:</label>
              <input type="text" class="form-control" name="gname"></input>
          </div>

          
          <input type="hidden" name="uname"  value="<?php echo $_SESSION['uname'] ?>" ></input>
          <input type="submit" class="btn btn-default" name="newgroup" value="propose" ></input>
        </form>



</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    	<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    	<script src="js/bootstrap.min.js"></script>
    	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    	<script src="js/ie10-viewport-bug-workaround.js"></script>
    	<script src="js/offcanvas.js"></script>
</body>
</html>