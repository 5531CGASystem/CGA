<?php
// Page to edit section
// Author: 40197292
// Edited: 40215517

include "includes/head.php";

// Check if person does not have access
if ($_SESSION['role_id'] != 1) {
    // Redirect user back to previous page
    header("location: index.php");
    exit;
}

if (!isset($_GET['course_id'])) {
    $_SESSION['error'] = "Invalid link.";
    header("location:manage_courses.php");
    exit;
}
if (!isset($_GET['section_id'])) {
    $_SESSION['error'] = "Invalid link.";
    header("location:manage_courses.php");
    exit;
}

$course_id = (int)$_GET['course_id'];
$section_id = (int)$_GET['section_id'];
$sql = "SELECT * FROM sections where section_id = '$section_id'";

$result = $link->query($sql);
if ($result->num_rows != 1) {
    $_SESSION['error'] = "Invalid link.";
    header("location:manage_courses.php");
    exit;
}
$data = $result->fetch_assoc();

// Define variables and initialize with empty values
$query = "SELECT u.user_id,u.username FROM users u";
$result2 = mysqli_query($link, $query);
$options = "";
while ($row2 = mysqli_fetch_array($result2)) {
    $selected="";
    if ($data['prof_id'] == $row2[0]){
        $selected="selected";
    }
    $options = $options . "<option $selected value='$row2[0]'>$row2[1]</option>";
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prepare an insert statement
    $sql = "UPDATE sections SET prof_id=? WHERE section_id=$section_id";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_prof_id);

        // Set parameters
        $param_prof_id = $_POST["prof_id"];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Section edited successfully!!";
            // Redirect to login page
            header("location:manage_sections.php?id=$course_id");
            exit;
        } else {
            $_SESSION['error'] = 'Error with execute: ' . htmlspecialchars($stmt->error);
            // Redirect to login page
            header("location:manage_sections.php?id=$course_id");
            exit;
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
}
?>

<style>
    form {
        display: table;
    }

    p {
        display: table-row;
    }

    label {
        display: table-cell;
    }

    input {
        display: table-cell;
    }
</style>

<div class="content">
    <h1>Edit Section</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?course_id='.$course_id.'&section_id=' . $section_id); ?>" method="post">
        <div class="form-group">
            <h2>Section Name: <?php echo $data['section_name']; ?></h2>
        </div>
        <div class="form-group">
            <label>Instructor:</label>
            <select name="prof_id" id="prof_id" class="form-control">
                <?php echo $options; ?>
            </select>
        </div>
        </br>

        <div class="form-group">
            <input type="submit" name="submit" style='background-color:pink' value="Submit">
        </div>
    </form>
</div>

</body>
</html>