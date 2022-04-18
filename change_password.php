<?php
session_start();
include "./includes/config.php";
?>

<html>
<head>
<title>Reset Password Interface</title>
</head>
<body bgcolor=#faf0e6>
<br><br>
<center><img src="pics/crsmgr.jpg" border=0>

<br>
<center><br>
<font size=5><center><b>Reset Your Password for CGA -- The CrsMgr Group-work Assistant</b></font><hr>

<?php
// Print error message from db and unset error
if (isset($_SESSION['error'])){
  echo "<font color='red'>".$_SESSION['error']."</font>";
  unset($_SESSION['error']);
}
?>

<form method='post' action='includes/do_change_password.php'>
<table border=0 align=center>
<tr><td><b>Enter Your Username<font color=red>*</font>:</b></td><td><input type='text' maxlength=20 size=35 name='username' required></td></tr>
<tr><td><b>Enter Your Current Password<font color=red>*</font>:</b></td><td><input type='password' maxlength=30 size=35 name='current_password' required></td></tr>
<tr><td><b>Enter Your New Password<font color=red>*</font>:</b></td><td><input type='password' maxlength=30 size=35 name='new_password' required></td></tr>
<tr><td><b>Re-enter Your New Password<font color=red>*</font>:</b></td><td><input type='password' maxlength=30 size=35 name='new_password2' required></td></tr>
<tr><td colspan=2 align =center><button type='submit' name='submit'>Submit</button>&nbsp;&nbsp;<input type='reset' value='Clear'></td></tr>
</table>
</form>

<br>

<table border=0 align=center>
<tr><td><a href = "includes/logout.php">Back To Login Page</a></td></tr>
<tr><td><br></td></tr>
<tr><td><font color=red>* <i>Required</i></td></tr>
</table>

</body>
</html>