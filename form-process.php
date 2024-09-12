<?php
include("php/config1.php");
extract($_POST);


$stmt = $mysqli->prepare("INSERT INTO `contactdata`(`firstname`, `lastname`, `phone`, `email`, `message`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $firstname, $lastname, $phone, $email, $message);

if ($stmt->execute()) {
    $message = "Thanks for contacting us !";
} else {
    $message = "Couldn't enter data: " . $mysqli->error;
}

$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Confirmation</title>
    <style>
        body {
            background-image: url('img/c.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message {
            background: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            font-size: 1.5em;
            max-width: 500px;
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="message">
        <?php echo $message; ?>
    </div>
</body>
</html>
