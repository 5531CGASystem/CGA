<?php
//40197292
include "includes/head.php";

$id=0;
$section_id=0;
 if(isset($_POST['submit']))
        {  
	$id =$_POST["id"];
	$section_id=$id;
		}
		else{
			$id = (int)$_GET['id'];
			$section_id=$id;
		}
//$sql = mysqli_query($link,"SELECT section_name FROM sections WHERE section_id = '$id'");
//$row2 = mysqli_fetch_array($sql);
$query = "SELECT user_id,username FROM users";
$result2 = mysqli_query($link, $query);
$options = "";
while($row2 = mysqli_fetch_array($result2)){
    $options = $options."<option value='$row2[0]'>$row2[1]</option>";
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
                    // Redirect to login page
					header("location:manage_section_users.php?id=$id");
                   
                } else{
                    die('Error with execute: ' . htmlspecialchars($stmt->error));
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
}

?>
       <div class="content">
        <h1>Associate User</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$id; ?>" method="post">
			<div class="form-group">
			   <label>Users</label>
			    <select name="user_id" id="user_id" class="form-control">
                 <?php echo $options;?>
                 </select>
		     </div>
		</br>
	        <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="form-group">
                <input type="submit" name="submit" style='background-color:pink' value="Submit">
            </div>
        </form>
     </div>

