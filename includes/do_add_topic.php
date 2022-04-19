<?php
session_start();
include "./config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $link->real_escape_string(trim($_POST["title"]));
    $category_id = $link->real_escape_string(trim($_POST["category"]));
    $text = $link->real_escape_string(trim($_POST["text"]));

    // Insert data into forum_topics and forum_replies sql table
    $link->autocommit(false);
    $sql1 = "INSERT INTO forum_topics (title, category_id, date, topic_by) VALUES ('$title', $category_id, SYSDATE(), " . $_SESSION['id'] . ")";
    try {
        $link->query($sql1);
        $topic_id = $link->insert_id;
    } catch (Exception $e) {
        $_SESSION['error'] = "Sorry, we have run into a database error. Please try again.<p></p>Error: " . $e;
        // Redirect user back to previous page
        $link->rollback();
        $link->autocommit(true);
        header("location: ../add_topic.php");
        exit;
    }

    $sql2 = "INSERT INTO forum_replies (topic_id, text, date, reply_by) VALUES ($topic_id, '$text', SYSDATE(), " . $_SESSION['id'] . ")";

    // Check whether both insert statements work
    try {
        if ($link->query($sql2) === TRUE) {
            $op_id = $link->insert_id;
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Sorry, we have run into a database error. Please try again.<p></p>Error: " . $e;
        $link->rollback();
        $link->autocommit(true);
        // Redirect user back to previous page
        header("location: ../add_topic.php");
        exit;
    }


    // Start autocommit
    try {

        // Upload file module
        $target_dir = "../uploads/";

        if (!empty($_FILES) && $_FILES['fileToUpload']['size'] > 0) {
            $UUID = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
            $target_file_name =  $UUID . basename($_FILES["fileToUpload"]["name"]);
            $target_file = $target_dir . $target_file_name;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 1000000) {
                $_SESSION['error'] = "Sorry, your file is too large.";
                // Redirect user back to previous page
                header("location: ../add_topic.php");
                exit;
            }

            // Allow certain file formats
            if (!strcasecmp($fileType, "pdf") &&  !strcasecmp($fileType, "zip")) {
                $_SESSION['error'] = "Sorry, only pdf or zip files are allowed.";
                // Redirect user back to previous page
                header("location: ../add_topic.php");
                exit;
            }

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $sql3 = "INSERT INTO reply_attachments (file_name, file_location, uploaded_by, reply_id) VALUES (" . "'" . mysqli_real_escape_string($link, basename($_FILES['fileToUpload']['name'])) . "', '" .  mysqli_real_escape_string($link, $target_file_name) . "', " . $_SESSION['id'] . ", " . $op_id . " )";

                if ($link->query($sql3) === TRUE) {
                    $link->commit();
                    $link->autocommit(true);
                    $_SESSION['message'] = "Topic has been successfully posted.";
                    header("location: ../discussion_board.php");
                } else {
                    $_SESSION['error'] = "Sorry, we have run into a database error. Please try again.<p></p>Error: " . $sql . "<br>" . $link->error;
                    $link->rollback();
                    $link->autocommit(true);
                    // Redirect user back to previous page
                    header("location: ../add_topic.php");
                    exit;
                }
            } else {
                $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                $link->rollback();
                $link->autocommit(true);
                // Redirect user back to previous page
                header("location: ../add_topic.php");
                exit;
            }
        } else {
            $link->commit();
            $link->autocommit(true);
            $_SESSION['message'] = "Topic has been successfully posted.";
            header("location: ../discussion_board.php");
        }
    } catch (Exception $e) {

        $_SESSION['error'] = "Sorry, we have run into a database error. Please try again.<p></p>Error: " . $e;
        $link->rollback();
        $link->autocommit(true);
        // Redirect user back to previous page
        header("location: ../add_topic.php");
        exit;
    }

    // Log
    $f_sql = addslashes($sql1);
    $link->query("INSERT INTO marked_entities_log (marked_entity_id, user_id, fname, lname, query, log_time) VALUES (" . $_SESSION['entity_id'] . ", " . $_SESSION['id'] . ", '" . $_SESSION['fname'] . "', '" . $_SESSION['lname'] . "', '$f_sql', SYSDATE())");
} else {
    // Redirect user to welcome page
    header("location: ../index.php");
    exit;
}
