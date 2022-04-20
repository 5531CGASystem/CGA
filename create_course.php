<?php
//40197292
include "includes/head.php";
// Check connection
if ($link == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$course_name = $code = $term = $year = $course_desc = $start_date = $end_date = "";
$course_error = "";

?>

<div class=content>
    <?php
     if (isset($_SESSION['course_error'])) {
        echo "<p><font color='red'>" . $_SESSION['course_error'] . "</font><p><br><br>";
        unset($_SESSION['course_error']);
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
                <input type="text" required name="course_name" class="form-control" value="<?php echo $course_name; ?>"> <i>(Example: "Files and Databases")</i>
                <span style='display: block;'><?php echo $course_error; ?></span>
            </div>
            </br>
            <div class="form-group">
                <label>Code<font color='red'> *</font></label>
                <input type="text" required name="code" class="form-control" value="<?php echo $code; ?>"> <i>(Example: "COMP 5531")</i>
            </div>
            </br>
            <div class="form-group">
                <label>Term<font color='red'> *</font></label>
                <input type="text" required name="term" class="form-control" value="<?php echo $term; ?>"> <i>(Example: "Winter")</i>
            </div>
            </br>
            <div class="form-group">
                <label>Year<font color='red'> *</font></label>
                <input type="text" required name="year" class="form-control" value="<?php echo $year; ?>"> <i>(Example: "2022")</i>
            </div>
            </br>
            <div class="form-group">
                <label>Start Date<font color='red'> *</font></label>
                <input type="date" required name="start_date" class="form-control" value="<?php echo $start_date; ?>">
            </div>
            </br>
            <div class="form-group">
                <label>End Date<font color='red'> *</font></label>
                <input type="date" required name="end_date" class="form-control" value="<?php echo $end_date; ?>">
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