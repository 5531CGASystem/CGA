<?php
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
$result = mysqli_query($link, "SELECT * FROM sections WHERE course_id = '$id'");
$sql = mysqli_query($link, "SELECT course_name FROM courses WHERE course_id = '$id'");
$row2 = mysqli_fetch_array($sql);
?>
<div class="content">
    </br>
    <h1>Course Name: <?php echo $row2[0] ?></h1>
    <h2>Manage Sections</h2>
    <div class='form-group'>
        <?php
        echo "<a href='create_section.php?id=".$id."'>";
        ?>
            <button style='background-color:pink'>Create New Section</button>
        </a>
    </div>
    <br>


<?php
if (mysqli_num_rows($result) == 0) {
    echo "No section available under this course";
} else {
    echo "<table border='1'>
    <tr>
     <th>Section Name</th>
	 <th>Options</th>
    </tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['section_name'] . "</td>";
        echo "<td><a href='edit_section.php?id=".$row['section_id']."'>Edit</a>/<a href='delete_section.php?id=".$row['section_id']."'>Delete</a>/<a href='manage_groups.php?id=".$row['section_id']."'>Groups</a>/<a href='manage_section_users.php?id=".$row['section_id']."'>Manage Users</a>/<a href='manage_section_tas.php?id=".$row['section_id']."'>Manage TAs</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}

mysqli_close($link);
?>
</div>
</body>

</html>
