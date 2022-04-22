<?php
//Author:
//40197292
include "includes/head.php";

// Check if person does not have access
if ($_SESSION['role_id'] != 1) {
  // Redirect user back to previous page
  header("location: index.php");
  exit;
}

$result = mysqli_query($link,"SELECT * FROM courses");
?>

<div class="content">

<?php
// Display success/error message
if (isset($_SESSION['message'])){
  echo "<font color='blue'>".$_SESSION['message']."</font>";
  unset($_SESSION['message']);
}
if (isset($_SESSION['error'])){
    echo "<font color='red'>".$_SESSION['error']."</font>";
    unset($_SESSION['error']);
}
?>

<h1>Manage Courses</h1>
</br>
<div  class='form-group'>
  <a href='create_course.php'>
  <button style='background-color:pink'>Create New Course</button>
</a> 
</div>
</br></br>

<table border='1'>
<tr>
<th>Code</th>
<th>Course_Description</th>
<th>Course_Name</th>
<th>Term</th>
<th>Year</th>
<th>Start_Date</th>
<th>End_Date</th>
<th>Options</th>
</tr>

<?php

while($row = mysqli_fetch_array($result)){
  echo "<tr>";
  echo "<td>" . $row['code'] . "</td>";
  echo "<td>" . $row['course_desc'] . "</td>";
  echo "<td>" . $row['course_name'] . "</td>";
  echo "<td>" . $row['term'] . "</td>";
  echo "<td>" . $row['year'] . "</td>";
  echo "<td>" . $row['start_date'] . "</td>";
  echo "<td>" . $row['end_date'] . "</td>";
  echo "<td><a href='edit_course.php?id=".$row['course_id']."'>Edit</a>/<a href='delete_course.php?id=".$row['course_id']."' onclick=\"return confirm('Are you sure you want to delete this course?')\">Delete</a>/<a href='manage_sections.php?id=".$row['course_id']."'>Sections</a></td>";
  echo "</tr>";
}
echo "</table>";

mysqli_close($link);

?>

</div>
</body>
</html>