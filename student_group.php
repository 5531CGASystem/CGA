<?php
//Author:
//40197292
include "includes/head.php";
?>

<div class='content'>

<button><a href="index.php">Back</a></button>
<p></p>

<h1><?php echo "Your Group Information"; ?></h1>
<p></p>
<hr>
<p></p>

<?php
$data = $link->query("SELECT g.group_id FROM group_users gu JOIN `groups` g ON g.group_id=gu.group_id WHERE gu.left_group_date IS NULL AND g.section_id=" . $_SESSION['section_id'] . " AND gu.user_id=" . $_SESSION['id']);
if ($data->num_rows > 0) {
    $group_data = $data->fetch_assoc();
    $group_id = $group_data['group_id'];
    $data2 = $link->query("SELECT * FROM `groups` g JOIN group_users gu ON g.group_id=gu.group_id WHERE gu.left_group_date IS NULL AND g.group_id=$group_id ORDER BY g.group_id");
    if ($data2->num_rows > 0) {
        $groups_checked = array();
        while ($row2 = mysqli_fetch_array($data2, MYSQLI_NUM)) {
            $group_id = $row2[0];
            $user_id = $row2[5];
            $data3 = $link->query("SELECT username FROM users WHERE user_id=$user_id");
            if ($data3->num_rows > 0) {
                $user_data = $data3->fetch_assoc();
                $username = $user_data['username'];
            }
            if (in_array($group_id, $groups_checked)){
                $join_group_date = $row2[7];
                echo "<tr><td>$username</td><td>$join_group_date</td></tr>";
            }
            else{
                $leader_id = $row2[4];
                $data4 = $link->query("SELECT username FROM users WHERE user_id=$leader_id");
                if ($data4->num_rows > 0) {
                    $leader_data = $data4->fetch_assoc();
                    $group_leader = $leader_data['username'];
                }

                $group_name = $row2[2];
                $capacity = $row2[3];
                $join_group_date = $row2[7];
                echo "Group Name: $group_name<br>";
                echo "Leader: $group_leader<br>";
                echo "Capacity Limit: $capacity<p></p>";
                echo "<table><tbody><tr><th>Members</th><th>Joined Group On</th></tr>";
                echo "<tr><td>$username</td><td>$join_group_date</td></tr>";
                array_push($groups_checked, $group_id);
            }
        }
        echo "</tbody></table><br>";

        // Request leader change
        $data5 = $link->query("SELECT u.username FROM users u JOIN sections s ON u.user_id=s.prof_id WHERE prof_id=(SELECT prof_id FROM sections WHERE section_id=" . $_SESSION['section_id'] . ")");
        if ($data5->num_rows > 0) {
            $prof_data = $data5->fetch_assoc();
            $prof_un = $prof_data['username'];
        }
        echo "<a href='compose_mail.php?to=$prof_un'>Request Leader Change</a>";
    }
}
else{
    echo "No group information to be displayed";
    exit;
}

?>