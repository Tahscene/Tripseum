<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styla.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
            include("php/config.php");

            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $password = $_POST['password'];

                
                $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

                if (!$verify_query) {
                    
                    die('Error: ' . mysqli_error($con));
                }

                if(mysqli_num_rows($verify_query) != 0 ){
                    echo "<div class='message'>
                            <p>This email is used, Try another One Please!</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn1'>Go Back</button>";
                } else {
                    $insert_query = mysqli_query($con, "INSERT INTO users (Username, Email, Age, Password) VALUES ('$username', '$email', '$age', '$password')");

                    if (!$insert_query) {
                        
                        die('Error: ' . mysqli_error($con));
                    }

                    echo "<div class='message'>
                            <p>Registration successfully!</p>
                          </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Login Now</button>";
                }
            } else {
            ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>
 this is register.php . use password hashing. also edit the login.php <?php

$con = mysqli_connect("localhost", "root", "", "tutorialss");


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($id > 0) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $destination = mysqli_real_escape_string($con, $_POST['destination']);
        $departure_date = mysqli_real_escape_string($con, $_POST['departure_date']);
        $return_date = mysqli_real_escape_string($con, $_POST['return_date']);
        
        $update_sql = "UPDATE booking SET name='$name', email='$email', destination='$destination', departure_date='$departure_date', return_date='$return_date' WHERE id=$id";
        
        if (mysqli_query($con, $update_sql)) {
            echo "Record updated successfully.<br>";
        } else {
            echo "Error updating record: " . mysqli_error($con) . "<br>";
        }
    } else {
        echo "Invalid ID provided for update.<br>";
    }
}


if ($id > 0) {
    $sql = "SELECT id, name, email, destination, departure_date, return_date FROM booking WHERE id=$id";
    $result = mysqli_query($con, $sql);


    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Record not found.");
    }
} else {
    die("Invalid ID provided.");
}
?>