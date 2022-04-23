<?php
// Page to edit a course
// Author: 40197292
// Edited: 40215517 & 40196855
// Tester: 40186828

include "includes/head.php";

// Check if person does not have access
if ($_SESSION['role_id'] != 1) {
    // Redirect user back to previous page
    header("location: index.php");
    exit;
}

$id = (int)$_GET['id'];
$sql1 = "SELECT * FROM courses where course_id = '$id'";
$result = $link->query($sql1);
if ($result->num_rows != 1) {
    $_SESSION['error'] = "This course does not exist.";
    header("location:manage_courses.php");
    exit;
}
$data = $result->fetch_assoc();
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
    
    <h1>Edit Course</h1>
    <form action="<?php echo htmlspecialchars('includes/do_edit_course.php?id=' . $id); ?>" method="post">
        <div class="form-group">
            <label>Course Name<font color='red'> *</font></label>
            <input type="text" name="course_name" class="form-control" value="<?= $data['course_name'] ?>" maxlength=60 required>
        </div>
        </br>
        <div class="form-group">
            <label>Code<font color='red'> *</font></label>
            <input type="text" name="code" class="form-control" value="<?= $data['code'] ?>" maxlength=15 required>
        </div>
        </br>
        <div class="form-group">
            <label>Term<font color='red'> *</font></label>
            <input type="text" name="term" class="form-control" value="<?= $data['term'] ?>" maxlength=20 required>
        </div>
        </br>
        <div class="form-group">
            <label>Year<font color='red'> *</font></label>
            <input type="text" name="year" class="form-control" pattern="^[0-9]*$" title="Please type a number." maxlength=10 value="<?= $data['year'] ?>" required>
        </div>
        </br>
        <div class="form-group">
            <label>Start Date<font color='red'> *</font></label>
            <input type="date" name="start_date" class="form-control" value="<?= $data['start_date'] ?>" required>
        </div>
        </br>
        <div class="form-group">
            <label>End Date<font color='red'> *</font></label>
            <input type="date" name="end_date" class="form-control" value="<?= $data['end_date'] ?>" required>
        </div>
        </br>
        <div class="form-group">
            <label>Course Description</label>
            <textarea style="min-height: 100px; min-width: 271px;" type="text" name="course_desc" class="form-control"><?php echo htmlspecialchars($data['course_desc']); ?></textarea>
        </div>
        </br>
        <div class="form-group">
            <input type="submit" style='background-color:pink' value="Submit">
        </div>
    </form>
</div>

</body>

</html>