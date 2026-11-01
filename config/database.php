<?php

// Database server name
$host = "localhost";

// Database name
$dbname = "grocery_db";

// MySQL username
$username = "root";

// MySQL password
$password = "";

try {

    // Create PDO connection
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $username,
        $password
    );

    // Set PDO error mode to exception
    $conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    // Display success message
// echo "Database connected successfully!";

} catch(PDOException $e) {

    // Display error message if connection fails
    die("Connection failed: " . $e->getMessage());

}

?>