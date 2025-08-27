<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commute Connect</title>
    <style>
        /* General Styles */
body {
    margin: 0;
    font-family: 'Arial', sans-serif;
    color: #333;
    line-height: 1.6;
}


a {
    text-decoration: none;
    color: inherit;
    cursor: pointer;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(to right, #4e54c8, #8f94fb);
    color: white;
    height: 100vh;
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.navbar {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px;
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
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
    width: 50px; /* Adjusted for navbar height */
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
    background-color: #ffd700; /* Placeholder for no-image users */
    object-fit: cover;
    margin-right: 80px;
}

.user-profile span {
    font-size: 18px; /* Increased font size */
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
    min-width: 140px; /* Adjusted width for larger text */
}

.user-profile:hover .dropdown {
    display: flex;
}

.user-profile .dropdown a {
    text-decoration: none;
    color: #4e54c8;
    padding: 8px 10px;
    margin: 5px 0;
    font-size: 16px; /* Increased font size */
    border-radius: 3px;
    transition: background 0.3s;
}

.user-profile .dropdown a:hover {
    background: #f0f0f0;
}


.hero-content {
    padding: 0 20px;
    max-width: 80%;
}

.hero-content h1 {
    font-size: 3rem;
    margin-bottom: 20px;
    letter-spacing: 1px;
}

.hero-content p {
    font-size: 1.2rem;
    margin-bottom: 40px;
    max-width: 600px;
    margin: 0 auto;
}

.hero-buttons {
    margin-top: 20px;
}

.hero-buttons .btn {
    margin: 15px;
    padding: 15px 30px;
}

.primary-btn {
    background: #ffd700;
    color: #333;
}

.primary-btn:hover {
    background: white;
    color: #4e54c8;
}

.secondary-btn {
    background: transparent;
    border: 2px solid #ffd700;
    color: white;
}

.secondary-btn:hover {
    background: white;
    color: #4e54c8;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }

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

    .hero-buttons .btn {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
    }
}

    </style>
</head>
<body>
    <header class="hero-section">
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
                        <?php if (isset($_SESSION['$name'])): ?>
                            <a href="profile.php">Profile</a>
                            <a href="logout.php">Logout</a>
                        <?php else: ?>
                            <a href="profile.php">Profile</a>
                            <a href="index.html">Logout</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        
        </nav>
        <div class="hero-content">
            <h1>Share Rides, Save the Planet</h1>
            <p>Join thousands of users who are making carpooling simple, affordable, and sustainable.</p>
            <div class="hero-buttons">
                <a href="find_a_ride.php" class="btn primary-btn">Find a Ride</a>
                <a href="offer_ride.php" class="btn secondary-btn">Offer a Ride</a>
            </div>
        </div>
    </header>
</body>
</html>
