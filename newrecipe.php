  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags[] *must* come first in the head; any other head content must come *after* these tags[] -->
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

        <div class="container">

          <div class="row row-offcanvas row-offcanvas-right">

            <div class="col-xs-12 col-sm-9">
              <p class="pull-right visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
              </p>

              <h2>Please create your recipe</h2>
            </div>

            <div class="row">

              <div class="col-xs-12  col-sm-12">
                <div class = "col-lg-12">
                  <form action ="handler.php" method = "post" class="form-horizontal" id = "myform">

                    <div class="form-group">
                      <label class="control-label col-sm-2">Title:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2" >Servings:</label>
                      <div class="col-sm-10">          
                        <input type="text" class="form-control" id="servings" name = "servings" placeholder="Enter servings">
                      </div>
                    </div>



                    <div class="form-group">
                      <table class ="col-sm-12" id ="ingredienttb">
                        <tr>
                          <th class = "col-sm-6"><h4 ><b>Ingredients:</b></h4></th>
                          <th class= "col-sm-3"><h4 ><b>Quantity:</b></h4></th>
                          <th class = "col-sm-3"><h4><b>Scale:</b></h4></th>  
                        </tr>
                        <tr>

                          <td class = "col-sm-6">
                            <div>
                              <input type="text" class="form-control" name = "ingredient[]" id="ingredients" ></input>
                            </div>
                          </td>
                          <td class ="col-sm-3">
                            <div>
                              <input type = "text" class ="form-control" name = "quantity[]"></input>

                            </div>

                          </td>
                          <td class=" col-sm-3">
                            <div >
                              <select class="form-control" name = "scale" id="scale">
                                <option value = "0" selected></option>
                                <option value = "1">ML</option>
                                <option value = "2">Teaspoon</option>
                                <option value = "3">Tablespoon</option>
                                <option value = "4">Cup</option>
                                <option value = "5">Gram</option>
                                <option value = "6">Ounce</option>
                                <option value = "7">Pound</option>
                              </select>
                            </div>
                          </td>
                        </tr>
                        <tr id='addr1'></tr>                        
                      </table>

                      <div class ="col-sm-12">
                        <a id="add_row" class="btn btn-default pull-left">Add Row</a>
                        <a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
                      </div>



                    </div>
                    <div class="form-group col-sm-12">
                      <label >Description:</label>
                      <textarea class="form-control" rows="5" name="description"></textarea>
                    </div>

                    <div class="form-group " >
                      <div class = "col-sm-1">
                        <label class="control-label col-sm-1 ">tags:</label>
                      </div>
                      <div class ="row form-group" >
                        <div class="checkbox-inline" >
                          <label ><input type="checkbox" name="tags[]" value="Chinese">Chinese</label>
                        </div>
                        <div class="checkbox-inline" class= "col-sm-4">
                          <label ><input type="checkbox" name="tags[]" value="Italian">Italian</label>
                        </div>
                        <div class="checkbox-inline" class= "col-sm-4">
                          <label><input type="checkbox"  name="tags[]" value="Japenese" >Japenese</label>
                        </div>
                        <div class="checkbox-inline">
                          <label ><input type="checkbox"  name="tags[]" value="Korea" >Korea</label>
                        </div>
                        <div class="checkbox-inline">
                          <label ><input type="checkbox"  name="tags[]" value="Mexican" >Mexican</label>
                        </div>
                        <div class="checkbox-inline">
                          <label ><input type="checkbox"  name="tags[]" value="Hot" >Hot</label>
                        </div>
                        <div class="checkbox-inline">
                          <label><input type="checkbox"  name="tags[]" value="Beef" >Beef</label>
                        </div>
                        <div class="checkbox-inline">
                          <label><input type="checkbox"  name="tags[]" value="Lamb" >Lamb</label>
                        </div>
                        <div class="checkbox-inline">
                          <label><input type="checkbox"  name="tags[]" value="Steak" >Steak</label>
                        </div>
                        <div class="checkbox-inline">
                          <label><input type="checkbox"  name="tags[]" value="Pork" >Pork</label>
                        </div>
                      </div>
                    </div>

                    <div hidden>
                      <input type = "text" name ="uname" value =""></input>
                    </div>

                    <div class="form-group">        
                      <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" name = "newrecipe" class="btn btn-default"></input>
                      </div>
                    </div>
                  </form>


                  <script type="text/javascript">
                  $(document).ready(function(){
                    var i=1;
                    var m =1;

                    $("#add_tag").click(function(){
                      $('#tag'+m).html("<input type='text' class='form-control' id='title' name='tags[]' placeholder='Enter tags[]'>");
                      $('#tags[]_form').append('<div id = "tag'+(m+1)+'"></div>');
                      m++;

                    });

                    $("#delete_tag").click(function(){
                      if(m>1){
                        $("#tag"+(m-1)).html('');
                      }
                    });

                    $("#add_row").click(function(){
                      $('#addr'+i).html("<td class='col-sm-6'><input name='ingredient[]' type='text' class='form-control input-md ' ></input> </td><td class ='col-sm-3'><input name='quantity[]' type='text' class='form-control input-md'></input></td><td class='col-sm-3'><select class='form-control ' name='scale' ><option value = '0' selected></option><option value = '1'>ML</option><option value = '2'>Teaspoon</option><option value = '3'>Tablespoon</option><option value = '4'>Cup</option><option value = '5'>Gram</option><option value = '6'>Ounce</option><option value = '7'>Pound</option></select></td>");
                      $('#ingredienttb').append('<tr  id="addr'+(i+1)+'" ></tr>');
                      i++; 
                    });

                    $("#delete_row").click(function(){
                     if(i>1){
                       $("#addr"+(i-1)).html('');
                       i--;
                     }
                   });

                    $('#myform').submit(function() {
                      var values = [];
                      var j = 0;
                      $("select[name='scale']").each(function() {
                        values.push($(this).val());
                      });
                      $("input[name='quantity[]']").each(function() {
                              /*var test = $(this).val();
                              var test2 = values[j];
                              alert(test2);*/
                              if(j< values.length){
                                var temp = $(this).val();
                                switch(values[j]){
                                  case "0":
                                  // alert($(this).val());
                                  j++;
                                  break;

                                  case "1":
                                  temp += "ml";
                                  $(this).val (temp);
                                  // alert($(this).val());
                                  j++;
                                  break;

                                  case "2":
                                  temp *= 5;
                                  temp +="ml";
                                  $(this).val (temp);
                                  // alert($(this).val());
                                  j++; 
                                  break;

                                  case "3":
                                  temp *= 25;
                                  temp +="ml";
                                  $(this).val (temp);
                                  // alert($(this).val());
                                  j++; 
                                  break;

                                  case "4":
                                  temp *= 240;
                                  temp += "ml";
                                  $(this).val (temp);
                                  // alert($(this).val());
                                  j++;
                                  break;

                                  case "5":
                                  temp += "g";
                                  $(this).val (temp);
                                  // alert($(this).val());
                                  j++;
                                  break;

                                  case "6":
                                  temp *= 28.3;
                                  temp+= "g";
                                  $(this).val (temp);
                                  // alert($(this).val());
                                  j++;
                                  break;

                                  case "7":                                
                                  temp *= 453.6;
                                  temp+= "g";
                                  $(this).val (temp);
                                  // alert($(this).val());
                                  j++;
                                  break;
                                }
                              }
                            });                          
                            return true; // return false to cancel form action
                          });
});
  </script>
</div>
</div>


</div><!--/.col-xs-6.col-lg-4-->



</div><!--/row-->
</div><!--/.col-xs-12.col-sm-9-->


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
      <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
      <script src="js/bootstrap.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="js/ie10-viewport-bug-workaround.js"></script>
      <script src="js/offcanvas.js"></script>
    </body>
    </html>
