<?php
session_start();
include "./config.php";

if (isset($_POST['savePoll'])) {
    $que = trim($_POST['question']);
	$category_id = trim($_POST["category"]);
	$sql = "INSERT INTO `poll_questions`( `question`,`user_id` ,`end_date`,`category_id`) VALUES ('$que', " . $_SESSION['id'] . ",'" . date($_POST['due_date']) . "'," . $category_id . ")";
	mysqli_query($link, $sql);
	if (!mysqli_error($link)) {
		$que_id = mysqli_insert_id($link);

		$options = array();
		foreach ($_POST['option'] as $option) {
			$options[] = "( $que_id, '" . mysqli_real_escape_string($link, $option) . "')";
		}
		$sql = "INSERT INTO `poll_options`( `question_id`, `option_text`) VALUES  " . implode(',', $options);
		mysqli_query($link, $sql);
		if (!mysqli_error($link)) {

			$_SESSION['message'] = "Poll has been successfully posted.";
			header("location: ../discussion_board.php");
			exit();
		} else {
			echo mysqli_error($link);
		}
	} else {
		echo mysqli_error($link);
	}
}
