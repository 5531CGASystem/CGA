<?php
include "includes/head.php";

// Check connection
if($link == false) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(!isset($_GET['id'])){
        // redirect to show page
        die('id not provided');
    }
$id = (int)$_GET['id'];
 
echo '<div class="content">';
   $sql = "DELETE FROM sections WHERE section_id = '$id'";
    if ($link->query($sql) === TRUE) {
				 
				 echo "Section deleted successfully!!";
                  } else {
                     echo "Error deleting record: " . $link->error;
                }
    // Close connection
    mysqli_close($link);
    echo '</div>';
?>