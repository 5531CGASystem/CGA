<?php
//Author:
//40197292
//Edited by:
//40215517
session_start();
include "./includes/config.php";

if(!isset($_GET['section_id'])){
    // redirect to show page
    die('section_id not provided');
}
if(!isset($_GET['group_id'])){
    // redirect to show page
    die('group_id not provided');
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