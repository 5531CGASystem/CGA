<?php
// Page to create a group
// Author: 40197292
// Edited: 40215517

include "includes/head.php";

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

$id = (int)$_GET['id'];
$section_id = (int)$_GET['section_id'];
$sql = "SELECT * FROM `groups` where group_id = '$id'";
$result = $link->query($sql);
	
if($result->num_rows != 1){
    $_SESSION['error'] = "Invalid link.";
    header("location: manage_courses.php");
    exit;
}
$data = $result->fetch_assoc();

$leader_id=0;


$options = "";
$current_options = "";
$sql11=mysqli_query($link,"SELECT user_id, username from users where user_id IN(SELECT user_id FROM `users_roles_sections` where section_id = $section_id and role_id=4 and user_id not in 
(select DISTINCT user_id from group_users where left_group_date is null and group_id IN (select group_id from `groups` where section_id = $section_id)))");

$sql112=mysqli_query($link,"SELECT user_id, username from users where user_id IN (SELECT user_id from group_users where group_id=$id and left_group_date is null)");

while($row = mysqli_fetch_array($sql11)){
	$options = $options."<option value='$row[0]'>$row[1]</option>";
}

while($row = mysqli_fetch_array($sql112)){
	$options = $options."<option value='$row[0]'>$row[1]</option>";
	$current_options = $current_options."<option value='$row[0]'>$row[1]</option>";
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
    <input type="text" name="name" readonly class="form-control" maxlength=45 value="<?= $data['name']?>" required>
    </div> 
    </br>
        <div class="form-group">
        <label>Capacity<font color='red'> *</font></label>
        <input type="number" name="capacity" class="form-control" value="<?= $data['capacity']?>" required>
    </div>   
    </br>
    <div class="form-group">
        <label>New Members<font color='red'> *</font></label>
        <span style='display: block; font-size:10px; color:red;'>Select all people in the group. Hold shift to select multiple members.</span>
        <select multiple="multiple" name="leader_id[]" id="leader_id" class="form-control" required>
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
