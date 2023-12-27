// Michael Ellis

<html>
<head>
<title>Hello, World Page</title>
</head>
<body>
This is <Michael Ellis> page
<?php
$response = file_get_contents('https://api.imgflip.com/get_memes');
$json_response = json_decode($response);
print_r($json_response);
?>
<body>
</html>
