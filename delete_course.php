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
 
     $link->query('SET foreign_key_checks = 0');
     $sql = "DELETE FROM courses WHERE course_id = '$id'";
     
    if ($link->query($sql) === TRUE) {
        $link->query('SET foreign_key_checks = 1');
				 echo "Course deleted successfully!!";
                  } else {
                     echo "Error deleting record: " . $link->error;
                }
    // Close connection
    mysqli_close($link);

?>