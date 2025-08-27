<?php
include 'db_connection.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $age = (int)$_POST['age'];
    $gender = $conn->real_escape_string($_POST['gender']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $pickup_point = $conn->real_escape_string($_POST['pickup_point']);
    $destination_point = $conn->real_escape_string($_POST['destination_point']);
    $pick_date = $conn->real_escape_string($_POST['pick_date']);
    $pick_time = $conn->real_escape_string($_POST['pick_time']);
    $price = (float)$_POST['price'];

    // Save ride as "Offered"
    $sql = "INSERT INTO rides (name, age, gender, mobile, pickup_point, destination_point, pick_date, pick_time, price, type)
            VALUES ('$name', $age, '$gender', '$mobile', '$pickup_point', '$destination_point', '$pick_date', '$pick_time', $price, 'Offered')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Ride offered successfully'); window.location.href = 'myrides.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer a Ride</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            color: #fff;
            line-height: 1.6;
            display: flex;
            justify-content: flex-start;
            flex-direction: column;
            height: 100vh;
            padding-top: 50px; /* Add space for the fixed navbar */
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 15px 30px;
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            height: 100px; /* Ensure navbar is on top */
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-left: 20px;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            font-weight: 500;
        }

        .nav-links a:hover {
            color: #ffd700;
        }

        /* User Profile Dropdown */
        .user-profile {
            position: relative;
            cursor: pointer;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .dropdown {
            position: absolute;
            top: 45px;
            right: 0;
            background: white;
            color: #333;
            display: none;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .user-profile:hover .dropdown {
            display: block;
        }

        .dropdown a {
            text-decoration: none;
            color: #333;
            padding: 8px 15px;
            display: block;
            border-radius: 3px;
        }

        .dropdown a:hover {
            background: #f0f0f0;
        }

        /* Flexbox Layout for Form and Image */
        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            width: 100%;
            max-width: 1200px;
            margin-top: 80px; /* Add space below the navbar */
        }

        .image-section, .form-section {
            width: 48%;
            height: auto;
            border-radius: 10px;
            overflow: hidden;
        }

        /* Image Section */
        .image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Form Section */
.form-section {
    background-color: white;
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border-radius: 10px;
}

/* Form Labels */
.form-section label {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

/* Form Inputs, Selects, and Button */
.form-section input, .form-section select, .form-section button {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
}

.form-section button {
    background: linear-gradient(to right, #4e54c8, #8f94fb);
    color: white;
    font-weight: bold;
    border: none;
    cursor: pointer;
    transition: background 0.3s;
}

.form-section button:hover {
    background: linear-gradient(to right, #8f94fb, #4e54c8);
}


        /* Responsive Styles for Mobile */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .image-section, .form-section {
                width: 90%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">CommuteConnect</div>
        <ul class="nav-links">
            <li><a href="index1.php">Home</a></li>
            <li><a href="find_a_ride.php">Find a Ride</a></li>
            <li><a href="offer_ride.php">Offer a Ride</a></li>
            <li><a href="myrides.php">My Rides</a></li>
        </ul>
        <div class="user-profile">
            <img src="person.png" alt="User Icon">
            <div class="dropdown">
                <?php if (isset($_SESSION['name'])): ?>
                    <a href="profile.php">Profile</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="signup.php">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Image Section -->
        <div class="image-section">
            <img src="car1.webp" alt="Offer Ride">
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <h1>Offer a Ride</h1>
            <form action="offer_ride.php" method="POST">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="age">Age</label>
                <input type="number" id="age" name="age" required>

                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>

                <label for="mobile">Mobile</label>
                <input type="text" id="mobile" name="mobile" required>

                <label for="pickup_point">Pickup Point</label>
                <input type="text" id="pickup_point" name="pickup_point" required>

                <label for="destination_point">Destination Point</label>
                <input type="text" id="destination_point" name="destination_point" required>

                <label for="pick_date">Pickup Date</label>
                <input type="date" id="pick_date" name="pick_date" required>

                <label for="pick_time">Pickup Time</label>
                <input type="time" id="pick_time" name="pick_time" required>

                <label for="price">Price</label>
                <input type="number" id="price" name="price" required>

                <button type="submit">Offer Ride</button>
            </form>
        </div>
    </div>

</body>
</html>
