<?php
// Deletes a section TA
// Author: 40197292
// Edited: 40215517

session_start();
include "./includes/config.php";

// Check if person does not have access
if (!isset($_SERVER['HTTP_REFERER'])) {
    $_SESSION['error'] = "Invalid link.";
    header("location: manage_courses.php");
    exit;
}

if(!isset($_GET['section_id']) && !isset($_GET['ta_id'])){
    $_SESSION['error'] = "Invalid link.";
    header("location:manage_courses.php");
    exit;
}

$section_id= (int)$_GET['section_id'];
$ta_id= (int)$_GET['ta_id'];

$sql = "DELETE FROM users_roles_sections WHERE section_id = '$section_id' and user_id='$ta_id' and role_id=3";
if ($link->query($sql) === TRUE) {
    $_SESSION['message'] = "Section TA deleted successfully!!";
    // Redirect user back to previous page
    header("location: manage_section_tas.php?id=$section_id");
    exit;
} else {
    $_SESSION['error'] = "Error deleting record: " . $link->error;
    // Redirect user back to previous page
    header("location: manage_section_tas.php?id=$section_id");
    exit;
}

// Close connection
mysqli_close($link);
?>