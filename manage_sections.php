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
if(!isset($_GET['id'])){
        // redirect to show page
        die('id not provided');
    }
$id = (int)$_GET['id'];
$result = mysqli_query($link,"SELECT * FROM sections WHERE course_id = '$id'");
$sql = mysqli_query($link,"SELECT course_name FROM courses WHERE course_id = '$id'");
$row2 = mysqli_fetch_array($sql);
echo "<html>
<head>
<title>Sections</title>
</head>

<body style='background-color:#faf0e6'>
</br>
<h1>Course Name: $row2[0]</h1>
<h2>Sections:</h2>
</br>
<div  class='form-group'>
   <a href='create_section.php?id=".$id."'>
    <button style='background-color:pink'>Create New Section</button>
</a> 
</div>
</br></br>
</body>
</html>";
if(mysqli_num_rows($result)==0)
{
	echo "No section available under this course";
}
else
{
    echo "<table border='1'>
    <tr>
     <th>Section Name</th>
	 <th></th>
    </tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['section_name'] . "</td>";
echo "<td><a href='edit_section.php?id=".$row['section_id']."'>Edit</a>/<a href='delete_section.php?id=".$row['section_id']."'>Delete</a></td>";
echo "</tr>";
}
echo "</table>";
}

mysqli_close($link);
?>