<?php 
session_start();
include "./config.php";

if(!isset($_GET['id'])){
    // redirect to show page
    die('id not provided');
}
$id = (int)$_GET['id'];
$section_id = (int)$_GET['section_id'];

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        //check capacity
		if (sizeof($_POST['leader_id'])!=0 && sizeof($_POST['leader_id']) > $_POST["capacity"]) {
			$capacity_error="Selected count of members is greater than capacity or select atleast one member";
		}
		
        if(empty($name_error) && empty($capacity_error)){
        //Delete from group_users where group_id = $id;
            // Prepare an insert statement
            $sql = "UPDATE `groups` SET name=?, capacity=?, leader_id=?, section_id=? WHERE group_id='$id'";
             
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "siii", $param_name,$param_capacity,$param_leader_id,$param_section_id);
                
                // Set parameters
                $param_name = trim($_POST["name"]);
                $param_capacity = $_POST["capacity"];
				$param_leader_id = $_POST["leader_id"][0]; 
				$param_section_id = $section_id;
				
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
					
                    $sqlDeleteQuery="DELETE FROM `group_users` WHERE group_id='$id'";
					if ($link->query($sqlDeleteQuery) === TRUE)
					{
					 $sql1111 = "INSERT INTO `group_users` (user_id, group_id, join_group_date, left_group_date) VALUES (?, ?, ?, ?) ";
					 foreach($_POST["leader_id"] as $us_id) {
						if($stmt11 = mysqli_prepare($link, $sql1111)){
							mysqli_stmt_bind_param($stmt11, "iiss", $param_user_id,$param_group_id,$param_join_group_date,$param_left_group_date);
							
							// Set parameters
							$param_user_id = $us_id;
							$param_group_id = $id;
							$param_join_group_date = date("Y-m-d h:m:s");
							$param_left_group_date = null;
							mysqli_stmt_execute($stmt11);
							//echo . $us_id." ii ".$group_id." ii ".$param_join_group_date." ii ".$param_left_group_date;
							mysqli_stmt_close($stmt11);
							
						}
					 }
					}
                    $_SESSION['message'] = "Group has been edited successfully!!";
					header("location:../manage_groups.php?id=$section_id");
                    exit;
                   
                } else{
                    $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
					header("location:../edit_group.php?id=$id");
                    exit;
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
			
        }
}
?>