CREATE TABLE rides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    gender VARCHAR(10) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    pickup_point VARCHAR(150) NOT NULL,
    destination_point VARCHAR(150) NOT NULL,
    pick_date DATE NOT NULL,
    pick_time TIME NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
