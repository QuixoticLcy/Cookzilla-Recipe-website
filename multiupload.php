<form action="handler.php" method="POST">
	<label>report about the meeting</label>
	 <textarea name="text"></textarea>
     <div id="dynamicInput">
          picture 1<br><input type="file" name="myInputs[]">
     </div>
     <input type="submit" name="report" value="report">
</form>

<input type="button" value="Add another picture" onClick="addInput('dynamicInput');">

<script type="text/javascript">
	var counter = 1;
	var limit = 5;
	function addInput(divName){
	     if (counter == limit)  {
	          alert("You have reached the limit of adding " + counter + " inputs");
	     }
	     else {
	          var newdiv = document.createElement('div');
	          newdiv.innerHTML = "picture " + (counter + 1) + " <br><input type='file' name='myInputs[]'>";
	          document.getElementById(divName).appendChild(newdiv);
	          counter++;
	     }
	}
</script>