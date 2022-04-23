<?php
// Author: 40215517
// Tester: all

session_start();
session_unset();
session_destroy();
header("location: ../login_page.php");
exit();
?>