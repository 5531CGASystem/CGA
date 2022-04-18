<?php
//40197292
/* Database credentials. */
include "includes/head.php";

// Check connection
if ($link == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if (!isset($_GET['id'])) {
    // redirect to show page
    die('id not provided');
}
$id = (int)$_GET['id'];
$result = mysqli_query($link, "SELECT r.role_name,u.role_id FROM roles as r 
                               join user_roles as u
                               on r.role_id=u.role_id 
                               and u.user_id ='$id'");
$sql = mysqli_query($link, "SELECT username FROM users WHERE user_id = '$id'");
$row2 = mysqli_fetch_array($sql);
echo "<div class='content'>
</br>
<h2>Manage Roles:</h2>
<h3>Username: $row2[0]</h3>

<div  class='form-group'>
   <a href='create_role.php?id=" . $id . "'>
    <button style='background-color:pink'>Assign New Role</button>
</a> 
</div>
</br>";
if (mysqli_num_rows($result) == 0) {
    echo "No role available under this user";
} else {
    echo "<table border='1'>
    <tr>
     <th>Role</th>
	 <th>Options</th>
    </tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['role_name'] . "</td>";
        echo "<td><a href='delete_role.php?id=" . $row['role_id'] . "&u_id=$id'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

mysqli_close($link);
?>
</div>
</body>

</html>