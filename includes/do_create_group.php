<?php 
// Helper to create a group
// Author: 40197292
// Edited: 40215517

session_start();
include "./config.php";

//processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $section_id = $id;

    //check capacity
    if (sizeof($_POST['leader_id']) > $_POST["capacity"]) {
        $_SESSION['error'] = "Selected count of members is greater than capacity";
        header("location:../create_group.php?id=$section_id");
        exit;
    }

    // Prepare a select statement
    $sql = "SELECT group_id FROM `groups` WHERE name = ? and section_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "si", $param_name, $id);

        // Set parameters
        $param_name = trim($_POST["name"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Redirect to previous page
                $_SESSION['error'] = "This group already exists.";
                header("location:../create_group.php?id=$section_id");
                exit;
            } else {
                $name = trim($_POST["name"]);
            }
        } else {
            // Redirect to previous page
            $_SESSION['error'] = "Oops! Something went wrong. Please try again later.";
            header("location:../create_group.php?id=$section_id");
            exit;
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Prepare an insert statement
    $sql = "INSERT INTO `groups` (name, capacity, leader_id, section_id) VALUES (?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "siii", $param_name, $param_capacity, $param_leader_id, $param_section_id);

        // Set parameters
        $param_name = trim($_POST["name"]);
        $param_capacity = $_POST["capacity"];
        $param_leader_id = $_POST["leader_id"][0];
        $param_section_id = $section_id;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $sql12 = mysqli_query($link, "SELECT group_id FROM `groups` where section_id='$section_id' and name='$param_name';");

            $group_id = 0;
            while ($row323 = mysqli_fetch_array($sql12)) {
                $group_id = $row323[0];
            }
            // Redirect to login page
            $sql1111 = "INSERT INTO `group_users` (user_id, group_id, join_group_date, left_group_date) VALUES (?, ?, ?, ?)";
            foreach ($_POST["leader_id"] as $us_id) {
                if ($stmt11 = mysqli_prepare($link, $sql1111)) {
                    mysqli_stmt_bind_param($stmt11, "iiss", $param_user_id, $param_group_id, $param_join_group_date, $param_left_group_date);

                    // Set parameters
                    $param_user_id = $us_id;
                    $param_group_id = $group_id;
                    $param_join_group_date = date("Y-m-d h:m:s");
                    $param_left_group_date = null;
                    mysqli_stmt_execute($stmt11);
                    mysqli_stmt_close($stmt11);
                }
            }
            $_SESSION['message'] = "Group created successfully!!";
            // Redirect user back to previous page
            header("location:../manage_groups.php?id=" . $id);
        } else {
            $_SESSION['error'] = "Error: " . $link->error;
            // Redirect user back to previous page
            header("location: ../create_group.php?id=$id");
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
}
else{
    header("location: ../manage_courses.php");
    exit;
}
?>