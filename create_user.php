<?php
//40197292
include "includes/head.php";
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$query = "SELECT * FROM `roles`";
$result2 = mysqli_query($link, $query);
$options = "";
while ($row2 = mysqli_fetch_array($result2)) {
    $options = $options . "<option value='$row2[0]'>$row2[1]</option>";
}

// Define variables and initialize with empty values
$username = $password  = $fname = $lname = $email = $create_at = $isactive = $reset_password = $role_id = "";
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
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) > 6) {
        $password_err = "Password must have  characters less than or equal to 6.";
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
    //reset_password
    $reset_password = "1";
    //is_admin
    $is_admin=0;
    if(isset($_POST['is_admin'])){
        $is_admin=$_POST["is_admin"];
    }
    //role_id
    //$role_id = $_POST["role_id"];




    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, fname, lname, email, create_at, isactive, isadmin ,reset_password ) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssss", $param_username, $param_password, $param_fname, $param_lname, $param_email, $param_create_at, $param_isactive,$param_isadmin, $param_reset_password);

            // Set parameters

            $create_at = date("Y/m/d");
            $param_username = $username;
            $param_password = $password;
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
            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span style='display: block;'><?php echo $username_err; ?></span>
        </div>
        </br>
        <div class="form-group">
            <label>Password:<font color='red'> *</font></label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        </br>
        <div class="form-group">
            <label>First Name:<font color='red'> *</font></label>
            <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
        </div>
        </br>
        <div class="form-group">
            <label>Last Name:<font color='red'> *</font></label>
            <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
        </div>
        </br>
        <div class="form-group">
            <label>Email:<font color='red'> *</font></label>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
        </div>
        </br>
        <div class="form-group">
            <label>Admin:<font color='red'> *</font></label>
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