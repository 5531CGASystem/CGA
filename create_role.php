<?php
//40197292
/* Database credentials. */
include "includes/head.php";

// Check connection
if ($link == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$role_err = "";
$id = 0;
$user_id = 0;
if (isset($_POST['submit'])) {
    $id = $_POST["id"];
    $user_id = $id;
} else {
    $id = (int)$_GET['id'];
    $user_id = $id;
}
$query = "SELECT * FROM `roles`";
$result2 = mysqli_query($link, $query);
$options = "";
while ($row2 = mysqli_fetch_array($result2)) {
    $options = $options . "<option value='$row2[0]'>$row2[1]</option>";
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare a select statement
    $sql1 = "SELECT * FROM user_roles WHERE role_id = ? and user_id = ?";
    if ($stmt = mysqli_prepare($link, $sql1)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ii", $param_role_id, $param_user_id);

        // Set parameters
        $param_user_id = $_POST["user_id"];
        $param_role_id = $_POST["role_id"];
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            /* store result */
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                $role_err = "This role already exists.";
            } else {
                $user_id = $_POST["user_id"];
            }
        } else {
            echo "Oops! Something went wrong";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Check input errors before inserting in database
    if (empty($role_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO user_roles(user_id, role_id) VALUES (?, ?)";
        if ($sql == false) {
            die("ERROR: Could not connect. " . mysqli_error($link));
        }

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_user_id, $param_role_id);

            // Set parameters
            $param_user_id = $_POST["user_id"];
            $param_role_id = $_POST["role_id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location:manage_users.php");
            } else {
                die('Error with execute: ' . htmlspecialchars($stmt->error));
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Close connection
    mysqli_close($link);
}

?>

<div class="content">
    <h2>Assign Roles:</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Role:</label>
            <select name="role_id" id="role_id" class="form-control">
                <?php echo $options; ?>
            </select>

        </div>
        <span style='display: block;'><?php echo $role_err; ?></span>
        </br>
        <div style="display:none;" class="form-group">
            <input type="text" name="user_id" class="form-control" value="<?php echo $user_id; ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <div class="form-group">
            <input type="submit" name="submit" style='background-color:pink' value="Submit">
        </div>
    </form>
</div>

</body>

</html>