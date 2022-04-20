<?php
//Author:
//40197292
//Edited by:
//40215517
session_start();
include "./includes/config.php";

if(!isset($_GET['course_id'])){
    // redirect to show page
    die('course_id not provided');
}
if(!isset($_GET['section_id'])){
    // redirect to show page
    die('section_id not provided');
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
?>