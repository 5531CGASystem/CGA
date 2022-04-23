<?php
// Deletes a user
// Author: 40197292
// Edited: 40215517 & 40196855
// Tester: 40186828

session_start();
include "./includes/config.php";

// Check if person does not have access
if (!isset($_SERVER['HTTP_REFERER'])) {
    // Redirect user back to previous page
    header("location: manage_users.php");
    exit;
}

if(!isset($_GET['id'])){
    $_SESSION['error'] = "This user does not exist.";
    header("location: manage_users.php");
    exit;
}

$id = (int)$_GET['id'];

$sql = "UPDATE users SET isactive=0 WHERE user_id='$id'";
if ($link->query($sql) === TRUE) {
    $_SESSION['message'] = "User deleted successfully.";
    // Redirect user back to previous page
    header("location: manage_users.php");
} else {
    $_SESSION['error'] = "Sorry, we have run into a database error. Please try again.<br><br>Error: " . $link->error;
    // Redirect user back to previous page
    header("location: manage_users.php");
}

// Close connection
mysqli_close($link);

?>