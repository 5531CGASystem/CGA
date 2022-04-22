<?php
// Deletes a course
// Author: 40197292
// Edited by: 40215517

session_start();
include "./includes/config.php";

// Check if person does not have access
if (!isset($_SERVER['HTTP_REFERER'])) {
    // Redirect user back to previous page
    header("location: manage_courses.php");
    exit;
}

if(!isset($_GET['id'])){
    $_SESSION['error'] = "This course does not exist.";
    header("location: manage_courses.php");
    exit;
}

$id = (int)$_GET['id'];
 
$sql = "DELETE FROM courses WHERE course_id = '$id'";
if ($link->query($sql) === TRUE) {
    $_SESSION['message'] = "Course deleted successfully!!";
    // Redirect user back to previous page
    header("location: manage_courses.php");
} else {
    $_SESSION['error'] = "Error deleting record: " . $link->error;
    // Redirect user back to previous page
    header("location: manage_courses.php");
}

// Close connection
mysqli_close($link);
?>