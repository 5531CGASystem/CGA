<?php
//40197292
/* Database credentials. */
include "includes/head.php";

// Check connection
if($link == false) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(!isset($_GET['section_id']) && !isset($_GET['ta_id'] )){
    // redirect to show page
    die('id not provided');
}

$section_id= (int)$_GET['section_id'];
$ta_id=(int)$_GET['ta_id'];

$sql = "DELETE FROM ta_sections WHERE section_id = '$section_id' and ta_id='$ta_id'";
if ($link->query($sql) === TRUE) {
             
             echo "Section TA deleted successfully!!";
              } else {
                 echo "Error deleting record: " . $link->error;
            }
// Close connection
mysqli_close($link);

?>