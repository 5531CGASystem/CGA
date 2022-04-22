<?php
// Deletes a section
// Author: 40197292
// Edited by: 40215517

session_start();
include "./includes/config.php";

// Check if person does not have access
if (!isset($_SERVER['HTTP_REFERER'])) {
    // Redirect user back to previous page
    header("location: manage_sections.php");
    exit;
}
if(!isset($_GET['course_id'])){
    $_SESSION['error'] = "Invalid link.";
    header("location:manage_courses.php");
    exit;
}
if(!isset($_GET['section_id'])){
    $_SESSION['error'] = "Invalid link.";
    header("location:manage_courses.php");
    exit;
}

$course_id = (int)$_GET['course_id'];
$section_id = (int)$_GET['section_id'];

$sql = "DELETE FROM sections WHERE section_id=$section_id";
if ($link->query($sql) === TRUE) {
    $_SESSION['message'] = "Section deleted successfully!!";
    // Redirect user back to previous page
    header("location: manage_sections.php?id=$course_id");
    exit;
} else {
    $_SESSION['error'] = "Error deleting record: " . $link->error;
    // Redirect user back to previous page
    header("location: manage_sections.php?id=$course_id");
    exit;
}

// Close connection
mysqli_close($link);
?>