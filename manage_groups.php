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
$result = mysqli_query($link,"SELECT * FROM courses");

echo "<html>
<head>
<title>Courses</title>
</head>

<body style='background-color:#faf0e6'>
</br>
<h1>Courses:</h1>
</br>
<div  class='form-group'>
   <a href='create_course.php'>
    <button style='background-color:pink'>Create New Course</button>
</a> 
</div>
</br></br>
</body>
</html>";

echo "<table border='1'>
<tr>
<th>Code</th>
<th>Course_Name</th>
<th>Term</th>
<th>Year</th>
<th>Start_Date</th>
<th>End_Date</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['code'] . "</td>";
echo "<td>" . $row['course_name'] . "</td>";
echo "<td>" . $row['term'] . "</td>";
echo "<td>" . $row['year'] . "</td>";
echo "<td>" . $row['start_date'] . "</td>";
echo "<td>" . $row['end_date'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($link);
?>