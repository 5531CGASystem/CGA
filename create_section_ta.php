<?php
//40197292
/* Database credentials. */
include "includes/head.php";

// Check connection
if($link == false) {
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
$sql = mysqli_query($link,"SELECT section_name FROM sections WHERE section_id = '$id'");
$row2 = mysqli_fetch_array($sql);
$query = "SELECT r.user_id,u.username FROM user_roles as r 
join users as u
on r.user_id=u.user_id 
and r.role_id=3";
    $result2 = mysqli_query($link, $query);
    $options = "";
          while($row2 = mysqli_fetch_array($result2))
         {
          $options = $options."<option value='$row2[0]'>$row2[1]</option>";
         }

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        
            // Prepare an insert statement
            $sql = "INSERT INTO ta_sections(ta_id, section_id) VALUES (?, ?)";
             if($sql == false) {
	           die("ERROR: Could not connect. " . mysqli_error());
                  }
			 
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ii",$param_ta_id,$param_section_id);
                
                // Set parameters
                $param_ta_id = $_POST["user_id"];
				$param_section_id = $section_id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
					header("location:manage_courses.php");
                   
                } else{
                    die('Error with execute: ' . htmlspecialchars($stmt->error));
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Section TA</title> 
	 <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body style="background-color:#faf0e6">
       <div class="wrapper">
        <h1>Associate TA</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$id; ?>" method="post">
			<div class="form-group">
			   <label>TAs</label>
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
    </div>
</div>

</body>
</html>
