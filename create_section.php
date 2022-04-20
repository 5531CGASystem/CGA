<?php
//40197292
include "includes/head.php";

// Check connection
if ($link == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$id = 0;
if (isset($_POST['submit'])) {
    $id = $_POST["id"];
} else {
    $id = (int)$_GET['id'];
}
$course_id = $id;
$section_name = "";
$section_error = "";
$prof_id = 0;
$query = "SELECT u.user_id,u.username FROM users u";
$result2 = mysqli_query($link, $query);
$options = "";
while ($row2 = mysqli_fetch_array($result2)) {
    $options = $options . "<option value='$row2[0]'>$row2[1]</option>";
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if section_name is empty
    if (empty(trim($_POST["section_name"]))) {
        $section_error = "Section name cannot be empty.";
    } else {
        // Prepare a select statement
        $sql = "SELECT section_id FROM sections WHERE section_name = ? and course_id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            // Link - https://www.php.net/manual/en/mysqli-stmt.bind-param.php
            mysqli_stmt_bind_param($stmt, "si", $param_section_name, $param_course_id);

            // Set parameters
            $param_section_name = trim($_POST["section_name"]);
            $param_course_id = $_POST["course_id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $section_error = "This section already exists.";
                } else {
                    $section_name = trim($_POST["section_name"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    if (empty($section_error)) {
        // Prepare an insert statement
        $sql = "INSERT INTO sections(section_name, prof_id, course_id) VALUES (?, ?, ?)";
        if ($sql == false) {
            die("ERROR: Could not connect. " . mysqli_error($link));
        }

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
}

?>
<div class="content">
    <?php
    if (!empty($section_error)) {
        echo '<div class="alert alert-danger">' . $section_error . '</div>';
    }
    ?>
    <div class="wrapper">
        <h1>Create a Section</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Section Name<font color='red'> *</font></label>
                <input type="text" name="section_name" class="form-control" value="<?php echo $section_name; ?>">
                <span style='display: block;'><?php echo $section_error; ?></span>
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
