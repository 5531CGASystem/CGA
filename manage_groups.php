<?php
include "includes/head.php";

// Check connection
if($link == false) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(!isset($_GET['id'])){
        // redirect to show page
        die('id not provided');
    }
	
class Groupss
{
	public $group_id;
    public $name;
    public $capacity;
	public $leader_name;
	public $group_team;
}	
class Group_member {
	public $member_name;
	public $user_id;
	public $join_group_date;
	public $left_group_date;
}
$id = (int)$_GET['id'];
$result = mysqli_query($link,"SELECT * FROM rtc55314.groups where section_id='$id'");
$sql = mysqli_query($link,"SELECT section_name FROM sections WHERE section_id = '$id'");


$final_result = array();
$i=0;
while($row = mysqli_fetch_array($result)) 
{
	$final_result[$i] = new Groupss();
	$leader_id = $row['leader_id'];
	$group_id = $row['group_id'];
	$sql1 = mysqli_query($link,"SELECT username FROM users as u
JOIN rtc55314.groups as g on g.leader_id=u.user_id where g.leader_id='$leader_id' and g.group_id = '$group_id';");

    $sql22 = mysqli_query($link,"SELECT gu.user_id, username, join_group_date, left_group_date FROM rtc55314.group_users as gu JOIN rtc55314.users as us where group_id = '$group_id' and gu.user_id = us.user_id;");
$row3 = mysqli_fetch_array($sql1);
   $final_result[$i]->group_id = $row['group_id'];
   $final_result[$i]->name = $row['name'];
   $final_result[$i]->capacity = $row['capacity'];
   $final_result[$i]->leader_name = $row3[0];
   $group_members = array();
   $j=0;
   while ($roww = mysqli_fetch_array($sql22)) {
	   $group_members[$j]= new Group_member();
	   $group_members[$j]->member_name = $roww['username'];
	   $group_members[$j]->user_id = $roww['user_id'];
	   $group_members[$j]->join_group_date = $roww['join_group_date'];
	   $group_members[$j]->left_group_date = $roww['left_group_date'];
	   $j = $j+1;
   }
   $final_result[$i]->group_team = $group_members;
   $i = $i + 1;
}

$row2 = mysqli_fetch_array($sql);

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$group_id_Q = $_POST['group_id'];
	
	
	$sqlQ = "UPDATE rtc55314.groups SET leader_id = ? where group_id=$group_id_Q";
	
	if($stmtQ = mysqli_prepare($link, $sqlQ)){
		mysqli_stmt_bind_param($stmtQ, "i", $leader_id_update);
		$leader_id_update=$_POST['user_id'];
		if(mysqli_stmt_execute($stmtQ)){
			header("Refresh:0");
		} else{
                echo mysqli_stmt_error($stmtQ);
         }
		 
		 mysqli_stmt_close($stmtQ); 
	}
}

echo "
<div class='content'>
<h1>Section Name: $row2[0]</h1>
<h1>Groups:</h1>
</br>
<div  class='form-group'>
   <a href='create_group.php?id=$id'>
    <button style='background-color:pink'>Create New Group</button>
</a> 
</div>
</br></br>";
if(mysqli_num_rows($result)==0)
{
	echo "No group available under this course";
}
else
{

echo "<table border='3' >
<tr>
<th>Group_Name</th>
<th>Capacity</th>
<th>Leader_Name</th>
<th colspan='4'>Group_Members</th>
</tr>";

foreach($final_result as $rows)
{
echo "<tr style='padding:20px;'>";
echo "<td>" . $rows->name . "</td>";
echo "<td>" . $rows->capacity . "</td>";
echo "<td>" . $rows->leader_name . "</td>";

foreach($rows->group_team as $team_member) 
{
	
	echo "<td><strong>Member Name: </strong>".$team_member->member_name."</br><strong>Group Join date: </strong>".$team_member->join_group_date."</br><strong>Group Left date: </strong>".$team_member->left_group_date;
	echo "<form method='post' action=manage_groups.php?id=".$id.">";
	echo "<input type='submit' value='Choose as Group Leader'>";
	echo "<input type='hidden' value='".$team_member->user_id."' name='user_id'>";
	echo "<input type='hidden' value='".$rows->group_id."' name='group_id'>";
	echo "</form>";
	echo "</td>";
	
}
echo "</tr>";
echo "<td><a href='edit_group.php?id=".$rows->group_id."&section_id=".$id."'>Edit</a>/<a href='delete_group.php?id=".$rows->group_id."'>Delete</a></td>";
}

echo "</table>";
echo "</div>";
}
mysqli_close($link);
?>
