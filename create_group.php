<?php
//40197292
include "includes/head.php";

// Check connection
if ($link == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
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
		

$name ="";
$capacity =0;
$leader_id=0;
$name_error = "";
$capacity_error="";
$options = "";
	$sql11=mysqli_query($link,"SELECT user_id, username from users where user_id IN(SELECT user_id FROM rtc55314.users_sections where section_id = $id and user_id not in 
(select user_id from group_users where group_id IN (select group_id from rtc55314.groups where section_id = $id)))");

while($row = mysqli_fetch_array($sql11))
{
	$options = $options."<option value='$row[0]'>$row[1]</option>";
}
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        //check capacity
		if (sizeof($_POST['leader_id']) > $_POST["capacity"]) {
			$capacity_error="Selected count of members is greater than capacity";
		}
		//$options = fetchUsers();
        // Check if course_name is empty
        if(empty(trim($_POST["name"]))){
            $name_error = "Group name cannot be empty.";
        } else{
            // Prepare a select statement
            $sql = "SELECT group_id FROM rtc55314.groups WHERE name = ?";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                // Link - https://www.php.net/manual/en/mysqli-stmt.bind-param.php
                mysqli_stmt_bind_param($stmt, "s", $param_name);
                
                // Set parameters
                $param_name = trim($_POST["name"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $name_error = "This group already exists.";
                    } else{
                        $name = trim($_POST["name"]);  
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
            //$course = trim($_POST["course_name"]);
        }
        if(empty($name_error) && empty($capacity_error)){
        
            // Prepare an insert statement
            $sql = "INSERT INTO rtc55314.groups(name, capacity, leader_id, section_id) VALUES (?, ?, ?, ?)";
             
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
					$sql12 = mysqli_query($link,"SELECT group_id FROM rtc55314.groups where section_id='$section_id' and name='$param_name';");
				
				    $group_id = 0;
					while($row323 = mysqli_fetch_array($sql12)){
					   $group_id = $row323[0];
					}
                    // Redirect to login page
					$sql1111 = "INSERT INTO rtc55314.group_users(user_id, group_id, join_group_date, left_group_date) VALUES (?, ?, ?, ?)";
					foreach($_POST["leader_id"] as $us_id) {
						if($stmt11 = mysqli_prepare($link, $sql1111)){
							mysqli_stmt_bind_param($stmt11, "iiss", $param_user_id,$param_group_id,$param_join_group_date,$param_left_group_date);
							
							// Set parameters
							$param_user_id = $us_id;
							$param_group_id = $group_id;
							$param_join_group_date = date("Y-m-d h:m:s");
							$param_left_group_date = null;
							mysqli_stmt_execute($stmt11);
							//echo "amit ". $us_id." ii ".$group_id." ii ".$param_join_group_date." ii ".$param_left_group_date;
							mysqli_stmt_close($stmt11);
							
						}
					}
					header("location:manage_courses.php");
                   
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
			
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Group</title> 
	 <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body style="background-color:#faf0e6">
     <?php 
        if(!empty($name_error)){
            echo '<div class="alert alert-danger">' . $name_error . '</div>';
        }    
        ?>
       <div class="wrapper">
        <h1>Create a Group</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$id; ?>" method="post">
        <div class="form-group">
                <label>Group Name<font color='red'> *</font></label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
               <span style='display: block;'><?php echo $name_error; ?></span>
            </div> 
			</br>
			 <div class="form-group">
                <label>Capacity<font color='red'> *</font></label>
                 <input type="number" name="capacity" class="form-control" value="<?php echo $capacity; ?>">
            </div>   
            </br>
			 <div class="form-group">
			     <label>Members</label>
			     <select multiple="multiple" name="leader_id[]" id="leader_id" class="form-control">
                  <?php echo $options;?>
                  </select>
				   <span style='display: block;'><?php echo $capacity_error; ?></span>
		    </div>
		    </br>
			 <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <div class="form-group">
                <input type="submit" style='background-color:pink' value="Submit">
            </div>
        </form>
     </div>
    </div>
</div>

</body>
</html>
