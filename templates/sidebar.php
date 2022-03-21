<html>

<style type="text/css">
a:link {color: #333366}
a:visited {color: #333366}
a:hover {background: #CCFFCC}
a {text-decoration: none}
</style>

<head>
</head>


<body bgcolor=#33cccc>



<b><font size=4><i><?php echo $_SESSION['dept'] . " " . $_SESSION['code'] . " / " . $_SESSION['term'] . " " . $_SESSION['year']; ?><br>Section NN</i></font></b><hr>
<b><font size=4>

<ul>

<!--menu for Contact information -->	
<li><a href="contact_info.php?course_id=MTM1" target="contents"><b><font color=black>Contact Information</b></a></li>

<!--menu for course materials:assigment/project/quiz/outline/announcement/solution/leture notes/tutorials-->	
<li><a href="course_material_list.php?course_id=MTM1" target="contents"><b><font color=black>Course Material</b></a></li>

<!--menu for Tutorial and Lab Time Slots-->	
<li><a href="ta_time_slot_list.php?course_id=MTM1" target="contents"><b><font color=black>Tutorial and Lab</b></a></li>

<li><a href = "course_group.php?course_id=MTM1" target ="contents"><b><font color=black>Course Group</b></a></li>

<li><a href = "peer_review_intro.php?course_id=MTM1" target ="contents"><b><font color=black>Peer Review</b></a></li>

<li><a href = "meeting_time_slot_list.php?course_id=MTM1" target ="contents"><b><font color=black>Reserve Meeting Time Slots</b></a></li>

<li><a href = "assignment_list.php?course_id=MTM1" target ="contents"><b><font color=black>Assignment/Project Upload</b></a></li>

<li><a href = "assessment_list.php?course_id=MTM1" target ="contents"><b><font color=black>Online Assessment</b></a></li>

<li><a href = "course_mark_list.php?course_id=MTM1" target ="contents"><b><font color=black>Course Grades</b></a></li>

<li><a href = "change_password.php?course_id=MTM1" target ="contents"><b><font color=black>Change Password</b></a></li>

<li><a href = "change_email.php?course_id=MTM1" target ="contents"><b><font color=black>Change Email</b></a></li>

<!--
<li><a href = "../logout.php" target ="_top"><b><font color=black>Logout</b></a></li>
-->

</ul>
	
</body>
</html>