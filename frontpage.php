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
.carousel img {
        max-width:50%;

        max-height: 100%;
}
  </style>

    </head>

    <body>
 <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" src="pic/1.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Love Cooking</h1>
              <p>Join us now!</p>
              <p><a class="btn btn-lg btn-primary" href='index.php?page=signup' role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="pic/2.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Love life</h1>
              <p>Best Cooking in the week</p>
              <p><a class="btn btn-lg btn-primary"  role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="pic/3.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Do it Now</h1>
              <p>Don't let it down</p>
              <p><a class="btn btn-lg btn-primary" href="http://localhost/project/index.php?page=search&keyword=&searchtype=search_title" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
      <div class="row">
        <?php 

          $stmt = $dbconnect->prepare('SELECT * FROM recipe left  join recipepic using(recipeID) left join picture using(picID) group by recipeID order by recipeID desc');
           
           
          $stmt->execute();
          $results = $stmt->get_result();

          if(mysqli_num_rows($results)>0) {
             


                  while($row = mysqli_fetch_assoc($results)) {
                    //get data
                    // echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['picFile'] ).'"/>';
                    $picsrc = "data:image/jpeg;base64,".base64_encode( $row['picFile'] );
                    $title = htmlspecialchars($row['title']);
                    $recipeID = htmlspecialchars($row['recipeID']);
                    $avgrate = 4.5;
                    
                    //get avg rate
                    $rate_stmt = $dbconnect->prepare('SELECT avg(rate) as avgrate FROM cookzilla.review where recipeID = ?;');
                    $rate_stmt->bind_param('s', $recipeID);
                    $rate_stmt->execute();
                    $rate_results = $rate_stmt->get_result();
                    $rate_row=mysqli_fetch_assoc($rate_results);
                    $avgrate = $rate_row['avgrate'];
                    if(is_null($avgrate)) {
                        $avgrate = 4.5;
                    }
                    $avgrate = number_format("$avgrate",1);

                    
                    
                    $herf = "index.php?page=recipe&recipeID=$recipeID";

                    //display each recipe
                    ?>
                      <div class="col-lg-4">
                        
                        <img class="img-circle" src=<?php echo $picsrc; ?> alt="Generic placeholder image" width="140" height="140">
                        <h2><?php echo $title; ?></h2>
                        <p>average rate: <?php echo $avgrate; ?></p>
                        <p><a class="btn btn-default" href=<?php echo $herf; ?> role="button">View details &raquo;</a></p> 
                        

                      </div><!-- /.col-lg-4 -->
                    <?php
                }
          } else {
            echo "no recipe"; 
          }
        
      ?>
      </div>
      



      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Try to cook by yourself <span class="text-muted">It'll blow your mind.</span></h2>
          <p class="lead">"This is a tasty recipe that my whole family enjoys. Very easy to make!"</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="pic/8.jpg" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">Share with your family</span></h2>
          <p class="lead">"This dish uses just one skillet to prepare. Quick, easy and delicious. Tomato paste and chicken broth combine to make a tasty sauce. Garnish with fresh parsley."</p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <img class="featurette-image img-responsive center-block" src="pic/9.jpg" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Enjoy.</span></h2>
          <p class="lead">"This truly is the World's Best Lasagna! I love this recipe but I am always looking for ways to take out the fat when I cook. I substituted lean ground turkey and turkey sausage for the meat. I also used lite mozzarella and cut out the egg and salt."</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="pic/10.jpg" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->
    
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