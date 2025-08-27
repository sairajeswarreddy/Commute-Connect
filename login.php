<?php
// Include the database connection file
include 'db_connection.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form input data
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Sanitize inputs to prevent SQL injection
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Query the database to fetch the user data based on the email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify the entered password against the hashed password stored in the database
        if (password_verify($password, $user['password'])) {
            // Login successful
            echo "<script>alert('Login successful! Redirecting to the dashboard.'); window.location.href = 'index1.php';</script>";
        } else {
            // Incorrect password
            echo "Invalid email or password.";
        }
    } else {
        // No user found with this email
        echo "Invalid email or password.";
    }
}

// Close the connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CommuteConnect</title>
    <style>
        /* Auth Container (Login and Registration Pages) */
.auth-container {
    background: linear-gradient(to right, #4e54c8, #8f94fb);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
}

.auth-form {
    background: rgba(255, 255, 255, 0.9);
    padding: 30px;
    border-radius: 10px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    color: #333;
}

.auth-form h2 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-size: 14px;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.3s;
}

.form-group input:focus {
    border-color: #4e54c8;
}

.btn {
    width: 100%;
    padding: 12px 0;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s, color 0.3s;
}

.primary-btn {
    background: #4e54c8;
    color: white;
}

.primary-btn:hover {
    background: #8f94fb;
}

.auth-switch {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

.auth-switch a {
    color: #4e54c8;
    font-weight: bold;
    text-decoration: none;
}

.auth-switch a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-form">
            <h2>Login to Your Account</h2>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn primary-btn">Login</button>
                <p class="auth-switch">Don't have an account? <a href="registration.php">Register here</a>.</p>
            </form>
        </div>
    </div>
</body>
</html>
