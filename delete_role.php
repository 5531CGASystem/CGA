<?php
//40197292
/* Database credentials. */
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
 $u_id = (int)$_GET['u_id'];
   $sql = "DELETE FROM user_roles WHERE user_id = '$u_id' and role_id = '$id'";
    if ($link->query($sql) === TRUE) {
				 
				 echo "User Role deleted successfully!!";
                  } else {
                     echo "Error deleting record: " . $link->error;
                }
    // Close connection
    mysqli_close($link);

?>