<?php 
// Helper to add a student to section
// Author: 40197292
// Edited: 40215517

session_start();
include "./config.php";

$id=0;
$section_id=0;
if (isset($_POST['submit'])){  
	$id =$_POST["id"];
	$section_id=$id;
}
elseif (isset($_GET['id'])){
	$id = (int)$_GET['id'];
	$section_id=$id;
}
else {
    $_SESSION['error'] = "Invalid link.";
    header("location: ../manage_courses.php");
    exit;
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Prepare an insert statement
    $sql = "INSERT INTO users_roles_sections(user_id, section_id, role_id) VALUES (?, ?, ?)";
        
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "iii",$param_user_id,$param_section_id,$param_role_id);
        
        // Set parameters
        $param_user_id = $_POST["user_id"];
        $param_section_id = $section_id;
        $param_role_id = 4;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $_SESSION['message'] = "Added student successfully!!";
            // Redirect to login page
            header("location:../manage_section_users.php?id=$id");
            
        } else{
            $_SESSION['error'] = "Error with execute: " . htmlspecialchars($stmt->error);
            header("location:../create_section_user.php?id=$id");
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
}
else{
    $_SESSION['error'] = "Invalid link.";
    header("location: ../manage_courses.php");
    exit;
}

?>