<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find a Ride</title>
    <style>
        /* Modern Styling */
        body {
            background: linear-gradient(to bottom, #4e54c8, #8f94fb);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            padding-top: 80px;
            color: #fff;
        }
        /* Navbar Styles */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px;
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
    z-index: 1000;
    height: 60px;
}

.logo {
    font-size: 24px;
    font-weight: bold;
    color: #fff;
}

.nav-links {
    display: flex;
    list-style: none;
}

.nav-links li {
    margin: 0 15px;
}

.nav-links a {
    color: #fff;
    font-size: 16px;
    font-weight: 500;
    transition: color 0.3s;
    text-decoration: none;
}

.nav-links a:hover {
    color: #ffd700;
}

/* Auth Section */
.nav-auth {
    display: flex;
    align-items: center;
}

.user-profile {
    display: flex;
    align-items: center;
    position: relative;
    cursor: pointer;
}

.user-profile img.user-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 60px;
    background-color: #ffd700; /* Placeholder for no-image users */
    object-fit: cover;
}

.user-profile span {
    font-size: 18px;
    color: #fff;
    font-weight: bold;
}

.user-profile .dropdown {
    position: absolute;
    top: 60px;
    right: 0;
    background: white;
    border-radius: 5px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    display: none;
    flex-direction: column;
    padding: 10px;
    z-index: 10;
    min-width: 140px;
}

.user-profile:hover .dropdown {
    display: flex;
}

.user-profile .dropdown a {
    text-decoration: none;
    color: #4e54c8;
    padding: 8px 10px;
    margin: 5px 0;
    font-size: 16px;
    border-radius: 3px;
    transition: background 0.3s;
}

.user-profile .dropdown a:hover {
    background: #f0f0f0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .nav-links {
        flex-direction: column;
        position: absolute;
        top: 100%;
        right: 50px;
        background: rgba(0, 0, 0, 0.8);
        border-radius: 8px;
        display: none;
    }

    .navbar:hover .nav-links {
        display: flex;
    }
}


        .search-container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .search-container h2 {
            font-size: 24px;
            color: #4e54c8;
        }

        .search-container form {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .search-container input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 70%;
        }

        .search-container button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            color: white;
            cursor: pointer;
        }

        .search-container button:hover {
            background: linear-gradient(to right, #8f94fb, #4e54c8);
        }

        .ride-list {
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .ride-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }

        .ride-item img {
            width: 150px;
            height: 100px;
            border-radius: 10px;
            margin-right: 20px;
        }

        .ride-item .details {
            flex-grow: 1;
        }

        .ride-item h3 {
            margin: 0;
            color: #4e54c8;
            font-size: 20px;
        }

        .ride-item p {
            margin: 5px 0;
            color: #333;
        }

        .ride-item button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            color: white;
            cursor: pointer;
        }

        .ride-item button:hover {
            background: linear-gradient(to right, #8f94fb, #4e54c8);
        }
    </style>
</head>
<nav class="navbar">
    <div class="logo">CommuteConnect</div>
    <ul class="nav-links">
        <li><a href="index1.php">Home</a></li>
        <li><a href="find_a_ride.php">Find a Ride</a></li>
        <li><a href="offer_ride.php">Offer a Ride</a></li>
        <li><a href="myrides.php">MyRides</a></li>
    </ul>
    <div class="nav-auth">
        <!-- User Profile / Login Button -->
        <div class="user-profile">
            <img src="person.png" alt="User Icon" class="user-icon">
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
</nav>


<body>
    <div class="search-container">
        <h2>Find a Ride</h2>
        <form method="GET" action="">
            <input type="text" name="destination" placeholder="Enter destination">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="ride-list">
        <?php
        include 'db_connection.php'; // Include the database connection file

        // Retrieve the search term if provided
        $search_destination = isset($_GET['destination']) ? trim($_GET['destination']) : '';

        // SQL query to fetch only "Available" rides
        $sql = !empty($search_destination) ?
            "SELECT * FROM rides WHERE destination_point = '$search_destination' AND type = 'Offered' AND status = 'Available'" :
            "SELECT * FROM rides WHERE type = 'Offered' AND status = 'Available'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="ride-item">';
                echo '<div class="details">';
                echo '<h3>' . htmlspecialchars($row['pickup_point']) . ' to ' . htmlspecialchars($row['destination_point']) . '</h3>';
                echo '<p><strong>Price:</strong> ₹' . htmlspecialchars($row['price']) . '</p>';
                echo '<p><strong>Date:</strong> ' . htmlspecialchars($row['pick_date']) . ' | <strong>Time:</strong> ' . htmlspecialchars($row['pick_time']) . '</p>';
                echo '</div>';
                echo '<form method="POST" action="book_ride.php">';
                echo '<input type="hidden" name="ride_id" value="' . htmlspecialchars($row['id']) . '">';
                echo '<button type="submit">Ride</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo '<p style="text-align: center; color: #666;">No rides found.</p>';
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
