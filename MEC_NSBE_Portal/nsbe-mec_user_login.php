// Michael Ellis

<?php
session_start(); // Start a PHP session for user authentication

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and process the login data
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];

    // Connect to the database (replace these values with your database credentials)
    $mysqli = new mysqli("localhost", "username", "password", "user_registration");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Retrieve user information from the database
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userId, $dbUsername, $dbPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify password
    if ($dbUsername && password_verify($password, $dbPassword)) {
        // Password is correct, set session variables for user authentication
        $_SESSION["user_id"] = $userId;
        $_SESSION["username"] = $dbUsername;

        // Redirect to a logged-in page
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid username or password
        echo "Invalid username or password.";
    }

    // Close the database connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>User Login</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
    </form>

</body>
</html>