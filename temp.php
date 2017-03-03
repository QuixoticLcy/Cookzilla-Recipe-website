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

                  <input type="button" value="Add a picture for review" onClick="addInput2('images_review');">
                  
                  <input type="submit" class="btn btn-default" name="review" value="review">
                </form>

                

                <script type="text/javascript">
                var counter = 0;
                var limit = 5;

                function addInput2(divName){
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