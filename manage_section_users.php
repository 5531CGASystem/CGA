<?php
//40197292
/* Database credentials. */
include "includes/head.php";

// Check connection
if($link == false) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(!isset($_GET['id'])){
        // redirect to show page
        die('id not provided');
    }
$id = (int)$_GET['id'];
$result = mysqli_query($link,"SELECT user_id,username from users where user_id IN(SELECT user_id FROM users_sections WHERE section_id = '$id')");
$sql = mysqli_query($link,"SELECT section_name FROM sections WHERE section_id = '$id'");
$row2 = mysqli_fetch_array($sql);
echo "<html>
<head>
<title>Section Users</title>
</head>

<body style='background-color:#faf0e6'>
</br>
<h1>Section Name: $row2[0]</h1>
<h2>Section Users:</h2>
</br>
<div  class='form-group'>
   <a href='create_section_user.php?id=".$id."'>
    <button style='background-color:pink'>Associate User to Section</button>
</a> 
</div>
</br></br>
</body>
</html>";
if(mysqli_num_rows($result)==0)
{
	echo "No user available under this section";
}
else
{
    echo "<table border='1'>
    <tr>
     <th>User Name</th>
	 <th></th>
    </tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['username'] . "</td>";
echo "<td><a href='delete_section_user.php?section_id=".$id."&user_id=".$row['user_id']."'>Delete</a></td>";
echo "</tr>";
}
echo "</table>";
}

mysqli_close($link);
?>