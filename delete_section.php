<?php
//40197292
/* Database credentials. */
define('DB_SERVER', 'rtc5531.encs.concordia.ca');
define('DB_USERNAME', 'rtc55314');
define('DB_PASSWORD', 'khbbmG');
define('DB_NAME', 'rtc55314');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link == false) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(!isset($_GET['id'])){
        // redirect to show page
        die('id not provided');
    }
$id = (int)$_GET['id'];
 

   $sql = "DELETE FROM sections WHERE section_id = '$id'";
    if ($link->query($sql) === TRUE) {
				 
				 echo "Section deleted successfully!!";
                  } else {
                     echo "Error deleting record: " . $link->error;
                }
    // Close connection
    mysqli_close($link);

?>