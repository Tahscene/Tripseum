<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorialss";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $destination = $_POST["destination"];
    $departure_date = $_POST["departure-date"];
    $return_date = $_POST["return-date"];

    
    $sql = "INSERT INTO `booking`(`name`, `email`, `destination`, `departure_date`, `return_date`)
     VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $destination, $departure_date, $return_date);

    if ($stmt->execute()) {
        $message = "Booked Successfully !";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            background-image: url('img/55.jpeg');
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
