<?php
session_start();
include "./includes/config.php";
?>

<html>
<head>
<Title>CrsMgr - The Course Manager System</title>
</head>
<body>
Hell World!

<?php
include "templates/header.php";
if($_SESSION['role_id'] == 1){
	echo "You are admin.";
	
}
elseif($_SESSION['role_id'] == 2){
	echo "You are instructor.";
}
elseif($_SESSION['role_id'] == 3){
	echo "You are TA.";
}
elseif($_SESSION['role_id'] == 4){
	echo "You are student.";
}
?>
</body>
</html>
