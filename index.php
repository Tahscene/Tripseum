<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styla.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
              include("php/config.php");
              
              if (isset($_POST['submit'])) {
                  $email = mysqli_real_escape_string($con, $_POST['email']);
                  $password = mysqli_real_escape_string($con, $_POST['password']);
                  $role = mysqli_real_escape_string($con, $_POST['role']); 

                  
                  $admin_email = "admin@gmail.com";
                  $admin_password = "123";

                  if ($email === $admin_email && $password === $admin_password && $role === 'admin') {
                    
                      $_SESSION['valid'] = $admin_email;
                      $_SESSION['username'] = "Admin";
                      $_SESSION['role'] = "Admin";
                      header("Location: bookinfo.php"); 
                  } else {
                      
                      $query = "SELECT * FROM users WHERE Email='$email' AND Password='$password'";
                      $result = mysqli_query($con, $query);
                      
                      if ($result && mysqli_num_rows($result) > 0) {
                          $row = mysqli_fetch_assoc($result);
                          $_SESSION['valid'] = $row['Email'];
                          $_SESSION['username'] = $row['Username'];
                          $_SESSION['age'] = $row['Age'];
                          $_SESSION['id'] = $row['Id'];

                          if ($role === 'user') {
                              header("Location: loginafter.html"); 
                          } else {
                              echo "<div class='message'><p>Invalid Role for User Login</p></div><br>";
                              echo "<a href='index.php'><button class='btn'>Go Back</button></a>";
                          }
                      } else {
                          echo "<div class='message'><p>Wrong Email or Password</p></div><br>";
                          echo "<a href='index.php'><button class='btn'>Go Back</button></a>";
                      }
                  }
              } else {
            ?>
<style>
    .field {
        margin-bottom: 15px;
    }

    .input label {
        display: block;
        margin-bottom: 5px;
    }

   
    .input input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    
    .input select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #fff;
    }

    .links {
        margin-top: 15px;
        text-align: center;
    }

    .links a {
        color:rgba(76, 68, 182, 0.808);
        text-decoration: none;
    }
</style>

<header>Login</header>
<form action="" method="post">
    <div class="field input">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" autocomplete="off" required>
    </div>

    <div class="field input">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" autocomplete="off" required>
    </div>

    <div class="field input">
        <label for="role">Login as</label>
        <select name="role" id="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="field">
        <input type="submit" class="btn" name="submit" value="Login">
    </div>
    <div class="links">
        Don't have an account? <a href="register.php">Sign Up Now</a>
    </div>
</form>

        </div>
        <?php } ?>
    </div>
</body>
</html>