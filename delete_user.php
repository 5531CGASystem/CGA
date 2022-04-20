<?php
//Authors:
//40197292
//40215517
//40196855

include "includes/head.php";

if(!isset($_GET['id'])){
        // redirect to show page
        die('id not provided');
    }
$id = (int)$_GET['id'];

$sql = "UPDATE users SET isactive=0 WHERE user_id='$id'";
if ($link->query($sql) === TRUE) {
    $_SESSION['message'] = "User deleted successfully.";
    // Redirect user back to previous page
    header("location: manage_users.php");
    exit;
} else {
    $_SESSION['error'] = "Sorry, we have run into a database error. Please try again.<br><br>Error: " . $link->error;
    // Redirect user back to previous page
    header("location: manage_users.php");
    exit;
}

// Close connection
mysqli_close($link);

?>