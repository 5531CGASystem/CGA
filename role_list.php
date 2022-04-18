<?php
session_start();
include "./includes/config.php";

// Check if the user is not logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true){
    header("location: login_page.php");
    exit;
}
?>

<html>
<head>
<style>
input {border:none;background-color:rgba(0,0,0,0);color:blue;text-decoration:underline;}
</style>
<Title>CGA - The CrsMgr Group-work Assistant</title>
</head>

<body bgcolor=#faf0e6>
<br><br><br>
<center><img src="pics/crsmgr.jpg" border=0>
<br><br>
<h2><center>Your Access Roles in CGA -- The CrsMgr Group-work Assistant</h2>
<hr>
	<center><h3>Choose one of the roles to proceed</h3>
	<font size=4>
	<div class='role'>
	<style type="text/css">
	.role{margin-top: -70px;}
	</style>
	<table border=1>
	<?php

	// Unset admin sidebar and header
	if (isset($_SESSION['admin_pages'])) {
		unset($_SESSION['admin_pages']);
	}

	$data = $link->query("SELECT r.role_id, r.role_name FROM roles r JOIN users_roles_sections urs ON r.role_id = urs.role_id WHERE urs.user_id = " . $_SESSION['id']);
	$roles_selected = array();
	if($data -> num_rows>0){
		// Display the role options that are available for the logged in user
		while($row = mysqli_fetch_array($data,MYSQLI_NUM))
		{
			$role_id = $row[0];
			$role_name = $row[1];
			if(!in_array($role_id, $roles_selected)){
				echo "<tr><td align='center'><form name=role_select method=post action=includes/role_select.php><input type=Submit value='" . ucwords($role_name) . "'>
				<input name=role_id type=hidden value='" . $role_id . "'></form></td></tr>";
				echo "<br>";
				array_push($roles_selected, $role_id);
			}
		}
	}
	?>
	</table>
	</div>
	<br>
	<hr>
	<br>
	<?php
	// Return the number of unread mail this user has
	$data = $link->query("SELECT COUNT(*) c FROM mail_receivers WHERE receiver_id=" . $_SESSION['id'] . " AND is_read=0");
	if($data -> num_rows>0){
		$mail_data = $data->fetch_assoc();
		$unread = $mail_data['c'];
	}?>
	<a href = "inbox.php">View Inbox (<?php echo $unread; ?>)</a><p></p>
	<a href=change_password.php>Change Password</a><p></p>
	<a href = "includes/logout.php">Log out</a></font>
</body>
</html>
