//Michael Ellis


<?php
session_start(); // Resume the existing session

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
    <p>This is your dashboard. You are logged in.</p>

    <a href="logout.php">Logout</a>

</body>
</html>
