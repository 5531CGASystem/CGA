<?php
// Page to create a group
// Author: 40197292
// Edited: 40215517 & 40196855
// Tester: 40186828

include "includes/head.php";

$id=0;
$section_id=0;

// Check if person does not have access
if ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2) {
    // Redirect user back to previous page
    header("location: index.php");
    exit;
}

if(isset($_POST['submit'])){  
    $id =$_POST["id"];
    $section_id=$id;
}
elseif(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $section_id=$id;
}
else{
    $_SESSION['error'] = "Invalid link.";
    header("location: manage_courses.php");
    exit;
}
		
$name ="";
$capacity =0;
$leader_id=0;
$name_error = "";
$capacity_error="";
$options = "";
$sql11=mysqli_query($link,"SELECT user_id, username from users where user_id IN(SELECT user_id FROM `users_roles_sections` where section_id = $id and role_id = 4 and user_id not in 
(select DISTINCT user_id from group_users where left_group_date is null and group_id IN (select group_id from `groups` where section_id = $id)))");

while($row = mysqli_fetch_array($sql11)){
	$options = $options."<option value='$row[0]'>$row[1]</option>";
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

<h1>Create a Group</h1>
<form action="<?php echo htmlspecialchars('includes/do_create_group.php')."?id=".$id; ?>" method="post">
<div class="form-group">
    <label>Group Name<font color='red'> *</font></label>
    <input type="text" name="name" class="form-control" maxlength=45 value="<?php echo $name; ?>" required>
    </div> 
    </br>
    <div class="form-group">
        <label>Capacity<font color='red'> *</font></label>
        <input type="number" name="capacity" class="form-control" value="<?php echo $capacity; ?>" required>
    </div>   
    </br>
    <div class="form-group">
        <label>Members<font color='red'> *</font></label>
        <span style='display: block; font-size:10px; color:red;'>Hold shift to select multiple members.</span>
        <select multiple="multiple" name="leader_id[]" id="leader_id" class="form-control" required>
        <?php echo $options;?>
        </select>
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
