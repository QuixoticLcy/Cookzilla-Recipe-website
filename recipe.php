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
      <body>
       <?php 
	//log this visit
       include("log.php");
       loguser("recipe");
       ?>

       <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

         <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
           <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
         </p>
         <div class="jumbotron">


           <?php
           $recipeID = $_GET['recipeID'];
           $sql = "SELECT cookzilla.recipe.title, cookzilla.recipe.uname,cookzilla.recipe.servings from recipe where recipeID = '$recipeID'";
           $results = mysqli_query($dbconnect, $sql);
           if (mysqli_num_rows($results) > 0) {
            while($row = mysqli_fetch_assoc($results)) {
             echo "<h1>".$row["title"]."</h1>";
             echo "<p>".$row["uname"]."</p>";
             echo "<p> Servings:".$row["servings"]."</p>";;
           }
         } else {

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

           $sql = "SELECT ingredientdetail.ingredient, ingredientdetail.quantity FROM recipe natural join ingredientdetail  WHERE recipe.recipeID = '$recipeID' ";
           $results = mysqli_query($dbconnect, $sql);
           if (mysqli_num_rows($results) > 0) {
            while($row = mysqli_fetch_assoc($results)) {

             echo "<tr>";
             echo "<td>".$row["ingredient"]."</td>";
             echo "<td>".$row["quantity"]."</td>";
             echo "</tr>";
           }
         } else {
          echo "<tr>";
          echo "<td>";
          echo "<h1>404 Error</h1>";
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>

  </div>

</div><!--/.col-xs-6.col-lg-4-->

<div class="col-xs-12 col-lg-12">
  <h2>Description</h2>
  <?php 

  $sql = "SELECT cookzilla.recipe.description FROM cookzilla.recipe WHERE cookzilla.recipe.recipeID = '$recipeID' ";
  $result = mysqli_query($dbconnect, $sql);
  if (mysqli_num_rows($results) > 0) {
   while($row = $result->fetch_assoc()) {
    echo "<h4>".$row["description"]."</h4>";
  }
} else {
 echo "<h1>404 Error</h1>";
}
?>
</div><!--/.col-xs-6.col-lg-4-->
<div class="col-xs-12 col-lg-12">
 <div class="col-xs-12 col-lg-12"><h2>Tags</h23></div>
 <?php 
 $sql = "SELECT distinct tag from tag where recipeID = '$recipeID'";
 $results = mysqli_query($dbconnect, $sql);
 if (mysqli_num_rows($results) > 0) {
  while($row = mysqli_fetch_assoc($results)) {
   $tag = $row['tag'];
   $herf = "index.php?page=search&searchtype=search_tag&keyword=$tag";
   echo "<a  class='btn btn-default' href=$herf>$tag</a> ";
 }
} else {
  echo "0 results";
}
?>
<div class="col-xs-12 col-lg-12">

<h2>Pictures</h2>
  <?php
  // display pics f this recipe
  $stmt = $dbconnect->prepare('SELECT * FROM cookzilla.recipepic natural join picture where recipeID = ?;');

  $stmt->bind_param('s', $recipeID);
  $stmt->execute();
  $results = $stmt->get_result();
  while($row = mysqli_fetch_assoc($results)) {
    echo '<div class ="col-sm-12"><img class="img-rounded"  src="data:image/jpeg;base64,'.base64_encode( $row['picFile'] ).'"/></div>';
  }

  // if you are owner, add picture to this recipe
  if (isset($_SESSION['uname']))  {

    $recipeID = $_GET['recipeID'];
    $uname = $_SESSION['uname'];
    $stmt = $dbconnect->prepare('SELECT * from recipe where uname = ? and recipeID = ?');

    $stmt->bind_param('ss', $uname,$recipeID);
    $stmt->execute();
    $results = $stmt->get_result();
    if(mysqli_num_rows($results)>0) {
      ?>
      <form action="handler.php" method="post" enctype="multipart/form-data">

        <input type="hidden" name="recipeID" value = "<?php echo $recipeID;?>">
        <div id="images">

        </div>
        <input type="button" value="Add a picture for my recipe" onClick="addInput('images');">
        <input type="submit" class="btn btn-default" name="addrecipepic" value="submit">
      </form>
      <?php  
    }

  }




  // display reviews 
  $recipeID = $_GET['recipeID'];
  $sql = "SELECT * from review where recipeID = '$recipeID'";
  $results = mysqli_query($dbconnect, $sql);
  //if there is some review about this recipe
  if (mysqli_num_rows($results) > 0) {
    while($row = mysqli_fetch_assoc($results)) {
  //display report
      echo "<hr>";
      $uname = $row['uname'];
      $reviewTime = $row['reviewTime'];
      $rate = $row['rate'];
      $title = $row['title'];
      $reviewText = $row['reviewText'];
      $suggestion = $row['suggestion'];

      echo "$uname at $reviewTime --  $title:$reviewText, rate:$rate, suggestion: $suggestion<br>";
  // after report text, display all pics with this report
      $pic_sql = "SELECT * from reviewpic natural join picture where uname = '$uname' and recipeID = '$recipeID' and reviewTime = '$reviewTime' ";
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


  // add reviews
  $uname = $_SESSION['uname'];
  date_default_timezone_set('America/New_York');
  $reportTime = date("Y-m-d H:i:s");
  $recipeID = $_GET['recipeID'];
  ?>
  <form action="handler.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="uname" value = "<?php echo $uname;?>"> 
    <input type="hidden" name="recipeID" value = "<?php echo $recipeID;?>">
    <input type="hidden" name="reportTime" value = "<?php echo $reportTime;?>">

    <h3><label>rate this recipe</label></h3>
    <input style ="visibility:hidden" type="text"  class="form-control" name="rate"></input>
    <h2 style= "display: inline" id = "rate"> <span id= "1">&#10032</span><span id = "2">&#10032</span><span id= "3">&#10032</span ><span id ="4">&#10032</span><span id ="5">&#10032</span></p>

    <h3><label>title of your review</label></h3>
    <input type="text" class="form-control" name="title"></input>

    <h3><label>say something about the recipe</label></h3>
    <textarea class="form-control" rows="5" name="reviewText"></textarea>

    <h3><label>give some suggestion</label></h3>
    <textarea class="form-control" rows="5" name="suggestion"></textarea>
    <div id="images_review">
      
    </div>

    <input type="button" value="Add a picture for review" onClick="addInput('images_review');">
    
    <input type="submit" class="btn btn-default" name="review" value="review">
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




</div><!--/.col-xs-6.col-lg-4-->
</div>
</div><!--/row-->
</div><!--/.col-xs-12.col-sm-9-->



<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
  <div class="list-group">
   <a class="list-group-item active">Related</a>
   <?php 

   $sql = "select * from (SELECT 
    b.recipeID
    FROM
    tag a,
    tag b
    WHERE
    a.recipeID = $recipeID AND b.recipeID != $recipeID
    AND a.tag = b.tag
    GROUP BY b.recipeID
    ORDER BY COUNT(DISTINCT b.tag) DESC
    LIMIT 6) as id natural join recipe;";
  $results = mysqli_query($dbconnect, $sql);
  if (mysqli_num_rows($results) > 0) {
  	while($row = mysqli_fetch_assoc($results)) {
  		$relatedRecipeID = $row['recipeID'];
  		$relatedTitle = $row['title'];
  		$herf = "index.php?page=recipe&recipeID=$relatedRecipeID";
  		echo "<a href=$herf class='list-group-item'>$relatedTitle</a>  ";
  	}
  } else {
  	echo "0 results";
  }


  ?>


</div>
</div><!--/.sidebar-offcanvas-->
</div><!--/row-->
</div>
<script>
$(document).ready(function(){
  var mod = false;
  $("#1").on({
    mouseenter: function(){
      if(!mod){
        $(this).html("&#11088");
      }
    },  
    mouseleave: function(){
      if(!mod){
        $(this).html("&#10032");
      }
    }, 
    click: function(){
      $(this).html("&#11088");
      mod = true;
      $("input[name='rate']").each(function() {
        var temp = 1;
        $(this).val (temp);


      });
    }  
    
  });

  $("#2").on({
    mouseenter: function(){
      if(!mod){
        $(this).html("&#11088");
        $("#1").html("&#11088");
      }
    },  
    mouseleave: function(){
      if(!mod){
        $(this).html("&#10032");
        $("#1").html("&#10032");
      }
    }, 
    click: function(){
      $(this).html("&#11088");
      $("#1").html("&#11088");
      mod = true;
      $("input[name='rate']").each(function() {
        var temp = 2;
        $(this).val (temp);


      });
    }  
  });

  $("#3").on({
    mouseenter: function(){
      if(!mod){
        $(this).html("&#11088");
        $("#1").html("&#11088");
        $("#2").html("&#11088");
      }
    },  
    mouseleave: function(){
      if(!mod){
        $(this).html("&#10032");
        $("#1").html("&#10032");
        $("#2").html("&#10032");   
      }
    }, 
    click: function(){
      $(this).html("&#11088");
      $("#1").html("&#11088");
      $("#2").html("&#11088");
      mod = true;
      $("input[name='rate']").each(function() {
        var temp = 3;
        $(this).val (temp);


      });
    }      
    
  });
  $("#4").on({
    mouseenter: function(){
      if(!mod){
        $(this).html("&#11088");
        $("#1").html("&#11088");
        $("#2").html("&#11088");
        $("#3").html("&#11088");
      }
    },  
    mouseleave: function(){
      if(!mod){
        $(this).html("&#10032");
        $("#1").html("&#10032");
        $("#2").html("&#10032");         
        $("#3").html("&#10032");       
      }
    }, 
    click: function(){
      $(this).html("&#11088");
      $("#1").html("&#11088");
      $("#2").html("&#11088");
      $("#3").html("&#11088");
      mod = true;
      $("input[name='rate']").each(function() {
        var temp = 4;
        $(this).val (temp);


      });
    }      
    
  }); 
  $("#5").on({
    mouseenter: function(){
      if(!mod){
        $(this).html("&#11088");
        $("#1").html("&#11088");
        $("#2").html("&#11088");
        $("#3").html("&#11088");
        $("#4").html("&#11088");
      }

    },  
    mouseleave: function(){
      if(!mod){
        $(this).html("&#10032");
        $("#1").html("&#10032");
        $("#2").html("&#10032");         
        $("#3").html("&#10032");
        $("#4").html("&#10032");
      }
    }, 
    click: function(){
      $(this).html("&#11088");
      $("#1").html("&#11088");
      $("#2").html("&#11088");
      $("#3").html("&#11088");
      $("#4").html("&#11088");
      mod =true;
      $("input[name='rate']").each(function() {
        var temp = 5;
        $(this).val (temp);

      });
    }      
    
  });     



});
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
  <script src="js/bootstrap.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="js/ie10-viewport-bug-workaround.js"></script>
  <script src="js/offcanvas.js"></script>
</body>
</html>
