<?php
// Page to add a student to section
// Author: 40197292
// Edited: 40215517

include "includes/head.php";

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
    header("location: manage_courses.php");
    exit;
}

$query = "SELECT user_id,username FROM users WHERE isactive=1 and user_id NOT IN(SELECT user_id FROM users_roles_sections WHERE section_id=$section_id AND (role_id=4 OR role_id=3 OR role_id=2))";
$result2 = mysqli_query($link, $query);
$options = "";
while($row2 = mysqli_fetch_array($result2)){
    $options = $options."<option value='$row2[0]'>$row2[1]</option>";
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

<h1>Associate User</h1>
<form action="<?php echo htmlspecialchars('includes/do_create_section_user.php')."?id=".$id; ?>" method="post">
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

