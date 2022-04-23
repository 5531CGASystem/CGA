<?php
// Page to create a course
// Author: 40197292
// Edited: 40215517 & 40196855
// Tester: 40186828

session_start();
include './config.php';
$course_name = $code = $term = $year = $course_desc = $start_date = $end_date = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prepare a select statement
    $sql = "SELECT course_id FROM courses WHERE course_name = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_course_name);

        // Set parameters
        $param_course_name = trim($_POST["course_name"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                $_SESSION['course_error'] = "This course already exists.";
                header("location:../create_course.php");
                exit;
            } else {
                $course_name = trim($_POST["course_name"]);
            }
        } else {
            $_SESSION['course_error'] = "Oops! Something went wrong. Please try again later.";
            header("location:../create_course.php");
            exit;
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Prepare an insert statement
    $sql = "INSERT INTO courses(course_name,code, term, year, course_desc, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssss", $param_course_name, $param_code, $param_term, $param_year, $param_course_desc, $param_start_date, $param_end_date);

        // Set parameters
        $param_course_name = trim($_POST["course_name"]);
        $param_code = trim($_POST["code"]);
        $param_term = trim($_POST["term"]);
        $param_year = trim($_POST["year"]);
        $param_course_desc = trim($_POST["course_desc"]);
        $param_start_date = $_POST["start_date"];
        $param_end_date = $_POST["end_date"];


        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Course has been added successfully!";
            header("location:../manage_courses.php");
        } else {
            $_SESSION['course_error'] = "Oops! Something went wrong. Please try again later.";
            header("location:../create_course.php");
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
}
else{
    header("location:../manage_courses.php");
    exit;
}
