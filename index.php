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

  <title>cookzilla</title>



  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="js/ie-emulation-modes-warning.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- Custom styles for this template -->
      <link href="css/carousel.css" rel="stylesheet">
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  .carousel img {
  position: absolute;
  top: 0;
  left: 0;
  max-width: 100%;
  height: 500px;
  max-width: none;
}
  </style>

    </head>
<!-- NAVBAR
  ================================================== -->
  <body>
<?php 
              include("dbconnect.php");
              session_start();
              date_default_timezone_set('America/New_York');
?>

    <div class="navbar-wrapper ">
      <div class="container">

        <nav class="navbar navbar-inverse  navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php">Cookzilla</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>

                <li><a href="index.php?page=allgroups">All Groups</a></li>
<!--                 <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li> -->
              </ul>
              <form class="navbar-form navbar-left" action="index.php" method="get">
                <input type="hidden" name="page" value="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search" name="keyword">
                </div>
                <div class= "form-group">
                  <select class ="form-control col-log-1" name="searchtype">
                    <option selected value="search_title">Title</option>
                    <option value="search_description">Description</option>
                    <option value="search_tag">Tag</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-default" value = 'search'>
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </form>

              <?php





              if (isset($_SESSION['uname'])) {



                echo "<ul class='nav navbar-nav navbar-right'>
                <li><a><span></span> Welcome, ".$_SESSION['uname']." </a></li>
                <li><a href='index.php?page=profile&uname=".$_SESSION['uname']."'><span class='glyphicon glyphicon-user'></span> Profile</a></li>
                <li><a href='handler.php?signout'><span class='glyphicon glyphicon-log-out'></span> Sign out</a></li>
                </ul>";

                
              }else{

                echo "<ul class='nav navbar-nav navbar-right'>
                <li><a href='index.php?page=signup'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
                <li><a href='index.php?page=signin'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
                </ul>";

              }

              ?>

            </div>
          </div>
        </nav>

      </div>
    </div>

<?php 
              if(isset($_GET['page'])) {
                $page=$_GET['page'];
                include("$page.php");
              }else{
                include("frontpage.php");
              }
?>

   
<?php 
  // var_dump($_SESSION);

?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
  </html>
