<?php
include('validate_session.php');
include('../includes/main.php');
session_destroy(); // Destroy all session data

// Redirect to the login page or any other desired page
header("location:".SITEURL.'login.php');
exit;
?>
