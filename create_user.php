<?php
// Page to add a new user to the system
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

// Define variables and initialize with empty values
$username = $password  = $fname = $lname = $email = $create_at = $isactive = $reset_password = $role_id = "";
$username_err = $password_err  = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prepare a select statement
    $sql = "SELECT user_id FROM users WHERE username = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        // Set parameters
        $param_username = trim($_POST["username"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            /* store result */
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                $username_err = "This username is already taken.";
            } else {
                $username = trim($_POST["username"]);
            }
        } else {
            echo "Oops! Something went wrong";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Set user info variables
    $password = trim($_POST["password"]);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $email = trim($_POST["email"]);
    $isactive = "1";
    $reset_password = "1";
    $is_admin=0;

    if(isset($_POST['is_admin'])){
        $is_admin=$_POST["is_admin"];
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, fname, lname, email, create_at, isactive, isadmin , reset_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_username, $param_password, $param_fname, $param_lname, $param_email, $param_create_at, $param_isactive,$param_isadmin, $param_reset_password);

            // Set parameters
            $create_at = date("Y/m/d");
            $param_username = $username;
            $param_password = $hashed_password;
            $param_fname = $fname;
            $param_lname = $lname;
            $param_email = $email;
            $param_create_at = $create_at;
            $param_isactive = $isactive;
            $param_isadmin = $is_admin;
            $param_reset_password = $reset_password;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = "User successfully created!!";
                // Redirect to users page
                header("location:manage_users.php");
                exit;
            } else {
                $_SESSION['error'] = "Could not create user. Error: " . mysqli_stmt_error($stmt);
                // Redirect to users page
                header("location:manage_users.php");
                exit;
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
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
    <h1>Create User</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Username:<font color='red'> *</font></label>
            <input type="text" name="username" pattern="^[a-zA-Z0-9_]{6,}$" title="Must be alphanumeric, can contain underscore, and at least 6 or more characters" maxlength=50 value="<?php echo $username; ?>" required>
            <span style='display: block;'><?php echo $username_err; ?></span>
        </div>
        </br>
        <div class="form-group">
            <label>Password:<font color='red'> *</font></label>
            <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" maxlength=20 value="<?php echo $password; ?>" required>
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        </br>
        <div class="form-group">
            <label>First Name:<font color='red'> *</font></label>
            <input type="text" name="fname" pattern="^[A-Za-z]+$" title="Alphabet characters in name only" value="<?php echo $fname; ?>" required>
        </div>
        </br>
        <div class="form-group">
            <label>Last Name:<font color='red'> *</font></label>
            <input type="text" name="lname" class="form-control" pattern="^[A-Za-z]+$" title="Alphabet characters in name only" value="<?php echo $lname; ?>" required>
        </div>
        </br>
        <div class="form-group">
            <label>Email:<font color='red'> *</font></label>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
        </div>
        </br>
        <div class="form-group">
            <label>Admin?:</label>
            <input type="checkbox" class="form-control" name="is_admin" value="1">
        </div>
        <br>
        <div class="form-group">
            <input type="submit" style='background-color:pink' value="Submit">
        </div>
    </form>
</div>
</body>

</html>