<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
       
        body {
            background-image: url('img/c.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

      
        .container {
            background: rgba(255, 255, 255, 0.95); 
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
            width: 360px; 
            max-width: 100%;
            margin: 0 auto;
            animation: fadeIn 1s ease-in-out; 
        }

       
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        h3 {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin-bottom: 20px;
            font-size: 1.5rem; 
        }

        .form-control {
            border-radius: 8px;
            height: 40px; 
            font-size: 16px; 
            border: 1px solid #ced4da; 
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1); 
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25); 
        }

        .form-group {
            margin-bottom: 15px; 
        }

        .btn-success, .btn-danger {
            margin: auto;
  width: 140px;
  outline: none;

  border: none;
  margin-top: 2rem;
  padding: 0.7rem;
  font-size: 1rem;
  border-radius: 4px;
  font-weight: bold;
  color: black;
  cursor: pointer;
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .button-group {
            display: flex;
            justify-content: space-between; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Contact Us</h3>
        <form action="form-process.php" method="POST">
            <div class="form-group">
                <input type="text" name="firstname" id="firstname" placeholder="First Name" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="text" name="lastname" id="lastname" placeholder="Last Name" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="tel" name="phone" id="phone" placeholder="Phone" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
            </div>
            <div class="form-group">
                <textarea name="message" id="message" placeholder="Your Message" class="form-control" rows="4" required></textarea>
            </div>
            <div class="button-group">
                <button class="btn btn-success" type="submit">Submit</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </form>
    </div>
</body>
</html>
