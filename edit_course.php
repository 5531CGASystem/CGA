<?php 
//40197292
/* Database credentials. */
define('DB_SERVER', 'rtc5531.encs.concordia.ca');
define('DB_USERNAME', 'rtc55314');
define('DB_PASSWORD', 'khbbmG');
define('DB_NAME', 'rtc55314');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link == false) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
$id = (int)$_GET['id'];
$course_error = "";
$sql1 = "SELECT * FROM courses where course_id = '$id'";
    $result = $link->query($sql1);
    if($result->num_rows != 1){
        // redirect to show page
        die('id is not in db');
    }
    $data = $result->fetch_assoc();
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Check if course_name is empty
        if(empty(trim($_POST["course_name"]))){
            $course_error = "Course name cannot be empty.";
        } else{
            // Prepare a select statement
            $sql = "SELECT course_id FROM courses WHERE course_name = ? and course_id!=$id";
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                // Link - https://www.php.net/manual/en/mysqli-stmt.bind-param.php
                mysqli_stmt_bind_param($stmt, "s", $param_course_name);
                
                // Set parameters
                $param_course_name = trim($_POST["course_name"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $course_error = "This course already exists.";
                    } else{
                        $course_name = trim($_POST["course_name"]);  
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
            //$course = trim($_POST["course_name"]);
        }
        if(empty($course_error)){
        
            // Prepare an insert statement
            $sql = "UPDATE courses SET course_name=?,code=?, term=?, year=?, course_desc=?, start_date=?, end_date=? WHERE course_id=$id";
             
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssssss", $param_course_name,$param_code,$param_term,$param_year,$param_course_desc,$param_start_date,$param_end_date);
                
                // Set parameters
                $param_course_name = trim($_POST["course_name"]);
                $param_code = trim($_POST["code"]);
				$param_term = trim($_POST["term"]);
				$param_year = trim($_POST["year"]);
				$param_course_desc= trim($_POST["course_desc"]);
				$param_start_date = $_POST["start_date"];
				$param_end_date = $_POST["end_date"];
				
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
					header("location:manage_courses.php");
                   
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Courses</title> 
	 <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body style="background-color:#faf0e6">
     <?php 
        if(!empty($course_error)){
            echo '<div class="alert alert-danger">' . $course_error . '</div>';
        }    
        ?>
       <div class="wrapper">
        <h1>Edit Course</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]. '?id='. $id); ?>" method="post">
        <div class="form-group">
                <label>Course Name<font color='red'> *</font></label>
                <input type="text" name="course_name" class="form-control" value="<?= $data['course_name']?>">
               <span style='display: block;'><?php echo $course_error; ?></span>
            </div> 
			</br>
			 <div class="form-group">
                <label>Course Description<font color='red'> *</font></label>
                <textarea style="min-height: 100px; min-width: 271px;" type="text" name="course_desc" class="form-control" ><?php echo htmlspecialchars($data['course_desc']); ?></textarea>
            </div>   
            </br>
			<div class="form-group">
                <label>Code<font color='red'> *</font></label>
                <input type="text" name="code" class="form-control" value="<?= $data['code']?>">
            </div>   
            </br>
			<div class="form-group">
                <label>Term<font color='red'> *</font></label>
                <input type="text" name="term" class="form-control" value="<?= $data['term']?>">
            </div> 
			</br>
			<div class="form-group">
                <label>Year<font color='red'> *</font></label>
                <input type="text" name="year" class="form-control" value="<?= $data['year']?>">
            </div>   
            </br>
			<div class="form-group">
                <label>Start Date<font color='red'> *</font></label>
                <input type="date" name="start_date" class="form-control" value="<?= $data['start_date']?>">
            </div> 
			</br>
			<div class="form-group">
                <label>End Date<font color='red'> *</font></label>
                <input type="date" name="end_date" class="form-control" value="<?= $data['end_date']?>">
            </div> 
	        </br>
            <div class="form-group">
                <input type="submit" style='background-color:pink' value="Submit">
            </div>
        </form>
     </div>
    </div>
</div>

</body>
</html>
