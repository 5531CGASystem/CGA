<?php
include "includes/head.php";
?>

<!-- Displays the coursemanager main content -->
<div class=content>

<button><a href="discussion_board.php">Back</a></button>
<p></p>

<h1>Add a File</h1>
<font color='red'>* Required field</font>

<form method=post action="includes/do_add_file_to_entity.php" enctype="multipart/form-data">


<p><small>Accepted formats: zip/pdf</small></p>
<p><strong>Upload:</strong><font color='red'> *</font>
<input type="file" name="fileToUpload" id="fileToUpload" required accept=".pdf,.zip,.PDF,.ZIP"></p>   

<button type="submit" name="submit">Upload File</button>
</form>

<?php
// Print error message from db and unset error
if (isset($_SESSION['error'])){
  echo "<font color='red'>".$_SESSION['error']."</font>";
  unset($_SESSION['error']);
}
?>

</div>

</body>
</html>