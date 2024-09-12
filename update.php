<?php
$con = mysqli_connect("localhost", "root", "", "tutorialss");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = "";
$name = "";
$email = "";
$destination = "";
$departure_date = "";
$return_date = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $destination = mysqli_real_escape_string($con, $_POST['destination']);
    $departure_date = mysqli_real_escape_string($con, $_POST['departure_date']);
    $return_date = mysqli_real_escape_string($con, $_POST['return_date']);

    $update_sql = "UPDATE booking SET 
                    name='$name', 
                    email='$email', 
                    destination='$destination', 
                    departure_date='$departure_date', 
                    return_date='$return_date' 
                    WHERE id=$id";

    if (mysqli_query($con, $update_sql)) {
        echo "<p style='color: green; text-align: center;'>Record updated successfully.</p>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'bookinfo.php';
                }, 2000); 
              </script>";
    } else {
        echo "<p style='color: red; text-align: center;'>Error updating record: " . mysqli_error($con) . "</p>";
    }
}

if (isset($_GET['id']) && intval($_GET['id']) > 0) {
    $id = intval($_GET['id']);

    $select_sql = "SELECT * FROM booking WHERE id = $id";
    $result = mysqli_query($con, $select_sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
        $destination = $row['destination'];
        $departure_date = $row['departure_date'];
        $return_date = $row['return_date'];
    } else {
        echo "<p style='color: red; text-align: center;'>Record not found.</p>";
        exit();
    }
} else {
    echo "<p style='color: red; text-align: center;'>Invalid ID.</p>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        @media (max-width: 768px) {
            .container {
                width: 80%;
            }
            input[type="submit"] {
                font-size: 14px;
                padding: 8px;
            }
        }
        @media (max-width: 480px) {
            .container {
                width: 95%;
                padding: 15px;
            }
            h2 {
                font-size: 20px;
            }
            input[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Booking</h2>
        <form action="update.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            
            <label for="destination">Destination:</label>
            <input type="text" id="destination" name="destination" value="<?php echo htmlspecialchars($destination); ?>" required>
            
            <label for="departure_date">Departure Date:</label>
            <input type="date" id="departure_date" name="departure_date" value="<?php echo htmlspecialchars($departure_date); ?>" required>
            
            <label for="return_date">Return Date:</label>
            <input type="date" id="return_date" name="return_date" value="<?php echo htmlspecialchars($return_date); ?>" required>
            
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($con);
?>
