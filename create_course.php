<?php
// Page to create a course
// Author: 40197292
// Edited: 40215517 & 40196855

include "includes/head.php";

// Check if person does not have access
if ($_SESSION['role_id'] != 1) {
    // Redirect user back to previous page
    header("location: index.php");
    exit;
}

$course_name = $code = $term = $year = $course_desc = $start_date = $end_date = "";
?>

<div class=content>

    <?php
    // Display success/error message
    if (isset($_SESSION['course_error'])) {
        echo "<font color='red'>" . $_SESSION['course_error'] . "</font>";
        unset($_SESSION['course_error']);
    }
    if (isset($_SESSION['message'])) {
        echo "<font color='blue'>" . $_SESSION['message'] . "</font>";
        unset($_SESSION['message']);
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

    <div class="wrapper">
        <h1>Create a Course</h1>
        <form action="includes/do_create_course.php" method="post">
            <div class="form-group">
                <label>Course Name<font color='red'> *</font></label>
                <input type="text" required name="course_name" class="form-control" value="<?php echo $course_name; ?>" maxlength=60 required> <i>(Example: "Files and Databases")</i>
            </div>
            </br>
            <div class="form-group">
                <label>Code<font color='red'> *</font></label>
                <input type="text" required name="code" class="form-control" value="<?php echo $code; ?>" maxlength=15 required> <i>(Example: "COMP 5531")</i>
            </div>
            </br>
            <div class="form-group">
                <label>Term<font color='red'> *</font></label>
                <input type="text" required name="term" class="form-control" value="<?php echo $term; ?>" maxlength=20 required> <i>(Example: "Winter")</i>
            </div>
            </br>
            <div class="form-group">
                <label>Year<font color='red'> *</font></label>
                <input type="text" required name="year" class="form-control" value="<?php echo $year; ?>" pattern="^[0-9]*$" title="Please type a number." maxlength=10 required> <i>(Example: "2022")</i>
            </div>
            </br>
            <div class="form-group">
                <label>Start Date<font color='red'> *</font></label>
                <input type="date" required name="start_date" class="form-control" value="<?php echo $start_date; ?>" required>
            </div>
            </br>
            <div class="form-group">
                <label>End Date<font color='red'> *</font></label>
                <input type="date" required name="end_date" class="form-control" value="<?php echo $end_date; ?>" required>
            </div>
            </br>
            <div class="form-group">
                <label>Course Description</label>
                <textarea style="min-height: 100px; min-width: 271px;" type="text" name="course_desc" class="form-control" value="<?php echo $course_desc; ?>"></textarea>
            </div>
            </br>
            <div class="form-group">
                <input type="submit" style='background-color:pink' value="Submit">
            </div>
        </form>
    </div>
</div>

</body>
</html>