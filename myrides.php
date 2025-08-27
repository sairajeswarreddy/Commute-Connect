<?php
include 'db_connection.php'; // Include the database connection file

// Cancel Offered Ride
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_offered_ride'])) {
    $ride_id = (int)$_POST['ride_id'];
    $sql = "DELETE FROM rides WHERE id = $ride_id AND type = 'Offered'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Offered ride canceled successfully'); window.location.href = 'myrides.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Cancel Booked Ride
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_booked_ride'])) {
    $ride_id = (int)$_POST['ride_id'];

    // Update the ride status back to 'Available' and type back to 'Offered'
    $sql = "UPDATE rides SET status = 'Available', type = 'Offered' WHERE id = $ride_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booked ride canceled successfully and marked as available'); window.location.href = 'myrides.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch rides categorized by 'Offered' and 'Booked'
$offered_rides_query = "SELECT * FROM rides WHERE type = 'Offered'";
$booked_rides_query = "SELECT * FROM rides WHERE type = 'Requested' AND status = 'Booked'";

$offered_rides = $conn->query($offered_rides_query);
$booked_rides = $conn->query($booked_rides_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Rides</title>
    <style>
        /* General Styling */
        body {
            background: linear-gradient(to bottom, #4e54c8, #8f94fb);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
            line-height: 1.6;
            padding-top: 80px;
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


        .container {
            max-width: 1200px;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            padding: 20px;
            text-align: center;
            color: white;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
        }

        .section {
            padding: 20px;
        }

        .section h2 {
            font-size: 24px;
            color: #4e54c8;
            margin-bottom: 20px;
        }

        .ride-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .ride-item {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .ride-item:hover {
            transform: scale(1.02);
        }

        .ride-item h3 {
            margin: 0 0 10px;
            color: #4e54c8;
        }

        .ride-item p {
            margin: 5px 0;
            color: #333;
        }

        .ride-item form {
            margin-top: 10px;
            text-align: right;
        }

        .ride-item button {
            padding: 10px 15px;
            font-size: 14px;
            color: white;
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .ride-item button:hover {
            background: linear-gradient(to right, #8f94fb, #4e54c8);
        }

        .no-rides {
            text-align: center;
            font-size: 18px;
            color: #666;
        }

        @media (max-width: 768px) {
            .ride-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
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

    <div class="container">
        <div class="header">
            <h1>My Rides</h1>
        </div>

        <!-- Offered Rides Section -->
        <div class="section">
            <h2>Offered Rides</h2>
            <div class="ride-list">
                <?php if ($offered_rides->num_rows > 0): ?>
                    <?php while ($row = $offered_rides->fetch_assoc()): ?>
                        <div class="ride-item">
                            <h3><?= htmlspecialchars($row['pickup_point']) ?> to <?= htmlspecialchars($row['destination_point']) ?></h3>
                            <p><strong>Price:</strong> ₹<?= htmlspecialchars($row['price']) ?></p>
                            <p><strong>Date:</strong> <?= htmlspecialchars($row['pick_date']) ?> | <strong>Time:</strong> <?= htmlspecialchars($row['pick_time']) ?></p>
                            <form method="POST" action="">
                                <input type="hidden" name="ride_id" value="<?= htmlspecialchars($row['id']) ?>">
                                <button type="submit" name="cancel_offered_ride">Cancel Ride</button>
                            </form>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="no-rides">You haven't offered any rides yet.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Booked Rides Section -->
        <div class="section">
            <h2>Booked Rides</h2>
            <div class="ride-list">
                <?php if ($booked_rides->num_rows > 0): ?>
                    <?php while ($row = $booked_rides->fetch_assoc()): ?>
                        <div class="ride-item">
                            <h3><?= htmlspecialchars($row['pickup_point']) ?> to <?= htmlspecialchars($row['destination_point']) ?></h3>
                            <p><strong>Date:</strong> <?= htmlspecialchars($row['pick_date']) ?> | <strong>Time:</strong> <?= htmlspecialchars($row['pick_time']) ?></p>
                            <form method="POST" action="">
                                <input type="hidden" name="ride_id" value="<?= htmlspecialchars($row['id']) ?>">
                                <button type="submit" name="cancel_booked_ride">Cancel Booking</button>
                            </form>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="no-rides">You haven't booked any rides yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>
