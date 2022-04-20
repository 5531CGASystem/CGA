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
$sql = "SELECT * FROM users where user_id = '$id'";

$result = $link->query($sql);

if ($result->num_rows != 1) {
    // redirect to show page
    die('id is not in db');
}
$data = $result->fetch_assoc();
// Define variables and initialize with empty values
$username_err = $password_err  = "";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
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
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have  characters greater than or equal to 6.";
    } else {
        $password = trim($_POST["password"]);
    }
    // fname
    $fname = trim($_POST["fname"]);
    // lname
    $lname = trim($_POST["lname"]);
    //email
    $email = trim($_POST["email"]);
    //isactive
    $isactive = "1";
    $create_at = $_POST["create_at"];
    //reset password
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
            $param_password = $password;
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
            <label>Username<font color='red'> *</font></label>
            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?= $data['username'] ?>">
            <span style="display:block;"><?php echo $username_err; ?></span>
        </div>
        </br>
        <div class="form-group">
            <label>Password<font color='red'> *</font></label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?= $data['password'] ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        </br>
        <div class="form-group">
            <label>First Name<font color='red'> *</font></label>
            <input type="text" name="fname" class="form-control" value="<?= $data['fname'] ?>">
        </div>
        </br>
        <div class="form-group">
            <label>Last Name<font color='red'> *</font></label>
            <input type="text" name="lname" class="form-control" value="<?= $data['lname'] ?>">
        </div>
        </br>
        <div class="form-group">
            <label>Email<font color='red'> *</font></label>
            <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>">
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