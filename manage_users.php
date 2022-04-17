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
$result = mysqli_query($link,"SELECT * FROM users");

echo "<html>
<head>
<title>Users</title>
</head>

<body style='background-color:#faf0e6'>
</br>
<h1>Users:</h1>
</br>
<div  class='form-group'>
   <a href='create_user.php'>
    <button style='background-color:pink'>Create New User</button>
</a> 
</div>
</br></br>
</body>
</html>";

echo "<table border='1'>
<tr>
<th>Username</th>
<th>Email</th>
<th>First_Name</th>
<th>Last_Name</th>
<th></th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['username'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['fname'] . "</td>";
echo "<td>" . $row['lname'] . "</td>";
echo "<td><a href='edit_user.php?id=".$row['user_id']."'>Edit</a>/<a href='delete_user.php?id=".$row['user_id']."'>Delete</a>/<a href='manage_roles.php?id=".$row['user_id']."'>Roles</a></td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($link);
?>