<?php
// Portal to manage section students
// Author: 40197292
// Edited: 40215517

include "includes/head.php";

// Check if person does not have access
if ($_SESSION['role_id'] != 1) {
    // Redirect user back to previous page
    header("location: index.php");
    exit;
}

if(!isset($_GET['id'])){
    $_SESSION['error'] = "Invalid link.";
    header("location: manage_courses.php");
    exit;
}
$id = (int)$_GET['id'];

$result = mysqli_query($link,"SELECT user_id,username from users where isactive=1 and user_id IN(SELECT user_id FROM users_roles_sections WHERE section_id = '$id' AND role_id=4)");
$sql = mysqli_query($link,"SELECT section_name FROM sections WHERE section_id = '$id'");
$row2 = mysqli_fetch_array($sql);

echo "<div class='content'>";

// Display success/error message
if (isset($_SESSION['message'])){
    echo "<font color='blue'>".$_SESSION['message']."</font>";
    unset($_SESSION['message']);
}
if (isset($_SESSION['error'])){
    echo "<font color='red'>".$_SESSION['error']."</font>";
    unset($_SESSION['error']);
}

echo "</br>
<h1>Section Name: $row2[0]</h1>
<h2>Students:</h2>
<div  class='form-group'>
   <a href='create_section_user.php?id=".$id."'>
    <button style='background-color:pink'>Add Students</button>
</a> 
</div><br>";

if(mysqli_num_rows($result)==0){
	echo "No user available under this section";
}
else{
    echo "<table border='1'>
    <tr>
     <th>Student User Name</th>
	 <th>Options</th>
    </tr>";

    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td><a href='delete_section_user.php?section_id=".$id."&user_id=".$row['user_id']."'>Remove</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}

mysqli_close($link);
?>