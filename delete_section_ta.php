<?php
//Author:
//40197292
//Edited by:
//40215517
include "includes/head.php";

if(!isset($_GET['section_id']) && !isset($_GET['ta_id'] )){
    // redirect to show page
    die('id not provided');
}

$section_id= (int)$_GET['section_id'];
$ta_id=(int)$_GET['ta_id'];
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