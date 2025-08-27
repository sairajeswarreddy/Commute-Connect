USE DATABASE commute_connect
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unique ID for each user
    name VARCHAR(100) NOT NULL,        -- Full name of the user
    email VARCHAR(150) NOT NULL UNIQUE, -- Email address (must be unique)
    password VARCHAR(255) NOT NULL,   -- Encrypted password
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Timestamp of account creation
);
