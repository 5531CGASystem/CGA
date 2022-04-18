<?php
//40197292
include "includes/head.php";
// Check connection
if ($link == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$course_name = $code = $term = $year = $course_desc = $start_date = $end_date = "";
$course_error = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if course_name is empty
    if (empty(trim($_POST["course_name"]))) {
        $course_error = "Course name cannot be empty.";
    } else {
        // Prepare a select statement
        $sql = "SELECT course_id FROM courses WHERE course_name = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            // Link - https://www.php.net/manual/en/mysqli-stmt.bind-param.php
            mysqli_stmt_bind_param($stmt, "s", $param_course_name);

            // Set parameters
            $param_course_name = trim($_POST["course_name"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $course_error = "This course already exists.";
                } else {
                    $course_name = trim($_POST["course_name"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        //$course = trim($_POST["course_name"]);
    }
    if (empty($course_error)) {

        // Prepare an insert statement
        $sql = "INSERT INTO courses(course_name,code, term, year, course_desc, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_course_name, $param_code, $param_term, $param_year, $param_course_desc, $param_start_date, $param_end_date);

            // Set parameters
            $param_course_name = trim($_POST["course_name"]);
            $param_code = trim($_POST["code"]);
            $param_term = trim($_POST["term"]);
            $param_year = trim($_POST["year"]);
            $param_course_desc = trim($_POST["course_desc"]);
            $param_start_date = $_POST["start_date"];
            $param_end_date = $_POST["end_date"];


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location:manage_courses.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<div class=content>
    <?php
    if (!empty($course_error)) {
        echo '<div class="alert alert-danger">' . $course_error . '</div>';
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Course Name<font color='red'> *</font></label>
                <input type="text" name="course_name" class="form-control" value="<?php echo $course_name; ?>">
                <span style='display: block;'><?php echo $course_error; ?></span>
            </div>
            </br>
            <div class="form-group">
                <label>Code<font color='red'> *</font></label>
                <input type="text" name="code" class="form-control" value="<?php echo $code; ?>">
            </div>
            </br>
            <div class="form-group">
                <label>Term<font color='red'> *</font></label>
                <input type="text" name="term" class="form-control" value="<?php echo $term; ?>">
            </div>
            </br>
            <div class="form-group">
                <label>Year<font color='red'> *</font></label>
                <input type="text" name="year" class="form-control" value="<?php echo $year; ?>">
            </div>
            </br>
            <div class="form-group">
                <label>Start Date<font color='red'> *</font></label>
                <input type="date" name="start_date" class="form-control" value="<?php echo $start_date; ?>">
            </div>
            </br>
            <div class="form-group">
                <label>End Date<font color='red'> *</font></label>
                <input type="date" name="end_date" class="form-control" value="<?php echo $end_date; ?>">
            </div>
            </br>
            <div class="form-group">
                <label>Course Description<font color='red'> *</font></label>
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