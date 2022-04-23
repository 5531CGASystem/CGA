<?php
// Author: 40196855
// Tester: 40186828

include('includes/head.php');
// Check if person does not have access
if (!isset($_SERVER['HTTP_REFERER'])) {
    // Redirect user back to previous page
    header("location: discussion_board.php");
    exit;
}

$total_responses = 0;
$options =  array();
if (isset($_GET['poll_id'])) {
    $poll_id = $_GET['poll_id'];
    $sql = "SELECT * FROM poll_questions WHERE id = '$poll_id'";
    $res = mysqli_query($link, $sql);
    if (mysqli_num_rows($res)) {
        $que = mysqli_fetch_assoc($res);
        $sql = "SELECT * FROM poll_options where question_id = '" . $que['id'] . "'";
        $opts = mysqli_query($link, $sql);
        if (!mysqli_error($link)) {
            while ($row = mysqli_fetch_assoc($opts)) {
                //echo $row['id'].'|'.'opt_'.$row['id'].'<br/>';
                $options['opt_' . $row['id']] = array('id' => $row['id'], 'option' => $row['option_text'], 'response' => 0);
            }
            $sql = "SELECT * FROM poll_responses where question_id = '" . $que['id'] . "'";
            $resp = mysqli_query($link, $sql);
            if (!mysqli_error($link)) {
                while ($row = mysqli_fetch_assoc($resp)) {
                    //echo $row['id'].'|'.'resp_'.$row['id'].'<br/>';
                    $options['opt_' . $row['option_id']]['response']++;
                    $total_responses++;
                }
            } else {
                echo mysqli_error($link);
                exit();
            }
        } else {
            echo mysqli_error($link);
            exit();
        }
    } else {
        echo 'Sorry! no information on this Poll!';
        echo mysqli_error($link);
        exit();
    }
}

?>
<style type="text/css">
    .option_name {
        padding: 4px 6px;
        font-size: 12px;
    }
</style>
<div class="content">
    <button><a href="discussion_board.php">Back</a></button>
    <form name="addPoll" method="POST" action="addAnswer.php" role="form">
        <div class="form-group">
            <h4><?php echo "Question: " . $que['question']; ?></h4>
        </div>
        <div>

            <?php
            //print_r($options);
            echo "<p> Total Responses: " . $total_responses . "</p>";
            foreach ($options as $option) {
                $class;
                if ($total_responses != 0)
                    $percent = $option['response'] / $total_responses * 100;
                else
                    $percent = 0;

            ?>

                <div class="progress" style="width: 100%; height: 30px; background-color:#ddd">
              
                    <div role="progressbar" aria-valuenow="<?php echo $percent ?>" aria-valuemin="0" aria-valuemax="100" style="background-color:darkseagreen;height: 30px; width: <?php echo $percent ?>%">
                    <span class="option_name" style="white-space: nowrap;">
                            <?php echo $option['option'] . " ";
                                echo $option['response'] . ' / ' . $total_responses  ?>
                        </span>
                    </div>
                </div>
                <br>
            <?php } ?>
        </div>
        <br />
    </form>
</div>

</body>

</html>