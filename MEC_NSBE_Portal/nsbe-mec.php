// Michael Ellis

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Example</title>
</head>
<body>

    <header>
        <h1><?php echo "Welcome to My PHP Website!"; ?></h1>
    </header>

    <section>
        <p><?php echo "This is a simple PHP example."; ?></p>

        <?php
        // PHP code block
        $myVariable = "Hello, PHP!";
        echo "<p>" . $myVariable . "</p>";
        ?>
    </section>

</body>
</html>