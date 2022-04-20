<?php
session_start();
include "./config.php";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $section_id = $id;

    // Prepare an insert statement
    $sql = "INSERT INTO users_roles_sections(user_id, section_id, role_id) VALUES (?, ?,?)";
    if ($sql == false) {
        die("ERROR: Could not connect. " . mysqli_error($link));
    }

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "iii", $param_ta_id, $param_section_id, $param_role_id);

        // Set parameters
        $param_ta_id = $_POST["user_id"];
        $param_section_id = $section_id;
        $param_role_id = 3;

        // Attempt to execute the prepared statement
        
        try{

        
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to previous page
            $_SESSION['message'] = "TA has been added successfully!!";
            header("location:../manage_section_tas.php?id=$section_id");
            exit;
        } else {

            $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
            header("location:../create_section_ta.php?id=$id");
            exit;
        }}catch(Exception $e){
            $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
            header("location:../create_section_ta.php?id=$id");
            exit;
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
}
