<?php
// Include the database connection file
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the form data exists
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate inputs (basic validation)
    if (empty($name) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    // Sanitize inputs to prevent SQL injection
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Check if the email already exists in the database
    $checkEmailSql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailSql);

    if ($result && $result->num_rows > 0) {
        echo "This email is already registered.";
        exit;
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the data into the database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful! Please log in.'); window.location.href = 'login.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Register - CommuteConnect</title>
    <style>
        /* Styles for the registration page */
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
            <h2>Create an Account</h2>
            <form action="registration.php" method="POST">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a password" required>
                </div>
                <button type="submit" class="btn primary-btn">Register</button>
                <p class="auth-switch">Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div>
    </div>
</body>
</html>
