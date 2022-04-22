<?php
// Page to create a course section
// Author: 40197292
// Edited by: 40215517 & 40196855

include "includes/head.php";

// Check if person does not have access
if ($_SESSION['role_id'] != 1) {
    // Redirect user back to previous page
    header("location: index.php");
    exit;
}

$id = 0;
if (isset($_POST['submit'])) {
    $id = $_POST["id"];
} elseif (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
}
else{
    $_SESSION['error'] = "Invalid link.";
    header("location:manage_courses.php");
    exit;
}

$course_id = $id;
$section_name = "";
$section_error = "";
$prof_id = 0;

$query = "SELECT u.user_id, u.username FROM users u";
$result2 = mysqli_query($link, $query);
$options = "";
while ($row2 = mysqli_fetch_array($result2)) {
    $options = $options . "<option value='$row2[0]'>$row2[1]</option>";
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prepare a select statement
    $sql = "SELECT section_id FROM sections WHERE section_name = ? and course_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "si", $param_section_name, $param_course_id);

        // Set parameters
        $param_section_name = trim($_POST["section_name"]);
        $param_course_id = $_POST["course_id"];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                $_SESSION['error'] = "This section already exists.";
                header("location: create_section.php?id=$id");
                exit;
            } else {
                $section_name = trim($_POST["section_name"]);
            }
        } else {
            $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
            header("location: create_section.php?id=$id");
            exit;
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Prepare an insert statement
    $sql = "INSERT INTO sections(section_name, prof_id, course_id) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sii", $param_section_name, $param_prof_id, $param_course_id);

        // Set parameters
        $param_section_name = trim($_POST["section_name"]);
        $param_prof_id = $_POST["prof_id"];
        $param_course_id = $_POST["course_id"];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Section created successfully!!";
            // Redirect to login page
            header("location:manage_sections.php?id=$id");
        } else {
            $_SESSION['error'] = 'Error with execute: ' . htmlspecialchars($stmt->error);
            // Redirect to login page
            header("location:manage_sections.php?id=$id");
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
}
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

    <div class="wrapper">
        <h1>Create a Section</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Section Name<font color='red'> *</font></label>
                <input type="text" name="section_name" class="form-control" value="<?php echo $section_name; ?>" maxlength=45 required>
            </div>
            </br>
            <div class="form-group">
                <label>Instructor</label>
                <select name="prof_id" id="prof_id" class="form-control">
                    <?php echo $options; ?>
                </select>
            </div>
            </br>
            <div style="display:none;" class="form-group">
                <label>Course Id<font color='red'> *</font></label>
                <input type="text" name="course_id" class="form-control" value="<?php echo $course_id; ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="form-group">
                <input type="submit" name="submit" style='background-color:pink' value="Submit">
            </div>
        </form>
    </div>
</div>

</body>
</html>
