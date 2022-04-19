<?php
session_start();
include "./config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $mail_id = $link->real_escape_string(trim($_POST["delete"]));

    // Delete mail in mail_receivers sql table
    $sql = "UPDATE mail_receivers SET is_deleted=1 WHERE mail_id=$mail_id AND receiver_id=" . $_SESSION['id'];

    // Check whether delete statement works
    try{
        $link->query($sql);
        $_SESSION['message'] = "Mail has been successfully deleted.";
        // Redirect user back to previous page
        header("location: ../inbox.php");
        exit;
    }
    catch(Exception $e){
        $_SESSION['error'] = "Sorry, we have run into a database error. Please try again.<br><br>Error: " . $e;
        // Redirect user back to previous page
        header("location: ../mail.php");
        exit;
    }
}
else{
    // Redirect user to welcome page
    header("location: ../index.php");
    exit;
}

?>