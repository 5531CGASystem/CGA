<?php
//40197292
/* Database credentials. */
include "includes/head.php";

// Check connection
if($link == false) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
$result = mysqli_query($link,"SELECT * FROM courses");


?>
<div class="content">
<h1>Manage Courses</h1>
</br>
<div  class='form-group'>
   <a href='create_course.php'>
    <button style='background-color:pink'>Create New Course</button>
</a> 
</div>
</br></br>
<?php

echo "<table border='1'>
<tr>
<th>Code</th>
<th>Course_Description</th>
<th>Course_Name</th>
<th>Term</th>
<th>Year</th>
<th>Start_Date</th>
<th>End_Date</th>
<th>Options</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['code'] . "</td>";
echo "<td>" . $row['course_desc'] . "</td>";
echo "<td>" . $row['course_name'] . "</td>";
echo "<td>" . $row['term'] . "</td>";
echo "<td>" . $row['year'] . "</td>";
echo "<td>" . $row['start_date'] . "</td>";
echo "<td>" . $row['end_date'] . "</td>";
echo "<td><a href='edit_course.php?id=".$row['course_id']."'>Edit</a>/<a href='delete_course.php?id=".$row['course_id']."'>Delete</a>/<a href='manage_sections.php?id=".$row['course_id']."'>Sections</a></td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($link);
?>

</div>
</body>
</html>