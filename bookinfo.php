<?php

$con = mysqli_connect("localhost", "root", "", "tutorialss");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    
    if ($delete_id > 0) {
        $delete_sql = "DELETE FROM booking WHERE id = $delete_id";
        
        if (mysqli_query($con, $delete_sql)) {
            echo "Record deleted successfully.<br>";
        } else {
            echo "Error deleting record: " . mysqli_error($con) . "<br>";
        }

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

$sql = "SELECT id, name, email, destination, departure_date, return_date FROM booking";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

echo "<style>
        body {
            font-family: Arial, sans-serif;
            background: url('img/22.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            padding: 20px;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            font-weight: bold;
            border: 2px solid #ddd;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: rgba(255, 255, 255, 0.3);
            color: #f2f2f2;
        }
        td {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .action-column {
            min-width: 200px;
        }
        .action-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            margin: 2px;
            transition: background-color 0.3s;
            white-space: nowrap;
        }
        .action-button:hover {
            background-color: #45a049;
        }
        .delete-button {
            background-color: #f44336;
        }
        .delete-button:hover {
            background-color: #e53935;
        }
        .update-button {
            background-color: #008CBA;
        }
        .update-button:hover {
            background-color: #007bb5;
        }
        h1 {
            margin-bottom: 30px;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }
            th, td {
                padding: 10px;
                font-size: 14px;
            }
            .action-button {
                padding: 8px 10px;
            }
            .action-column {
                min-width: 150px;
            }
        }

        @media (max-width: 480px) {
            table {
                width: 100%;
            }
            th, td {
                display: block;
                width: 100%;
                padding: 10px;
            }
            tr {
                margin-bottom: 10px;
                display: block;
                border-bottom: 1px solid #ddd;
            }
            td {
                text-align: left;
            }
            th {
                text-align: center;
                display: none;
            }
            .action-column {
                min-width: 100%;
            }
        }
      </style>";

echo "<h1>Booking Details</h1>";

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Destination</th><th>Departure Date</th><th>Return Date</th><th class='action-column'>Action</th></tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["destination"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["departure_date"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["return_date"]) . "</td>";
        echo "<td class='action-column'>
                <a href='update.php?id=" . htmlspecialchars($row["id"]) . "' class='action-button update-button'>Update</a>
                <a href='?delete_id=" . htmlspecialchars($row["id"]) . "' class='action-button delete-button'>Delete</a>
              </td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No bookings found.";
}

mysqli_close($con);
?>
