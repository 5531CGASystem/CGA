<?php 
session_start();
include "./config.php";

$id=0;
$section_id=0;
if(isset($_POST['submit'])){  
	$id =$_POST["id"];
	$section_id=$id;
}
else{
	$id = (int)$_GET['id'];
	$section_id=$id;
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
            $rolesql = "SELECT * from roles where role_name = 'student'";
            $roledata = $link -> query($rolesql);
            $rolerow = mysqli_fetch_assoc($roledata);
            $role_id = $rolerow['role_id'];
            // Prepare an insert statement
            $sql = "INSERT INTO users_roles_sections(user_id, section_id, role_id) VALUES (?, ?, ?)";
             if($sql == false) {
	           die("ERROR: Could not connect. " . mysqli_error($link));
                  }
			 
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "iii",$param_user_id,$param_section_id,$param_role_id);
                
                // Set parameters
                $param_user_id = $_POST["user_id"];
				$param_section_id = $section_id;
                $param_role_id = $role_id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $_SESSION['message'] = "Added student successfully!!";
                    // Redirect to login page
					header("location:../manage_section_users.php?id=$id");
                    exit;
                   
                } else{
                    $_SESSION['error'] = "Error with execute: " . htmlspecialchars($stmt->error);
                    header("location:../create_section_user.php?id=$id");
                    exit;
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
}

?>