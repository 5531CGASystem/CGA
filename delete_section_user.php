<?php
// Helper to delete a user from the section
// Author: 40197292
// Edited by: 40215517

session_start();
include "./includes/config.php";

// Check if person does not have access
if (!isset($_SERVER['HTTP_REFERER'])) {
    $_SESSION['error'] = "Invalid link.";
    header("location: manage_section_users.php");
    exit;
}

if(!isset($_GET['section_id']) && !isset($_GET['user_id'] )){
    $_SESSION['error'] = "Invalid link.";
    header("location:manage_courses.php");
    exit;
}

$section_id= (int)$_GET['section_id'];
$user_id=(int)$_GET['user_id'];

$sql = "DELETE FROM users_roles_sections WHERE section_id = '$section_id' and user_id='$user_id'";
if ($link->query($sql) === TRUE) {         
    $_SESSION['message'] = "Section student deleted successfully!!";
    // Redirect user back to previous page
    header("location: manage_section_users.php?id=$section_id");
    exit;
} else {
    $_SESSION['error'] = "Error deleting record: " . $link->error;
    // Redirect user back to previous page
    header("location: manage_section_users.php?id=$section_id");
    exit;
}

// Close connection
mysqli_close($link);
?>