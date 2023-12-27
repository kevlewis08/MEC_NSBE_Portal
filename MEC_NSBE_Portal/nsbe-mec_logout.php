// Michael Ellis

<?php
session_start(); // Resume the existing session

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit();
?>
