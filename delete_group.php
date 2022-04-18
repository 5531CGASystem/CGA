<?php
//40197292
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
 

   $sql = "DELETE FROM rtc55314.groups WHERE group_id = '$id'";
   $sql11 = "DELETE FROM rtc55314.group_users WHERE group_id = '$id'";
    if ($link->query($sql) === TRUE && $link->query($sql11) === TRUE) {
				 
				 echo "Group deleted successfully!!";
                  } else {
                     echo "Error deleting record: " . $link->error;
                }
    // Close connection
    mysqli_close($link);

?>