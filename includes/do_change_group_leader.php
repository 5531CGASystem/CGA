<?php
// Helper to change group leader
// Author: 40197292
// Edited: 40215517

session_start();
include './config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
    }

	$group_id_Q = $_POST['group_id'];
	
	$sqlQ = "UPDATE `groups` SET leader_id = ? where group_id=$group_id_Q";
	
	if($stmtQ = mysqli_prepare($link, $sqlQ)){
		mysqli_stmt_bind_param($stmtQ, "i", $leader_id_update);
		$leader_id_update=$_POST['user_id'];
		if(mysqli_stmt_execute($stmtQ)){
            $_SESSION['message'] = "Group leader changed successfully!!";
            header("location:../manage_groups.php?id=$id");
		} else{
			$_SESSION['error'] = 'Error changing group leader.';
            header("location:../manage_groups.php?id=$id");
        }
		 
		mysqli_stmt_close($stmtQ); 
	}
}
else{
    header("location:../manage_courses.php");
    exit;
}