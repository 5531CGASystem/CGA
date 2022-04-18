<?php
session_start();
include "./config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $link->real_escape_string(trim($_POST["username"]));
    $current_password = $link->real_escape_string(trim($_POST["current_password"]));
    $new_password = $link->real_escape_string(trim($_POST["new_password"]));
    $new_password2 = $link->real_escape_string(trim($_POST["new_password2"]));

    if(strcmp($new_password, $new_password2) != 0){
        $_SESSION['error'] = "The new passwords do not match.";
        // Redirect user back to previous page
        header("location: ../change_password.php");
        exit;
    }

    // Check if username and password exist and are correct
    $data = $link->query("SELECT * FROM users WHERE username='$username' AND password='$current_password'");
    if ($data->num_rows > 0) {
        try{
            $link->query("UPDATE users SET password='$new_password', reset_password=0 WHERE username='$username'");
            $_SESSION['message'] = "Password has been successfully changed.";
            // Redirect user back to previous page
            header("location: logout.php");
            exit;
        }
        catch(Exception $e){
            $_SESSION['error'] = "Sorry, we have run into a database error. Please try again.<p></p>Error: " . $e;
            // Redirect user back to previous page
            header("location: ../change_password.php");
            exit;
        }
    }
    else{
        $_SESSION['error'] = "Username and/or password incorrect.";
        // Redirect user back to previous page
        header("location: ../change_password.php");
        exit;
    }
}
else{
    // Redirect user to welcome page
    header("location: logout.php");
    exit;
}