<?php
// Page to edit an existing user
// Author: 40197292
// Edited: 40215517

include "includes/head.php";

// Check if person does not have access
if ($_SESSION['role_id'] != 1) {
    // Redirect user back to previous page
    header("location: index.php");
    exit;
}

if (!isset($_GET['id'])) {
    $_SESSION['error'] = "This user does not exist.";
    header("location:manage_users.php");
    exit;
}

$id = (int)$_GET['id'];
$sql = "SELECT * FROM users where user_id = '$id'";
$result = $link->query($sql);
if ($result->num_rows != 1) {
    $_SESSION['error'] = "This user does not exist.";
    header("location:manage_users.php");
    exit;
}
$data = $result->fetch_assoc();

// Define variables and initialize with empty values
$username_err = $password_err  = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prepare a select statement
    $sql = "SELECT user_id FROM users WHERE username = ? and user_id!=$id";

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
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $email = trim($_POST["email"]);
    $isactive = "1";
    $create_at = $_POST["create_at"];
    if (isset($_POST['reset_password'])) {
        $reset_password = "1";
    } else {
        $reset_password = "0";
    }

    $isadmin=0;
    if(isset($_POST['is_admin'])){
        $isadmin=$_POST["is_admin"];
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err)) {

        // Prepare an insert statement
        $sql = "UPDATE users SET username = ?, password= ?, fname=?, lname=?, email=?, create_at=?, isactive=?, isadmin=? ,reset_password=? Where user_id=$id ";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_username, $param_password, $param_fname, $param_lname, $param_email, $param_create_at, $param_isactive,$param_isadmin, $param_reset_password);
            // Set parameters
            $param_username = $username;
            $param_password = $hashed_password;
            $param_fname = $fname;
            $param_lname = $lname;
            $param_email = $email;
            $param_create_at = $create_at;
            $param_isactive = $isactive;
            $param_isadmin = $isadmin;
            $param_reset_password = $reset_password;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = "User successfully edited!!";
                // Redirect to users page
                header("location:manage_users.php");
                exit;
            } else {
                $_SESSION['error'] = "Could not edit user. Error: " . mysqli_stmt_error($stmt);
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
    <h1>Edit User</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $id); ?>" method="post">
        <div class="form-group">
            <label>Username: <?php echo $data['username']; ?></label>
            <input type="hidden" name="username" class="form-control" value="<?= $data['username'] ?>">
        </div>
        </br>
        <div class="form-group">
            <label>Password<font color='red'> *</font></label>
            <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" maxlength=20 value="<?= $data['password'] ?>" required>
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        </br>
        <div class="form-group">
            <label>First Name<font color='red'> *</font></label>
            <input type="text" name="fname" class="form-control" value="<?= $data['fname'] ?>" required>
        </div>
        </br>
        <div class="form-group">
            <label>Last Name<font color='red'> *</font></label>
            <input type="text" name="lname" class="form-control" value="<?= $data['lname'] ?>" required>
        </div>
        </br>
        <div class="form-group">
            <label>Email<font color='red'> *</font></label>
            <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required>
        </div>
        </br>
        <div class="form-group">
            <input type="checkbox" <?php echo $data['reset_password'] == "1" ? "checked" : ""; ?> name="reset_password" value=1>
            <label for="reset_password">Reset Password</label>
        </div>
        <br>
        <div class="form-group">
            <input type="checkbox" <?php echo $data['isadmin'] == "1" ? "checked" : ""; ?> name="is_admin" value=1>
            <label for="reset_password">Admin</label>
        </div>
        </br>
        <div class="form-group">
            <input type="hidden" name="create_at" id="create_at" value="<?= $data['create_at'] ?>">
            <input type="submit" style='background-color:pink' value="Submit">
        </div>
    </form>
</div>
</body>

</html>