<?php
// Password reset page
// Author: 40215517
// Tester: 40186828

session_start();
include "./config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $current_password = $link->real_escape_string(trim($_POST["current_password"]));
    $new_password = $link->real_escape_string(trim($_POST["new_password"]));
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
    $new_password2 = $link->real_escape_string(trim($_POST["new_password2"]));

    // Check if re-entered password is same or not
    if(strcmp($new_password, $new_password2) != 0){
        $_SESSION['error'] = "The new passwords do not match.";
        // Redirect user back to previous page
        header("location: ../change_password.php");
        exit;
    }

    // Check if the new password is different from the old one
    if(strcmp($current_password, $new_password) == 0){
        $_SESSION['error'] = "The new password must be different.";
        // Redirect user back to previous page
        header("location: ../change_password.php");
        exit;
    }

    // Check if user and password exist and are correct
    $data = $link->query("SELECT * FROM users WHERE user_id=" . $_SESSION['id']);
    if ($data->num_rows > 0) {
       $user_data = $data -> fetch_assoc();
       if(password_verify($current_password, $user_data['password'])){
        try{
            $link->query("UPDATE users SET password='$hashed_new_password', reset_password=0 WHERE user_id=" . $_SESSION['id']);
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
       }else {
        $_SESSION['error'] = "Current Password is incorrect.";
        // Redirect user back to previous page
        header("location: ../change_password.php");
        exit;
       }
        
    }
    else{
        $_SESSION['error'] = "Password is incorrect.";
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
?>