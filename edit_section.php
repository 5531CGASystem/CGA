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
$sql = "SELECT * FROM sections where section_id = '$id'";

$result = $link->query($sql);

if ($result->num_rows != 1) {
    // redirect to show page
    die('id is not in db');
}
$data = $result->fetch_assoc();
// Define variables and initialize with empty values
$section_error = "";
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

    // Check if section_name is empty
    /* if (empty(trim($_POST["section_name"]))) {
        //$section_error = "Section name cannot be empty.";
    } else {
        // Prepare a select statement
        $sql = "SELECT section_id FROM sections WHERE section_name = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            // Link - https://www.php.net/manual/en/mysqli-stmt.bind-param.php
            mysqli_stmt_bind_param($stmt, "s", $param_section_name);

            // Set parameters
            $param_section_name = trim($_POST["section_name"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // store result 
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
    }*/
    if (empty($section_error)) {
        // Prepare an insert statement
        $sql = "UPDATE sections SET prof_id=? WHERE section_id=$id";
        if ($sql == false) {
            die("ERROR: Could not connect. " . mysqli_error($link));
        }

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_prof_id);

            // Set parameters
            $param_section_name = trim($_POST["section_name"]);
            $param_prof_id = $_POST["prof_id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location:manage_courses.php");
            } else {
                die('Error with execute: ' . htmlspecialchars($stmt->error));
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
}


if (!empty($section_error)) {
    echo '<div class="alert alert-danger">' . $section_error . '</div>';
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $id); ?>" method="post">
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