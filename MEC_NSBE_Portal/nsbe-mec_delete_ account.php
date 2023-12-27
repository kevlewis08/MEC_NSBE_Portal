//Michael Ellis

<?php
session_start(); // Start a PHP session

// Connect to the database (replace these values with your database credentials)
$mysqli = new mysqli("localhost", "username", "password", "your_database");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $confirmation = $_POST["confirmation"];

    // Check if the user entered the confirmation correctly
    if ($confirmation === "DELETE") {
        // Get the user ID from the session
        $userId = $_SESSION["user_id"];

        // Delete the user's account from the database
        $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            // Logout the user and redirect to a confirmation page
            session_destroy();
            header("Location: account_deleted.php");
            exit();
        } else {
            echo "Error deleting account: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Confirmation mismatch. Account not deleted.";
    }
}

// Close the database connection
$mysqli->close();
?>
