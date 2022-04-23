<?php
// Author: 40196855
// Tester: 40186828

include "includes/head.php";

// Check if person does not have access
if (!isset($_SERVER['HTTP_REFERER'])) {
    // Redirect user back to previous page
    header("location: discussion_board.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $is_voted = false;
    if (isset($_POST['poll_id'])) {
        $poll_id = $_POST['poll_id'];
        $sql = "SELECT * FROM poll_questions WHERE id = $poll_id ";

        $res = mysqli_query($link, $sql);
        if (mysqli_num_rows($res)) {
            $que = mysqli_fetch_assoc($res);
            $sql = "SELECT * FROM poll_options where question_id = " . $que['id'];
            $res = mysqli_query($link, $sql);
            $options =  array();
            if (!mysqli_error($link)) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $options[] = array('id' => $row['id'], 'option' => $row['option_text']);
                }
                $sql1 = "SELECT option_id FROM poll_responses where user_id = " . $_SESSION["id"] . " and question_id = $poll_id;";
                $res1 = mysqli_query($link, $sql1);
                if (mysqli_num_rows($res1)) {
                    $response = mysqli_fetch_assoc($res1);
                    $is_voted = true; 
                    $voted_option_id = $response['option_id'];
                }
            } else {
                echo mysqli_error($link);
                exit();
            }
        } else {
            exit();
        }
    } else {
        exit();
    }
} else {
    exit();
}
?>

<div class=content>
<button><a href="discussion_board.php">Back</a></button>
    <form name="addPoll" method="POST" action="includes/do_add_vote.php" role="form">
        <div class="form-group">
            <h4><?php echo $que['question']; ?></h4>
            <input type="hidden" class="form-control" name="question" id="question" value="<?php echo $que['id']; ?>" />
        </div>
        <div>
            <?php foreach ($options as $option) { ?>
                <div class="input-group">
                    <span class="input-group-addon">
                        <input type="radio" name="option" <?php if($is_voted) echo 'disabled '; ?> <?php if($is_voted && $option['id'] == $voted_option_id) echo 'checked ';?>      value="<?php echo $option['id']; ?>">
                    </span>
                    <input type="text" class="form-control" readonly="" value="<?php echo $option['option']; ?>">
                </div><!-- /input-group -->
                <br />
            <?php } ?>
        </div>
        <br />
        <div>
            <button class="btn btn-primary" <?php if($_SESSION['role_id']< 4 || $que["end_date"]<date("Y-m-d")) echo 'disabled '; ?> type="submit" name="saveResponse">Submit</button>
            <?php if($_SESSION['role_id']< 4) echo "<p> <font color=\"red\">Note: Admin/Instructors/TAs cannot participate in a poll</font></p>"; ?>
            <?php if($que["end_date"]<date("Y-m-d")) echo "<p> <font color=\"red\">Note: Poll is expired</font></p>"; ?>
            <?php if($_SESSION['role_id']< 4 || $que["user_id"] == $_SESSION['id'] || $que["end_date"]<date("Y-m-d")) echo "<p><a href=poll_status.php?poll_id=" . $poll_id .">View Results</a></p>"; ?>
        </div>
    </form>
</div>

</body>

</html>