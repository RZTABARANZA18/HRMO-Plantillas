<?php
// Database configuration
define('DB_HOST', 'localhost');  // Usually 'localhost' for XAMPP
define('DB_USER', 'root');       // Default XAMPP username
define('DB_PASSWORD', '');       // Default XAMPP password is empty
define('DB_NAME', 'job_orders_db'); // Your database name

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$createTable = "
    CREATE TABLE IF NOT EXISTS job_orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        designation VARCHAR(255) NOT NULL,
        rate_per_day DECIMAL(10,2) NOT NULL,
        date_from DATE NOT NULL,
        date_to DATE NOT NULL,
        funding_charges VARCHAR(255) NOT NULL,
        office_assignment VARCHAR(255) NOT NULL,
        acknowledgement TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

if (!$conn->query($createTable)) {
    echo "Error creating table: " . $conn->error;
}
?> 