<?php
session_start();
include "./includes/config.php";
?>

<style>
.sidebar{width:20%; float:left;}
.content{width:78%; margin-top:-8px; padding:1%; float:right;background-color:rgb(250, 240, 230);}
</style>

<html>
<head>
<Title>CrsMgr - The Course Manager System</title>
</head>
<body>
<div class=header>
<?php
include "templates/header.php";
?>
</div>
<hr>
<div class=sidebar>
<?php
include "templates/sidebar.php";
?>
</div>
<div class=content>
<?php
include "templates/announcements.php";
?>
</div>

<?php

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
