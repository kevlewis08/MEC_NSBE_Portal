//Michael Ellis

<?php
session_start(); // Start a PHP session

// Include PHPMailer library (replace the path with your actual path)
require 'path/to/PHPMailer/PHPMailerAutoload.php';

// Connect to the database (replace these values with your database credentials)
$mysqli = new mysqli("localhost", "username", "password", "your_database");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);

    // Check if the email exists in the database
    $stmt = $mysqli->prepare("SELECT id, username FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate a unique token and store it in the database
        $token = bin2hex(random_bytes(32));

        $stmt->bind_result($userId, $username);
        $stmt->fetch();
        $stmt->close();

        $stmt = $mysqli->prepare("UPDATE users SET reset_token = ? WHERE id = ?");
        $stmt->bind_param("si", $token, $userId);
        $stmt->execute();
        $stmt->close();

        // Send reset email
        $mail = new PHPMailer;
        $mail->setFrom('your_email@example.com', 'Your Name');
        $mail->addAddress($email, $username);
        $mail->Subject = 'Password Reset';
        $mail->Body = 'Click the following link to reset your password: http://yourwebsite.com/reset_password.php?token=' . $token;

        if ($mail->send()) {
            echo "An email has been sent to your email address with instructions to reset your password.";
        } else {
            echo "Error sending email: " . $mail->ErrorInfo;
        }
    } else {
        echo "No user found with that email address.";
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
    <title>Forgot Password</title>
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

    <h2>Forgot Password</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" required>

        <input type="submit" value="Reset Password">
    </form>

</body>
</html>
