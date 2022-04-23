<?php
// Helper to delete a group
// Author: 40197292
// Edited: 40215517
// Tester: 40186828

session_start();
include "./includes/config.php";

// Check if person does not have access
if (!isset($_SERVER['HTTP_REFERER'])) {
    // Redirect user back to previous page
    header("location: manage_groups.php");
    exit;
}

if(!isset($_GET['section_id'])){
    $_SESSION['error'] = "Invalid link.";
    header("location: manage_courses.php");
    exit;
}
if(!isset($_GET['group_id'])){
    $_SESSION['error'] = "Invalid link.";
    header("location: manage_courses.php");
    exit;
}

$section_id = (int)$_GET['section_id'];
$group_id = (int)$_GET['group_id'];

$sql = "DELETE FROM `groups` WHERE group_id = '$group_id'";
if ($link->query($sql) === TRUE) {
    $_SESSION['message'] = "Group deleted successfully!!";
    // Redirect user back to previous page
    header("location: manage_groups.php?id=$section_id");
    exit;
} else {
    $_SESSION['error'] = "Error deleting record: " . $link->error;
    // Redirect user back to previous page
    header("location: manage_groups.php?id=$section_id");
    exit;
}

// Close connection
mysqli_close($link);
?>