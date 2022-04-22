<?php
/* Database credentials. */
define('DB_SERVER', 'rtc5531.encs.concordia.ca');
define('DB_USERNAME', 'rtc55314');
define('DB_PASSWORD', 'khbbmG');
define('DB_NAME', 'rtc55314');

try{
	/* Attempt to connect to MySQL database */
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
}
catch (Exception $e){
	echo "Oops: " . $e->getMessage() . ". Please try again later.";
	exit;
}
?>
