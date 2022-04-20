<?php
//Author:
//40197292
//Edited by:
//40215517
session_start();
include "./includes/config.php";

if(!isset($_GET['id'])){
    // redirect to show page
    die('id not provided');
}
$id = (int)$_GET['id'];
 
$sql = "DELETE FROM courses WHERE course_id = '$id'";
if ($link->query($sql) === TRUE) {
    $_SESSION['message'] = "Course deleted successfully!!";
    // Redirect user back to previous page
    header("location: manage_courses.php");
    exit;
} else {
    $_SESSION['error'] = "Error deleting record: " . $link->error;
    // Redirect user back to previous page
    header("location: manage_courses.php");
    exit;
}

// Close connection
mysqli_close($link);
?>