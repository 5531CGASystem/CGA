<?php
session_start();
include "./config.php";
$question = 0;
$option = 0;
if (isset($_POST['saveResponse'])) {
    $question = $_POST['question'];
    $option = $_POST['option'];
    $user_id = $_SESSION['id'];

    $sql = "SELECT * FROM poll_responses WHERE user_id = $user_id and question_id = $question";
    $res = mysqli_query($link, $sql);
    if (mysqli_num_rows($res) == 0) {
        $sql = "INSERT INTO `poll_responses`(`user_id`, `question_id`, `option_id`) VALUES ( $user_id, $question, $option )";
        mysqli_query($link, $sql);
        if (!mysqli_error($link)) {
            //header('Location:status.php?id=' . $question);
            $_SESSION['message'] = "Vote has been successfully casted.";
            // Redirect user back to previous page
            header("location: ../discussion_board.php");
            exit();
        } else {
            echo mysqli_error($link);
            $_SESSION['error'] = "Something went wrong please try again";
            // Redirect user back to previous page
            header("location: ../discussion_board.php");
            exit();
        }
        } else {
        $_SESSION['error'] = 'Sorry! You\'ve already voted for this poll!';
        header("location: ../discussion_board.php");
        exit();
    }
}
?>
