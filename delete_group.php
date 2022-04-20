<?php
//Author:
//40197292
//Edited by:
//40215517
include "includes/head.php";

if(!isset($_GET['id'])){
    // redirect to show page
    die('id not provided');
}
$id = (int)$_GET['id'];

$sql = "DELETE FROM `groups` WHERE group_id = '$id'";
if ($link->query($sql) === TRUE) {
    $_SESSION['message'] = "Group deleted successfully!!";
    // Redirect user back to previous page
    header("location: manage_groups.php");
    exit;
} else {
    $_SESSION['error'] = "Error deleting record: " . $link->error;
    // Redirect user back to previous page
    header("location: manage_groups.php");
    exit;
}

// Close connection
mysqli_close($link);
?>