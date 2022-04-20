<?php
//40197292
include "includes/head.php";

// Check connection
if ($link == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(!isset($_GET['id'])){
        // redirect to show page
        die('id not provided');
    }
$id = (int)$_GET['id'];
$section_id = (int)$_GET['section_id'];
 $sql = "SELECT * FROM `groups` where group_id = '$id'";
 
    $result = $link->query($sql);
	
    if($result->num_rows != 1){
        // redirect to show page
        die('id is not in db');
    }
    $data = $result->fetch_assoc();

$leader_id=0;


$options = "";
$current_options = "";
	$sql11=mysqli_query($link,"SELECT user_id, username from users where user_id IN(SELECT user_id FROM `users_roles_sections` where section_id = $section_id and role_id=4 and user_id not in 
(select DISTINCT user_id from group_users where left_group_date is null and group_id IN (select group_id from `groups` where section_id = $section_id)))");

$sql112=mysqli_query($link,"SELECT user_id, username from users where user_id IN (SELECT user_id from group_users where group_id=$id)");

while($row = mysqli_fetch_array($sql11))
{
	$options = $options."<option value='$row[0]'>$row[1]</option>";
}

while($row = mysqli_fetch_array($sql112))
{
	$options = $options."<option value='$row[0]'>$row[1]</option>";
	$current_options = $current_options."<option value='$row[0]'>$row[1]</option>";
}
// // Processing form data when form is submitted
// if($_SERVER["REQUEST_METHOD"] == "POST"){
//         //check capacity
// 		if (sizeof($_POST['leader_id'])!=0 && sizeof($_POST['leader_id']) > $_POST["capacity"]) {
// 			$capacity_error="Selected count of members is greater than capacity or select atleast one member";
// 		}
		
//         if(empty($name_error) && empty($capacity_error)){
//         //Delete from group_users where group_id = $id;
//             // Prepare an insert statement
//             $sql = "UPDATE `groups` SET name=?, capacity=?, leader_id=?, section_id=? WHERE group_id='$id'";
             
//             if($stmt = mysqli_prepare($link, $sql)){
//                 // Bind variables to the prepared statement as parameters
//                 mysqli_stmt_bind_param($stmt, "siii", $param_name,$param_capacity,$param_leader_id,$param_section_id);
                
//                 // Set parameters
//                 $param_name = trim($_POST["name"]);
//                 $param_capacity = $_POST["capacity"];
// 				$param_leader_id = $_POST["leader_id"][0]; 
// 				$param_section_id = $section_id;
				
                
//                 // Attempt to execute the prepared statement
//                 if(mysqli_stmt_execute($stmt)){
					
//                     $sqlDeleteQuery="DELETE FROM `group_users` WHERE group_id='$id'";
// 					if ($link->query($sqlDeleteQuery) === TRUE)
// 					{
// 					 $sql1111 = "INSERT INTO `group_users` (user_id, group_id, join_group_date, left_group_date) VALUES (?, ?, ?, ?) ";
// 					 foreach($_POST["leader_id"] as $us_id) {
// 						if($stmt11 = mysqli_prepare($link, $sql1111)){
// 							mysqli_stmt_bind_param($stmt11, "iiss", $param_user_id,$param_group_id,$param_join_group_date,$param_left_group_date);
							
// 							// Set parameters
// 							$param_user_id = $us_id;
// 							$param_group_id = $id;
// 							$param_join_group_date = date("Y-m-d h:m:s");
// 							$param_left_group_date = null;
// 							mysqli_stmt_execute($stmt11);
// 							//echo . $us_id." ii ".$group_id." ii ".$param_join_group_date." ii ".$param_left_group_date;
// 							mysqli_stmt_close($stmt11);
							
// 						}
// 					 }
// 					}
// 					//header("location:manage_courses.php");
                   
//                 } else{
//                     echo "Oops! Something went wrong. Please try again later.";
//                 }
//                 // Close statement
//                 mysqli_stmt_close($stmt);
//             }
			
//         }
// }
?>
     <?php 
        if(!empty($name_error)){
            echo '<div class="alert alert-danger">' . $name_error . '</div>';
        }    
        ?>
       <div class="content">

        <?php
        // Display success/error message
        if (isset($_SESSION['message'])){
        echo "<font color='blue'>".$_SESSION['message']."</font>";
        unset($_SESSION['message']);
        }
        if (isset($_SESSION['error'])){
            echo "<font color='red'>".$_SESSION['error']."</font>";
            unset($_SESSION['error']);
        }
        ?>
        
        <h1>Edit Group</h1>
        <form action="<?php echo htmlspecialchars('includes/do_edit_group.php')."?id=".$id."&section_id=".$section_id; ?>" method="post">
        <div class="form-group">
                <label>Group Name<font color='red'> *</font></label>
                <input type="text" name="name" readonly class="form-control" value="<?= $data['name']?>">
            </div> 
			</br>
			 <div class="form-group">
                <label>Capacity<font color='red'> *</font></label>
                 <input type="text" name="capacity" class="form-control" value="<?= $data['capacity']?>">
            </div>   
            </br>
			 <div class="form-group">
			     <label>New Members</label>
				 <span style='display: block; font-size:10px; color:red;'>*Select all want in group</span>
			     <select multiple="multiple" name="leader_id[]" id="leader_id" class="form-control">
                  <?php echo $options;?>
                  </select>
		    </div>
			</br>
			<div class="form-group">
			<label>Current Members</label>
			<select readonly class="form-control">
			<?php echo $current_options;?>
			</select>
			</div>
		    </br>
			 <input type="hidden" name="id" value="<?php echo $id; ?>" />
			 <input type="hidden" name="section_id" value="<?php echo $section_id; ?>" />
            <div class="form-group">
                <input type="submit" style='background-color:pink' value="Submit">
            </div>
        </form>
     </div>
    </div>
</div>

</body>
</html>
