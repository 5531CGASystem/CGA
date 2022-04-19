<?php
//40197292
/* Database credentials. */
include "includes/head.php";

// Check connection
if($link == false) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(!isset($_GET['section_id']) && !isset($_GET['user_id'] )){
    // redirect to show page
    die('id not provided');
}

$section_id= (int)$_GET['section_id'];
$user_id=(int)$_GET['user_id'];
echo '<div class="content">';
$sql = "DELETE FROM users_sections WHERE section_id = '$section_id' and user_id='$user_id'";
if ($link->query($sql) === TRUE) {
             
             echo "Section User deleted successfully!!";
              } else {
                 echo "Error deleting record: " . $link->error;
            }
// Close connection
mysqli_close($link);
echo '</div>';
?>