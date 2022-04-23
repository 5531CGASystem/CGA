<?php
// Author: 40196855
// Tester: 40186828

session_start();
include "./config.php";

if (isset($_POST['savePoll'])) {
    $que = trim($_POST['question']);
	$category_id = trim($_POST["category"]);
	$sql1 = "INSERT INTO `poll_questions`( `question`,`user_id` ,`end_date`,`category_id`) VALUES ('$que', " . $_SESSION['id'] . ",'" . date($_POST['due_date']) . "'," . $category_id . ")";
	mysqli_query($link, $sql1);
	if (!mysqli_error($link)) {
		$que_id = mysqli_insert_id($link);

		$options = array();
		foreach ($_POST['option'] as $option) {
			$options[] = "( $que_id, '" . mysqli_real_escape_string($link, $option) . "')";
		}
		$sql2 = "INSERT INTO `poll_options`( `question_id`, `option_text`) VALUES  " . implode(',', $options);
		mysqli_query($link, $sql2);
		if (!mysqli_error($link)) {

			$_SESSION['message'] = "Poll has been successfully posted.";
			header("location: ../discussion_board.php");
			// Log
			$f_sql = addslashes($sql1);
			$link->query("SET FOREIGN_KEY_CHECKS=0");
			$link->query("INSERT INTO marked_entities_log (marked_entity_id, user_id, fname, lname, query, log_time) VALUES (" . $_SESSION['entity_id'] . ", " . $_SESSION['id'] . ", '" . $_SESSION['fname'] . "', '" . $_SESSION['lname'] . "', '$f_sql', SYSDATE())");
			$link->query("SET FOREIGN_KEY_CHECKS=1");
			exit();
		} else {
			echo mysqli_error($link);
		}
	} else {
		echo mysqli_error($link);
	}
}
