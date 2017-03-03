<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Recipe</title>

  <!-- Bootstrap core CSS -->
  <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="offcanvas.css" rel="stylesheet">

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

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
      <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
          </div>
          <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!-- /.nav-collapse -->
        </div><!-- /.container -->
      </nav><!-- /.navbar -->

      <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

          <div class="col-xs-12 col-sm-9">
            <p class="pull-right visible-xs">
              <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
            </p>
            <div class="jumbotron">
              <?php
              $servername = "localhost:3306";
              $username = "root";
              $password = "a550125abc";

              $conn = new mysqli($servername,$username,$password);

              if($conn -> connect_error){
                die("Connection failed: " . $conn->connect_error);
              }
              $userInput = "2";

              $sql = "SELECT cookzilla.recipe.title, cookzilla.recipe.uname FROM cookzilla.recipe  WHERE cookzilla.recipe.recipeID = '$userInput' ";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  echo "<h1>".$row["title"]."</h1>";
                  echo "<p>".$row["uname"]."</h1>";

                }
              } else {
                echo "<h1>404 Error</h1>";
              }

              ?>

            </div>

            <div class="row">
              <div class="col-xs-12  col-sm-2"></div>
              <div class="col-xs-12  col-sm-8">
                <h2>Prepare</h2>
                <div class = "col-lg-12">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Ingredients</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $userInput = "2";

                      $sql = "SELECT cookzilla.ingredientdetail.ingredient, cookzilla.ingredientdetail.quantity FROM cookzilla.recipe natural join cookzilla.ingredientdetail  WHERE cookzilla.recipe.recipeID = '$userInput' ";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>".$row["ingredient"]."</td>";
                          echo "<td>".$row["quantity"]."</td>";
                        }
                      } else {
                        echo "<h1>404 Error</h1>";
                      }
                      ?>
                    </tbody>
                  </table>

                </div>
                
              </div><!--/.col-xs-6.col-lg-4-->

              <div class="col-xs-12 col-lg-12">
                <h2>Description</h2>
                <?php 
                      $userInput = "2";

                      $sql = "SELECT cookzilla.recipe.description FROM cookzilla.recipe WHERE cookzilla.recipe.recipeID = '$userInput' ";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                          echo "<h4>".$row["description"]."</h4>";
                        }
                      } else {
                        echo "<h1>404 Error</h1>";
                      }
                ?>
              </div><!--/.col-xs-6.col-lg-4-->

            </div><!--/row-->
          </div><!--/.col-xs-12.col-sm-9-->

          <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
              <a class="list-group-item active">Related</a>
              <a href="#" class="list-group-item">Link</a>
              <a href="#" class="list-group-item">Link</a>
              <a href="#" class="list-group-item">Link</a>
              <a href="#" class="list-group-item">Link</a>
              <a href="#" class="list-group-item">Link</a>
              <a href="#" class="list-group-item">Link</a>
              <a href="#" class="list-group-item">Link</a>
              <a href="#" class="list-group-item">Link</a>
              <a href="#" class="list-group-item">Link</a>
            </div>
          </div><!--/.sidebar-offcanvas-->
        </div><!--/row-->

        <hr>

        <footer>
          <p>&copy; 2016 Company, Inc.</p>
        </footer>

      </div><!--/.container-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="offcanvas.js"></script>
  </body>
  </html>
