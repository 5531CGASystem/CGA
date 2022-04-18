<?php
//40197292

include "includes/head.php";
$result = mysqli_query($link,"SELECT * FROM users");

?>
<div class="content">
</br>
<h1>Manage Users:</h1>
</br>
<div  class='form-group'>
   <a href='create_user.php'>
    <button style='background-color:pink'>Create New User</button>
</a> 
</div>
</br></br>


<table border='1'>
<tr>
<th>Username</th>
<th>Email</th>
<th>First_Name</th>
<th>Last_Name</th>
<th>Options</th>
</tr>

<?php
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
</div>
</body>
</html>